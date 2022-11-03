//Handles coorganizer's table for Edit (add, remove, and retrieve data from local storage). 
function coorganizer_handler_edit() {
    return {
        coorganizers: [[]],

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


        loadCoorganizer(proposal){
            let parsedProposal = JSON.parse(proposal);

            parsedProposal.forEach(item => {
                this.coorganizers[0].push({
                    coorganization: item.coorganization,
                    name: item.coorganizer,
                    phone: item.phone_number,
                    email: item.email,
                });
            });
            this.isEmpty();
        },

        /* 
            Accepts array of input and store it to newCoorganizers[] in the meantime.
            Validate data from newCoorganizers[]. If empty or invalid, then return error message.
            If success transfer data from newCoorganizers[] to coorganizers[].
            Then push updated data of coorganizers[] to local storage.
        */
        addCoorganizer() {
            let verify = true;
            let alphabet = /^[a-zA-Z ]+$/;
            let reg_email = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            let reg_phone = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;
            
            //Validate inputs
            this.newCoorganizers.forEach(coorganizer => {
                if(coorganizer.email.length < 1){
                    verify = false;
                    this.error = true;
                    this.msg = "Email is empty or invalid!";
                }else if(!coorganizer.email.match(reg_email)){
                    verify = false;
                    this.error = true;
                    this.msg = "Email is empty or invalid!";
                }
                if(coorganizer.phone.length < 1){
                    verify = false;
                    this.error = true;
                    this.msg = "Contact is empty or invalid!";
                }else if (!coorganizer.phone.match(reg_phone)){
                    verify = false;
                    this.error = true;
                    this.msg = "Contact is empty or invalid!";
                }
                if(coorganizer.name.length < 1 || !coorganizer.name.match(alphabet)){
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
                this.newCoorganizers = [
                    {
                        coorganization: '',
                        name: '',
                        phone: '',
                        email: '',
                    }
                ]
                this.error = false;
                this.isEmpty();
            }   
        },
        //remove deleted data in coorganizers[] then update local storage
        removeCoorganizer(index) {
            this.coorganizers[0].splice(index, 1);
            this.isEmpty();
        },

        //checks if coorganizers is empty
        isEmpty(){
            if(this.coorganizers[0].length > 0){
                this.$refs.coorganizers.value = "notempty";
            }else{
                this.$refs.coorganizers.value = "";
            }
        }
    }
}


//Handles logistic's table for edit (add, remove, and retrieve data from local storage).
function logistic_handler_edit() {
    return {
        logistics: [[]],

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

        loadRequests(requests){
            let parsedRequests = JSON.parse(requests);

            parsedRequests.forEach(item => {
                this.logistics[0].push({
                    service: item.service,
                    date_needed: item.date_needed,
                    venue: item.venue,
                });
            });
            this.isEmpty();
        },

        /* 
            Accepts array of input and store it to newLogistics[] in the meantime.
            Validate data from newLogistics[]. If empty or invalid, then return error message.
            If success transfer data from newLogistics[] to logistics[].
            Then push updated data of logistics[] to local storage.
        */
        addLogistic() {
            let alphaNumeric = /^[a-zA-Z0-9 ]+$/;
            let verify = true;

            //Validate inputs
            if(this.newLogistics[0].venue.length < 1 || !this.newLogistics[0].venue.match(alphaNumeric)){
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

            if(this.newLogistics[0].service.length < 1 || !this.newLogistics[0].service.match(alphaNumeric) ){
                verify = false;
                this.error = true;
                this.msg = "Items/Service/Support is empty or invalid!";
            }

            if(verify === true){
                this.logistics[0].push({
                    service: this.newLogistics[0].service,
                    date_needed: this.newLogistics[0].date_needed,
                    venue: this.newLogistics[0].venue,

                });
                this.newLogistics = [
                    {
                        service: '',
                        date_needed: '',
                        venue: '',
                    }
                ]
                this.error = false;
                this.isEmpty();
            }   
        },
        //remove deleted data in logistics[] then update local storage
        removeLogistic(index) {
            this.logistics[0].splice(index, 1); 
            this.isEmpty();
        },

        //checks if logistics is empty
        isEmpty(){
            if(this.logistics[0].length > 0){
                this.$refs.logistics.value = "notempty";
            }else{
                this.$refs.logistics.value = "";
            }
        }
    }
}


//Handles activity's table(add, remove, and retrieve data from local storage).
function activity_handler_edit() {
    return {
        activities: [[]],

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


        loadPrograms(programs){
            let parsedPrograms = JSON.parse(programs);

            parsedPrograms.forEach(item => {
                this.activities[0].push({
                    activity: item.activity,
                    start_date: item.start_date_time,
                    end_date: item.end_date_time,
                });
            });
            this.isEmpty();
        },

        /* 
            Accepts array of input and store it to newActivities[] in the meantime.
            Validate data from newActivities[]. If empty or invalid, then return error message.
            If success transfer data from newActivities[] to activities[].
            Then push updated data of activities[] to local storage.
        */
        addActivity() {
            let alphaNumeric = /^[a-zA-Z0-9 ]+$/;
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
            if(this.newActivities[0].activity.length < 1 || !this.newActivities[0].activity.match(alphaNumeric)){
                verify = false;
                this.error = true;
                this.msg = "Activities is empty or invalid!";
            }

            if(verify === true){
                this.activities[0].push({
                    activity: this.newActivities[0].activity,
                    start_date: this.newActivities[0].start_date,
                    end_date: this.newActivities[0].end_date,

                });
                this.newActivities = [
                    {
                        activity: '',
                        start_date: '',
                        end_date: '',
                    }
                ]
                this.error = false;
                this.isEmpty();
            }
        },
        //remove deleted data in activities[] then update local storage
        removeActivity(index) {
            this.activities[0].splice(index, 1); 
            this.isEmpty();
        },

        //checks if activities is empty
        isEmpty(){
            if(this.activities[0].length > 0){
                this.$refs.activities.value = "notempty";
            }else{
                this.$refs.activities.value = "";
            }
        }
    }
}


/************************
 * 
 * Budget Requisition Form
 * 
 ************************/

//Handles requisition_items table(add, remove, and retrieve data from local storage).
function requisition_items_handler_edit() {
    return {
        requisitions: [[]],

        newRequisitions: [
            {
                quantity: '',
                purpose: '',
                price: '',
            }
          ],

        error: false,
        msg: '',

        loadItems(items){
            let parsedItems = JSON.parse(items);

            parsedItems.forEach((item, index) => {
                this.requisitions[0].push({
                    item_number: index+1,
                    quantity: item.quantity,
                    purpose: item.purposes,
                    price: item.price,
                });
            });
            this.isEmpty();
        },

        /* 
            Accepts array of input and store it to newRequisitions[] in the meantime.
            Validate data from newRequisitions[]. If empty or invalid, then return error message.
            If success transfer data from newRequisitions[] to requisitions[].
            Then push updated data of requisitions[] to local storage.
        */
        addRequisition() {
            let alphaNumeric = /^[a-zA-Z0-9 ]+$/;
            let verify = true;

            //Validate inputs
            if(this.newRequisitions[0].price.length < 1){
                verify = false;
                this.error = true;
                this.msg = "Price is empty or invalid!";
            }
            if(this.newRequisitions[0].quantity.length < 1){
                verify = false;
                this.error = true;
                this.msg = "Quantity is empty or invalid!";
            }
            if(this.newRequisitions[0].purpose.length < 1 || !this.newRequisitions[0].purpose.match(alphaNumeric)){
                verify = false;
                this.error = true;
                this.msg = "Purpose is empty or invalid!";
            }

            if(verify === true){
                this.requisitions[0].push({
                    item_number: this.requisitions[0].length + 1,
                    quantity: this.newRequisitions[0].quantity,
                    purpose: this.newRequisitions[0].purpose,
                    price: this.newRequisitions[0].price,

                });
                this.newRequisitions = [
                    {
                        quantity: '',
                        purpose: '',
                        price: '',
                    }
                ]
                this.error = false;
                this.isEmpty();
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
            this.isEmpty();
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
        },

         //checks if requisitions is empty
         isEmpty(){
            if(this.requisitions[0].length > 0){
                this.$refs.items.value = "notempty";
            }else{
                this.$refs.items.value = "";
            }
        }
    }
}

/************************
 * 
 * Narrative Report
 * 
 ************************/

//Handles program's table for edit (add, remove, and retrieve data from local storage).
function program_handler_edit() {
    return {
        programs: [[]],

        newPrograms: [
            {
                activity: '',
                start_date: '',
                end_date: '',
            }
          ],

        error: false,
        msg: '',

        loadPrograms(programs){
            let parsedPrograms = JSON.parse(programs);

            parsedPrograms.forEach(item => {
                this.programs[0].push({
                    activity: item.activity,
                    start_date: item.start_date,
                    end_date: item.end_date,
                });
            });
            this.isEmpty();
        },


        /* 
            Accepts array of input and store it to newPrograms[] in the meantime.
            Validate data from newPrograms[]. If empty or invalid, then return error message.
            If success transfer data from newPrograms[] to programs[].
            Then push updated data of programs[] to local storage.
        */
        addProgram() {
            let alphaNumeric = /^[a-zA-Z0-9 ]+$/;
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

            if(this.newPrograms[0].activity.length < 1 || !this.newPrograms[0].activity.match(alphaNumeric)){
                verify = false;
                this.error = true;
                this.msg = "Activities is empty or invalid!";
            }

            if(verify === true){
                this.programs[0].push({
                    activity: this.newPrograms[0].activity,
                    start_date: this.newPrograms[0].start_date,
                    end_date: this.newPrograms[0].end_date,

                });
                this.newPrograms = [
                    {
                        activity: '',
                        start_date: '',
                        end_date: '',
                    }
                ]
                this.error = false;
                this.isEmpty();
            }
        },
        //remove deleted data in programs[] then update local storage
        removeProgram(index) {
            this.programs[0].splice(index, 1); 
            this.isEmpty();
        },

        //checks if programs is empty
        isEmpty(){
            if(this.programs[0].length > 0){
                this.$refs.programs.value = "notempty";
            }else{
                this.$refs.programs.value = "";
            }
        }
    }
}


//Handles participant's table for edit(add, remove, and retrieve data from local storage).
function participant_handler_edit() {
    return {
        participants: [[]],
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

        loadParticipants(participants){
            let parsedParticipants = JSON.parse(participants);

            parsedParticipants.forEach(item => {
                this.participants[0].push({
                    first_name: item.first_name,
                    last_name: item.last_name,
                    section: item.section,
                    participated_date: item.participated_date,
                });
            });
            this.isEmpty();
        },

        /* 
            Accepts array of input and store it to newParticipants[] in the meantime.
            Validate data from newParticipants[]. If empty or invalid, then return error message.
            If success transfer data from newParticipants[] to participants[].
            Then push updated data of participants[] to local storage.
        */
        addParticipant() {
            let alphabet = /^[a-zA-Z ]+$/;
            let alphaNumeric = /^[a-zA-Z0-9 \n\r-]+$/;
            let verify = true;

            //Validate inputs
            if(this.newParticipants[0].participated_date.length < 1){
                verify = false;
                this.error = true;
                this.msg = "Date Participated is empty or invalid!";
            }
            if(this.newParticipants[0].section.length < 1 || !this.newParticipants[0].section.match(alphaNumeric)){
                verify = false;
                this.error = true;
                this.msg = "Section is empty or invalid!";
            }
            if(this.newParticipants[0].last_name.length < 1 || !this.newParticipants[0].last_name.match(alphabet)){
                verify = false;
                this.error = true;
                this.msg = "Last Name is empty or invalid!";
            }

            if(this.newParticipants[0].first_name.length < 1 || !this.newParticipants[0].first_name.match(alphabet)){
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
                this.newParticipants = [
                    {
                        first_name: '',
                        last_name: '',
                        section: '',
                        participated_date: '',
                    }
                ]
                this.error = false;
                this.isEmpty();
                const participantContainer = document.getElementById('participant-container')
                participantContainer.scrollTop = participantContainer.scrollHeight - participantContainer.clientHeight
            }
        },

        //remove deleted data in participants[] then update local storage
        removeParticipant(index) {
            this.participants[0].splice(index, 1); 
            this.isEmpty();
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
                transformHeader:function(header) { 				
                    return header.replace(/\s/g, ''); 			
                },
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
                if(!this.isKeyExists(csv_data[0], 'FirstName') || 
                    !this.isKeyExists(csv_data[0], 'LastName') ||
                    !this.isKeyExists(csv_data[0], 'Section') ||
                    !this.isKeyExists(csv_data[0], 'ParticipatedDate')){

                        verify = false;
                        this.error = true;
                        this.msg = "File must have the ff: First Name, Last Name, Section, and Date Participated columns";
                }
                //If no error encountered while uploading the file, then the data from csv_data will be pushed to participants array
                if(verify === true){
                    csv_data.forEach(data => {
                        this.participants[0].push({
                            first_name: data.FirstName,
                            last_name: data.LastName,
                            section: data.Section,
                            participated_date: data.ParticipatedDate
                        });
                    })
                    this.error = false;
                    this.isEmpty();
                }

            }, 500)        
        },

        //checks if participants is empty
        isEmpty(){
            if(this.participants[0].length > 0){
                this.$refs.participants.value = "notempty";
            }else{
                this.$refs.participants.value = "";
            }
        }

    }
}

//Handles comment's table for edit (add, remove, and retrieve data from local storage).
function comment_suggestion_handler_edit() {
    return {
        comments: [[]],

        newComments: [
            {
                message: '',

            }
          ],
        suggestions: [[]],

        newSuggestions: [
            {
                message: '',

            }
          ],
        
        ratings: [[]],

        err_comments: false,
        msg_comments: '',
        err_suggestions: false,
        msg_suggestions: '',
        err_ratings: false,
        msg_ratings: '',

        loadCommentsSuggestions(commentsSuggestions){
            let parsedComSug = JSON.parse(commentsSuggestions);

            parsedComSug.forEach(item => {
                if(item.type === 'comment'){
                    this.comments[0].push({
                        message: item.message,
                    });
                }
                else{
                    this.suggestions[0].push({
                        message: item.message,
                    });
                }
               
            });
            this.isEmptyComments();
            this.isEmptySuggestions();
        },

        loadRatings(ratings){
            let parsedRatings = JSON.parse(ratings);
            this.ratings[0].push({
                rating: parsedRatings * 1,
            })
            this.getTotalRating();
        },

        /* 
            Accepts array of input and store it to newComments[] in the meantime.
            Validate data from newComments[]. If empty or invalid, then return error message.
            If success transfer data from newComments[] to comments[].
            Then push updated data of comments[] to local storage.
        */
        addComment() {
            let alphaNumeric = /^[a-zA-Z0-9 \n\r-]+$/;
            let verify = true;

            //Validate inputs
            if(this.newComments[0].message.length < 1 || !this.newComments[0].message.match(alphaNumeric)){
                verify = false;
                this.err_comments = true;
                this.msg_comments = "Message is empty or invalid!";
            }

            if(verify === true){
                this.comments[0].push({
                    message: this.newComments[0].message,


                });
                this.newComments = [
                    {
                        message: '',

                    }
                ]
                this.err_comments = false;
                this.isEmptyComments();
            }
        },

        //remove deleted data in comments[] then update local storage
        removeComment(index) {
            this.comments[0].splice(index, 1); 
            this.isEmptyComments();
        },

         /* 
            Accepts array of input and store it to newSuggestions[] in the meantime.
            Validate data from newSuggestions[]. If empty or invalid, then return error message.
            If success transfer data from newSuggestions[] to suggestions[].
            Then push updated data of suggestions[] to local storage.
        */
        addSuggestion() {
            let alphaNumeric = /^[a-zA-Z0-9 \n\r-]+$/;
            let verify = true;

            //Validate inputs
            if(this.newSuggestions[0].message.length < 1 || !this.newSuggestions[0].message.match(alphaNumeric)){
                verify = false;
                this.err_suggestions = true;
                this.msg_suggestions = "Message is empty or invalid!";
            }

            if(verify === true){
                this.suggestions[0].push({
                    message: this.newSuggestions[0].message,


                });

                this.newSuggestions = [
                    {
                        message: '',

                    }
                ]
                this.err_suggestions = false;
                this.isEmptySuggestions();
            }
        },

        //remove deleted data in suggestions[] then update local storage
        removeSuggestion(index) {
            this.suggestions[0].splice(index, 1); 
            this.isEmptySuggestions();
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
                    this.isEmptyComments();
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
                    this.isEmptySuggestions();
                    
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

        //checks if comments is empty
        isEmptyComments(){
            if(this.comments[0].length > 0){
                this.$refs.comments.value = "notempty";
            }else{
                this.$refs.comments.value = "";
            }
        },

        //checks if suggestions is empty
        isEmptySuggestions(){
            if(this.suggestions[0].length > 0){
                this.$refs.suggestions.value = "notempty";
            }else{
                this.$refs.suggestions.value = "";
            }
        }
    }
}


/************************
 * 
 * Liquidation Form
 * 
 ************************/

//Handles liquidation_item table(add, remove, and retrieve data from local storage).
function liquidation_items_handler_edit() {
    return {
        liquidations: [[]],

        newLiquidations: [
            {
                date_bought: '',
                item: '',
                price: '',
            }
          ],

        error: false,
        msg: '',

        loadItems(items){
            let parsedItems = JSON.parse(items);

            parsedItems.forEach((item, index) => {
                this.liquidations[0].push({
                    item_number: index + 1,
                    date_bought: item.date_bought,
                    item: item.item,
                    price: item.price,
                });
            });
            this.isEmpty();
        },

        /* 
            Accepts array of input and store it to newLiquidations[] in the meantime.
            Validate data from newLiquidations[]. If empty or invalid, then return error message.
            If success transfer data from newLiquidations[] to liquidations[].
            Then push updated data of liquidations[] to local storage.
        */
        addLiquidation() {
            let alphaNumeric = /^[a-zA-Z0-9 ]+$/;
            let verify = true;

            //Validate inputs
            if(this.newLiquidations[0].price.length < 1){
                verify = false;
                this.error = true;
                this.msg = "Price is empty or invalid!";
            }
            if(this.newLiquidations[0].item.length < 1 || !this.newLiquidations[0].item.match(alphaNumeric)){
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
                this.newLiquidations = [
                    {
                        date_bought: '',
                        item: '',
                        price: '',
                    }
                ]
                this.error = false;
                this.isEmpty();
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
            this.isEmpty();
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
        },

         //checks if liquidation is empty
         isEmpty(){
            if(this.liquidations[0].length > 0){
                this.$refs.items.value = "notempty";
            }else{
                this.$refs.items.value = "";
            }
        }
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

//Handles liquidation_item table(add, remove, and retrieve data from local storage).
function proof_of_payments_edit() {
    return {
       rows: [],

       onLoad(){
            this.isEmpty();
       },

       addNewRow(){
            this.rows.push({
                itemFrom: '',
                itemTo: '',
                image: '',
            })
            this.isEmpty();
       },
       removeRow(index){
            this.rows.splice(index, 1);
            this.isEmpty();
       },

        //checks if proof of payments is empty
        isEmpty(){
            if(this.rows.length > 0){
                this.$refs.proof_of_payments.value = "notempty";
            }else{
                this.$refs.proof_of_payments.value = "";
            }
        }
       
    }
}
