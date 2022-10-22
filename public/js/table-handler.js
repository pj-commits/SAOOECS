/************************
 * 
 * Activity Proposal Form
 * 
 ************************/

//Handles coorganizer's table(add, remove, and retrieve data from local storage). 
function coorganizer_handler() {
    return {
        coorganizers: [
            JSON.parse(localStorage.getItem('apf_coorganizers')),
        ],

        newCoorganizers: [
            {
                coorganization: '',
                name: '',
                phone: '',
                email: '',
            }
          ],

        error: false,
        msg: '',

        /* 
            Accepts array of input and store it to newCoorganizers[] in the meantime.
            Validate data from newCoorganizers[]. If empty or invalid, then return error message.
            If success transfer data from newCoorganizers[] to coorganizers[].
            Then push updated data of coorganizers[] to local storage.
        */
        addCoorganizer() {
            let verify = true;
            let reg_name = /^[a-zA-Z]+$/;
            let reg_email = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            let reg_phone = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
            
            //Validate inputs
            this.newCoorganizers.forEach(coorganizer => {
                if(coorganizer.email.length < 1){
                    verify = false;
                    this.error = true;
                    this.msg = "Email is empty!";
                }else if(!coorganizer.email.match(reg_email)){
                    verify = false;
                    this.error = true;
                    this.msg = "Invalid Email!";
                }
                if(coorganizer.phone.length < 1){
                    verify = false;
                    this.error = true;
                    this.msg = "Contact is empty!";
                }else if (!coorganizer.phone.match(reg_phone)){
                    verify = false;
                    this.error = true;
                    this.msg = "Invalid Contact Number!";
                }
                if(coorganizer.name.length < 1 ){
                    verify = false;
                    this.error = true;
                    this.msg = "Coorganizer is empty or invalid!";
                }

                if(coorganizer.coorganization.length < 1 ){
                    verify = false;
                    this.error = true;
                    this.msg = "Co-oorganization is empty!";
                }

            });
     
            if(verify === true){
                this.coorganizers[0].push({
                    coorganization: this.newCoorganizers[0].coorganization,
                    name: this.newCoorganizers[0].name,
                    phone: this.newCoorganizers[0].phone,
                    email: this.newCoorganizers[0].email,
                });
                localStorage.setItem('apf_coorganizers', JSON.stringify(this.coorganizers[0]))
                this.newCoorganizers = [
                    {
                        coorganization: '',
                        name: '',
                        phone: '',
                        email: '',
                    }
                ]
                this.error = false;
            }   
        },
        //remove deleted data in coorganizers[] then update local storage
        removeCoorganizer(index) {
            this.coorganizers[0].splice(index, 1);
            localStorage.setItem('apf_coorganizers', JSON.stringify(this.coorganizers[0]))
        },
    }
}

//Handles logistic's table(add, remove, and retrieve data from local storage).
function logistic_handler() {
    return {
        logistics: [
            JSON.parse(localStorage.getItem('apf_logistics')),
        ],

        newLogistics: [
            {
                service: '',
                date_needed: '',
                venue: '',
            }
          ],

        error: false,
        msg: '',
        current_date: new Date(),

        /* 
            Accepts array of input and store it to newLogistics[] in the meantime.
            Validate data from newLogistics[]. If empty or invalid, then return error message.
            If success transfer data from newLogistics[] to logistics[].
            Then push updated data of logistics[] to local storage.
        */
        addLogistic() {
            let verify = true;

            //Validate inputs
            if(this.newLogistics[0].venue.length < 1){
                verify = false;
                this.error = true;
                this.msg = "Venue is empty or invalid!";
            }
            if(this.newLogistics[0].date_needed.length < 1){
                verify = false;
                this.error = true;
                this.msg = "Date Needed is empty or invalid!";
            }else if(Date.parse(this.newLogistics[0].date_needed) < Date.parse(this.current_date)){
                verify = false;
                this.error = true;
                this.msg = "You cannot set previous date!";
            }
            if(this.newLogistics[0].service.length < 1){
                verify = false;
                this.error = true;
                this.msg = "Service is empty or invalid!";
            }

            if(verify === true){
                this.logistics[0].push({
                    service: this.newLogistics[0].service,
                    date_needed: this.newLogistics[0].date_needed,
                    venue: this.newLogistics[0].venue,

                });
                localStorage.setItem('apf_logistics', JSON.stringify(this.logistics[0]))
                this.newLogistics = [
                    {
                        service: '',
                        date_needed: '',
                        venue: '',
                    }
                ]
                this.error = false;
            }   
        },
        //remove deleted data in logistics[] then update local storage
        removeLogistic(index) {
            this.logistics[0].splice(index, 1); 
            localStorage.setItem('apf_logistics', JSON.stringify(this.logistics[0]))
        },
    }
}

//Handles activity's table(add, remove, and retrieve data from local storage).
function activity_handler() {
    return {
        activities: [
            JSON.parse(localStorage.getItem('apf_activities')),
        ],

        newActivities: [
            {
                activity: '',
                start_date: '',
                end_date: '',
            }
          ],

        error: false,
        msg: '',
        current_date: new Date(),

        /* 
            Accepts array of input and store it to newActivities[] in the meantime.
            Validate data from newActivities[]. If empty or invalid, then return error message.
            If success transfer data from newActivities[] to activities[].
            Then push updated data of activities[] to local storage.
        */
        addActivity() {
            let verify = true;

            //Validate inputs
            if(this.newActivities[0].end_date.length < 1){
                verify = false;
                this.error = true;
                this.msg = "End Date is empty!";
            }else if(Date.parse(this.newActivities[0].end_date) < Date.parse(this.newActivities[0].start_date)){
                verify = false;
                this.error = true;
                this.msg = "You cannot set less than start date!";
            }
            if(this.newActivities[0].start_date.length < 1){
                verify = false;
                this.error = true;
                this.msg = "Start Date is empty!";
            }else if (Date.parse(this.newActivities[0].start_date) < Date.parse(this.current_date)){
                verify = false;
                this.error = true;
                this.msg = "You cannot set previous date!";
            }   
            if(this.newActivities[0].activity.length < 1){
                verify = false;
                this.error = true;
                this.msg = "Activities is empty!";
            }

            if(verify === true){
                this.activities[0].push({
                    activity: this.newActivities[0].activity,
                    start_date: this.newActivities[0].start_date,
                    end_date: this.newActivities[0].end_date,

                });
                localStorage.setItem('apf_activities', JSON.stringify(this.activities[0]))
                this.newActivities = [
                    {
                        activity: '',
                        start_date: '',
                        end_date: '',
                    }
                ]
                this.error = false;
            }
        },
        //remove deleted data in activities[] then update local storage
        removeActivity(index) {
            this.activities[0].splice(index, 1); 
            localStorage.setItem('apf_activities', JSON.stringify(this.activities[0]))
        },
    }
}

/************************
 * 
 * Budget Requisition Form
 * 
 ************************/

//Handles requisition_items table(add, remove, and retrieve data from local storage).
function requisition_items_handler() {
    return {
        requisitions: [
            JSON.parse(localStorage.getItem('brf_requisitions')),
        ],

        newRequisitions: [
            {
                quantity: '',
                purpose: '',
                price: '',
            }
          ],

        error: false,
        msg: '',

        /* 
            Accepts array of input and store it to newRequisitions[] in the meantime.
            Validate data from newRequisitions[]. If empty or invalid, then return error message.
            If success transfer data from newRequisitions[] to requisitions[].
            Then push updated data of requisitions[] to local storage.
        */
        addRequisition() {
            let verify = true;

            //Validate inputs
            if(this.newRequisitions[0].price.length < 1){
                verify = false;
                this.error = true;
                this.msg = "Price is empty!";
            }
            if(this.newRequisitions[0].quantity.length < 1){
                verify = false;
                this.error = true;
                this.msg = "Quantity is empty!";
            }
            if(this.newRequisitions[0].purpose.length < 1){
                verify = false;
                this.error = true;
                this.msg = "Purpose is empty!";
            }

            if(verify === true){
                this.requisitions[0].push({
                    item_number: this.requisitions[0].length + 1,
                    quantity: this.newRequisitions[0].quantity,
                    purpose: this.newRequisitions[0].purpose,
                    price: this.newRequisitions[0].price,

                });
                localStorage.setItem('brf_requisitions', JSON.stringify(this.requisitions[0]))
                this.newRequisitions = [
                    {
                        quantity: '',
                        purpose: '',
                        price: '',
                    }
                ]
                this.error = false;
            }
        },
        //remove deleted data in requisitions[] then update local storage
        removeRequisition(index) {
            count = 0;

            this.requisitions[0].splice(index, 1); 

            this.requisitions[0].forEach(item => {
                count++;
                item.item_number = count;
            })
            localStorage.setItem('brf_requisitions', JSON.stringify(this.requisitions[0]))
        },

         //Return total of 'price' field in requisitions[]
        getTotal() {
            let total = 0;
            this.requisitions[0].forEach(item => {
                total = total + ((JSON.parse(item.quantity)) * (JSON.parse(item.price)))
            })

            return total
        },
        getItemNumber(){
            return this.requisitions[0].length + 1
        }
    }
}

/************************
 * 
 * Narrative Report
 * 
 ************************/

//Handles program's table(add, remove, and retrieve data from local storage).
function program_handler() {
    return {
        programs: [
            JSON.parse(localStorage.getItem('nr_programs')),
        ],

        newPrograms: [
            {
                activity: '',
                start_date: '',
                end_date: '',
            }
          ],

        error: false,
        msg: '',

        /* 
            Accepts array of input and store it to newPrograms[] in the meantime.
            Validate data from newPrograms[]. If empty or invalid, then return error message.
            If success transfer data from newPrograms[] to programs[].
            Then push updated data of programs[] to local storage.
        */
        addProgram() {
            let verify = true;

            //Validate inputs
            if(this.newPrograms[0].end_date.length < 1){
                verify = false;
                this.error = true;
                this.msg = "End Date is empty!";
            }else if(Date.parse(this.newPrograms[0].end_date) < Date.parse(this.newPrograms[0].start_date)){
                verify = false;
                this.error = true;
                this.msg = "You cannot set less than start date!";
            }

            if(this.newPrograms[0].start_date.length < 1){
                verify = false;
                this.error = true;
                this.msg = "Start Date is empty!";
            }

            if(this.newPrograms[0].activity.length < 1){
                verify = false;
                this.error = true;
                this.msg = "Activities is empty!";
            }

            if(verify === true){
                this.programs[0].push({
                    activity: this.newPrograms[0].activity,
                    start_date: this.newPrograms[0].start_date,
                    end_date: this.newPrograms[0].end_date,

                });
                localStorage.setItem('nr_programs', JSON.stringify(this.programs[0]))
                this.newPrograms = [
                    {
                        activity: '',
                        start_date: '',
                        end_date: '',
                    }
                ]
                this.error = false;
            }
        },
        //remove deleted data in programs[] then update local storage
        removeProgram(index) {
            this.programs[0].splice(index, 1); 
            localStorage.setItem('nr_programs', JSON.stringify(this.programs[0]))
        },
    }
}

//Handles participant's table(add, remove, and retrieve data from local storage).
function participant_handler() {
    return {
        participants: [
            JSON.parse(localStorage.getItem('nr_participants')),
        ],
        newParticipants: [
            {
                first_name: '',
                last_name: '',
                section: '',
                participated_date: '',
            }
          ],
        error: false,
        msg: '',

        /* 
            Accepts array of input and store it to newParticipants[] in the meantime.
            Validate data from newParticipants[]. If empty or invalid, then return error message.
            If success transfer data from newParticipants[] to participants[].
            Then push updated data of participants[] to local storage.
        */
        addParticipant() {
            let verify = true;

            //Validate inputs
            if(this.newParticipants[0].participated_date.length < 1){
                verify = false;
                this.error = true;
                this.msg = "Date Participated is empty or invalid!";
            }
            if(this.newParticipants[0].section.length < 1){
                verify = false;
                this.error = true;
                this.msg = "Section is empty or invalid!";
            }
            if(this.newParticipants[0].last_name.length < 1){
                verify = false;
                this.error = true;
                this.msg = "Last Name is empty or invalid!";
            }

            if(this.newParticipants[0].first_name.length < 1){
                verify = false;
                this.error = true;
                this.msg = "First Name is empty or invalid!";
            }

            if(verify === true){
                this.participants[0].push({
                    first_name: this.newParticipants[0].first_name,
                    last_name: this.newParticipants[0].last_name,
                    section: this.newParticipants[0].section,
                    participated_date: this.newParticipants[0].participated_date,

                });
                localStorage.setItem('nr_participants', JSON.stringify(this.participants[0]))
                this.newParticipants = [
                    {
                        first_name: '',
                        last_name: '',
                        section: '',
                        participated_date: '',
                    }
                ]
                this.error = false;
                const participantContainer = document.getElementById('participant-container')
                participantContainer.scrollTop = participantContainer.scrollHeight - participantContainer.clientHeight
            }
        },

        //remove deleted data in participants[] then update local storage
        removeParticipant(index) {
            this.participants[0].splice(index, 1); 
            localStorage.setItem('nr_participants', JSON.stringify(this.participants[0]))
        },

        //Checks if  specific key exists in uploaded file
        isKeyExists(obj,key){
            if( obj[key] == undefined ){
                return false;
            }else{
                return true;
            }
        },

        /* 
            Will read and process uploaded csv file. If there's an error, will return error message.
           If no error push uploaded data to participants array and to local storage. 
        */  
        readCSV(){
            let csv_data;
            let verify = true;
            
            //Parse uploaded file and assign it to csv_data
            Papa.parse(document.getElementById('participants_csv').files[0],
            {
              download: true,
              header: true,
              skipEmptyLines: true,
              complete: function(results){
                    csv_data = results.data
              },
            })

            /* 
                Will wait for 500 miliseconds for csv_data to be filled before accessing its data
                If this is not implemented it will only return undefined object 
            */
            setTimeout( () => {

                /* Checks if uploaded file constains First Name, Last Name, Section, and Participated Date.
                   If one parameter is missing will return an error message. */
                if(!this.isKeyExists(csv_data[0], 'first_name') || 
                    !this.isKeyExists(csv_data[0], 'last_name') ||
                    !this.isKeyExists(csv_data[0], 'section') ||
                    !this.isKeyExists(csv_data[0], 'participated_date')){

                        verify = false;
                        this.error = true;
                        this.msg = "File must have the ff: First Name, Last Name, Section, and Date Participated columns";
                }

                //If no error encountered while uploading the file, then the data from csv_data will be pushed to participants array
                if(verify === true){
                    csv_data.forEach(data => {
                        this.participants[0].push({
                            first_name: data.first_name,
                            last_name: data.last_name,
                            section: data.section,
                            participated_date: data.participated_date
                        });
                    })
                    this.error = false;
                    localStorage.setItem('nr_participants', JSON.stringify(this.participants[0]))   
                }

            }, 500)        
        },

    }
}

//Handles comment's table(add, remove, and retrieve data from local storage).
function comment_suggestion_handler() {
    return {
        comments: [
            JSON.parse(localStorage.getItem('nr_comments')),
        ],

        newComments: [
            {
                message: '',

            }
          ],
        suggestions: [
            JSON.parse(localStorage.getItem('nr_suggestions')),
        ],

        newSuggestions: [
            {
                message: '',

            }
          ],
        
        ratings: [
            JSON.parse(localStorage.getItem('nr_ratings'))
        ],

        err_comments: false,
        msg_comments: '',
        err_suggestions: false,
        msg_suggestions: '',
        err_ratings: false,
        msg_ratings: '',

        /* 
            Accepts array of input and store it to newComments[] in the meantime.
            Validate data from newComments[]. If empty or invalid, then return error message.
            If success transfer data from newComments[] to comments[].
            Then push updated data of comments[] to local storage.
        */
        addComment() {
            let verify = true;

            //Validate inputs
            if(this.newComments[0].message.length < 1){
                verify = false;
                this.err_comments = true;
                this.msg_comments = "Message is empty or invalid!";
            }

            if(verify === true){
                this.comments[0].push({
                    message: this.newComments[0].message,


                });
                localStorage.setItem('nr_comments', JSON.stringify(this.comments[0]))
                this.newComments = [
                    {
                        message: '',

                    }
                ]
                this.err_comments = false;
            }
        },

        //remove deleted data in comments[] then update local storage
        removeComment(index) {
            this.comments[0].splice(index, 1); 
            localStorage.setItem('nr_comments', JSON.stringify(this.comments[0]))
        },

         /* 
            Accepts array of input and store it to newSuggestions[] in the meantime.
            Validate data from newSuggestions[]. If empty or invalid, then return error message.
            If success transfer data from newSuggestions[] to suggestions[].
            Then push updated data of suggestions[] to local storage.
        */
        addSuggestion() {
            let verify = true;

            //Validate inputs
            if(this.newSuggestions[0].message.length < 1){
                verify = false;
                this.err_suggestions = true;
                this.msg_suggestions = "Message is empty or invalid!";
            }

            if(verify === true){
                this.suggestions[0].push({
                    message: this.newSuggestions[0].message,


                });
                localStorage.setItem('nr_suggestions', JSON.stringify(this.suggestions[0]))
                this.newSuggestions = [
                    {
                        message: '',

                    }
                ]
                this.err_suggestions = false;
            }
        },

        //remove deleted data in suggestions[] then update local storage
        removeSuggestion(index) {
            this.suggestions[0].splice(index, 1); 
            localStorage.setItem('nr_suggestions', JSON.stringify(this.suggestions[0]))
        },

        //Checks if  specific key exists in uploaded file
        isKeyExists(obj,key){
            if( obj[key] == undefined ){
                return false;
            }else{
                return true;
            }
        },

        /* 
            Will read and process uploaded csv file. If there's an error, will return error message.
            If no error push uploaded data to participants array and to local storage. 
        */  
        readCSV(){
            let csv_data;
            let verify_comments_csv = true;
            let verify_suggestions_csv = true;
            let verify_ratings_csv = true;
            
            //Parse uploaded file and assign it to csv_data
            Papa.parse(document.getElementById('comments_csv').files[0],
            {
              download: true,
              header: true,
              skipEmptyLines: true,
              complete: function(results){
                    csv_data = results.data
              },
            })

            /* 
                Will wait for 500 miliseconds for csv_data to be filled before accessing its data
                If this is not implemented it will only return undefined object 
            */
            setTimeout( () => {

                /* Checks if uploaded file constains Comments.
                   If the parameter is missing will return an error message. */
                if(!this.isKeyExists(csv_data[0], 'comments')){
                    console.log(!this.isKeyExists(csv_data[0], 'comments'));
                        verify_comments_csv = false;
                        this.err_comments = true;
                        this.msg_comments = "File doesn't have Comments column!";
                }
                //If no error encountered while uploading the file, then the data from csv_data will be pushed to comments array
                if(verify_comments_csv === true){
                    csv_data.forEach(data => {
                        this.comments[0].push({
                            message: data.comments,
                        });
                    })
                    this.err_comments= false;
                    localStorage.setItem('nr_comments', JSON.stringify(this.comments[0]))   
                }

            }, 500)  
            
            setTimeout( ()=> {
                /* 
                    Checks if uploaded file constains Suggestions.
                    If the parameter is missing will return an error message. 
                */
                if(!this.isKeyExists(csv_data[0], 'suggestions')){

                    verify_suggestions_csv = false;
                    this.err_suggestions = true;
                    this.msg_suggestions = "File doesn't have Suggestions column!";
                }

                //If no error encountered while uploading the file, then the data from csv_data will be pushed to suggestions array
                if(verify_suggestions_csv === true){
                    csv_data.forEach(data => {
                        this.suggestions[0].push({
                            message: data.suggestions,
                        });
                    })
                    this.err_suggestions = false;
                    localStorage.setItem('nr_suggestions', JSON.stringify(this.suggestions[0])) 
                    
                }
            },700)

            setTimeout( ()=> {
                /* 
                    Checks if uploaded file constains Suggestions.
                    If the parameter is missing will return an error message. 
                */
                if(!this.isKeyExists(csv_data[0], 'ratings')){

                    verify_ratings_csv = false;
                    this.err_ratings = true;
                    this.msg_ratings = "File doesn't have Ratings column!";
                }

                //If no error encountered while uploading the file, then the data from csv_data will be pushed to suggestions array
                if(verify_ratings_csv === true){
                    this.ratings[0] = []
                    csv_data.forEach(data => {
                        this.ratings[0].push({
                            rating: data.ratings * 1,
                        });
                    })
                    this.err_ratings = false;
                    localStorage.setItem('nr_ratings', JSON.stringify(this.ratings[0])) ;
                    this.getTotalRating(); 
                }
            },900)
        },

        getTotalRating(){

            let total = 0;
            let rating = 0;

            this.err_ratings = false;
            this.msg_ratings = "";

            if(this.ratings[0].length > 0){
                this.ratings[0].forEach( element => {
                    total += element.rating
                })
              
                rating = total / (this.ratings[0].length)

                return rating;

            }else{
                return rating;
                
            }
        },

        storeInput($el){
            this.ratings[0] = [{rating :$el.value}]
            console.log(JSON.stringify(this.ratings[0]))
            localStorage.setItem("nr_ratings", JSON.stringify(this.ratings[0]))
           
        }
    }
}


/************************
 * 
 * Liquidation Form
 * 
 ************************/

//Handles liquidation_item table(add, remove, and retrieve data from local storage).
function liquidation_items_handler() {
    return {
        liquidations: [
            JSON.parse(localStorage.getItem('lf_liquidations')),
        ],

        newLiquidations: [
            {
                date_bought: '',
                item: '',
                price: '',
            }
          ],

        error: false,
        msg: '',

        /* 
            Accepts array of input and store it to newLiquidations[] in the meantime.
            Validate data from newLiquidations[]. If empty or invalid, then return error message.
            If success transfer data from newLiquidations[] to liquidations[].
            Then push updated data of liquidations[] to local storage.
        */
        addLiquidation() {
            let verify = true;

            //Validate inputs
            if(this.newLiquidations[0].price.length < 1){
                verify = false;
                this.error = true;
                this.msg = "Price is empty or invalid!";
            }
            if(this.newLiquidations[0].item.length < 1){
                verify = false;
                this.error = true;
                this.msg = "Particulars/Items is empty or invalid!";
            }
            if(this.newLiquidations[0].date_bought.length < 1){
                verify = false;
                this.error = true;
                this.msg = "Date Bought is empty or invalid!";
            }

            if(verify === true){
                this.liquidations[0].push({
                    item_number: this.liquidations[0].length + 1,
                    date_bought: this.newLiquidations[0].date_bought,
                    item: this.newLiquidations[0].item,
                    price: this.newLiquidations[0].price,

                });
                localStorage.setItem('lf_liquidations', JSON.stringify(this.liquidations[0]))
                this.newLiquidations = [
                    {
                        date_bought: '',
                        item: '',
                        price: '',
                    }
                ]
                this.error = false;
            }
        },

        //remove deleted data in liquidations[] then update local storage and item number 
        removeLiquidation(index) {
            count = 0;

            this.liquidations[0].splice(index, 1); 

            this.liquidations[0].forEach(item => {
                count++;
                item.item_number = count;
            })
            localStorage.setItem('lf_liquidations', JSON.stringify(this.liquidations[0]))
        },

        //Return total of 'price' field in liquidations[]
        getTotal() {
            let total = 0;
            this.liquidations[0].forEach(item => {
                total = total + JSON.parse(item.price)
            })

            return total;
        },
        getItemNumber(){
            return this.liquidations[0].length + 1
        }
    }
}


//Handles liquidation_item table(add, remove, and retrieve data from local storage).
function proof_of_payments() {
    return {
       rows: [],
       addNewRow(){
            this.rows.push({
                itemFrom: '',
                itemTo: '',
                image: '',
        })
       },
       removeRow(index){
        this.rows.splice(index, 1);
       },
    }
}

function liquidationTotal(){
    return{
        total:0,
        cashAdvance:0,
        deduct:0,

        setData($el){
            if($el.id === 'cash_advance'){
                this.cashAdvance = $el.value;
            }else if($el.id === 'deduct'){
                this.deduct = $el.value;
            }

            this.total = this.cashAdvance - this.deduct;

            this.getTotal();

        },

        onLoad(){
            this.cashAdvance = this.$refs.cashAdvance.value;
            this.deduct = this.$refs.deduct.value;

            this.total = this.cashAdvance - this.deduct;

            this.getTotal();
            
        },

        getTotal(){
            if(this.cashAdvance > 0 && this.deduct > 0){
                this.$refs.liquidationTotal.value = this.total;
            }else{
                this.$refs.liquidationTotal.value = 0;
            }
        }
    }
}
