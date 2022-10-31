function search(){
    return{
        forms:[],
        results: [],
        total: '',
        size: 10,
        pageNumber: 0,
        form_dictionary: 
        {
          'APF': 'Activity Proposal Form',
          'BRF': 'Budget Requisition Form',
          'NR': 'Narrative Report',
          'LF': 'Liquidation Form',
        },

        addForms(encryptedForms){

            let myForms = JSON.parse(atob(encryptedForms))

            myForms.forEach(form => {
                this.forms.push({
                    id: form.id,
                    organization: form.organization,
                    eventTitle: form.eventTitle,
                    formType: form.formType,
                    status: form.status,
                    formDescription: this.form_dictionary[form.formType],
                    date: form.date, //Date Submitted or Date Ended
                })
            });

            this.$refs.filter. value = "";
            this.$refs.searchTerm.value = "";
            this.results = this.forms;
            this.total = this.results.length;
        },

        formList(){
            let start = this.pageNumber * this.size;
            let end =  start + this.size

            return this.results.slice(start, end);
        },

        searchTerm($el){

            setTimeout(()=> {
                if(this.$refs.filter.value === ""){
                    let filtered = this.forms.filter(form => {
                        if(form.organization.toLowerCase().includes($el.value.toLowerCase()) || form.eventTitle.toLowerCase().includes($el.value.toLowerCase())){
                            return form;
                        }
                    })
                    this.setTotal(filtered);

                 }else{
                    let filter = this.$refs.filter.value;
    
                    let filtered = this.forms.filter(form => {
                        if((form.organization.toLowerCase().includes($el.value.toLowerCase()) || form.eventTitle.toLowerCase().includes($el.value.toLowerCase())) && form.formType === filter){
                           return form;
                        }
                    })
                    this.setTotal(filtered);
                }
                
            }, 500)
        },

        filter($el){

            if($el.value === ''){
                if(this.$refs.searchTerm.value === ''){
                    this.setTotal(this.forms);
                 
                }else{
                    this.searchTerm(this.$refs.searchTerm)
                }
            }else if(this.$refs.searchTerm.value === ''){
                let filtered = this.forms.filter(form => {
                    if(form.formType === $el.value){
                        return form;
                    }
                })
                this.setTotal(filtered);
            }else{
                this.searchTerm(this.$refs.searchTerm);
            }
            
        },

        setTotal(forms){
            this.results = forms;
            this.total = this.results.length;
            this.pageNumber = 0;

        },

        isResultsEmpty(){
            if(this.results.length > 0){
                return false;
            }
            return true;
        },

        //Create array of all pages (for loop to display page numbers)
        pages() {
            return Array.from({
              length: Math.ceil(this.total / this.size),
            });
          },

          //Next Page
          nextPage() {
            if(this.pageNumber < this.total - 1){
                this.pageNumber++;
            }
          },

          //Previous Page
          prevPage() {
            if(this.pageNumber != 0){
                this.pageNumber--;
            }
          },

          isFirstPage(){
            if(this.pageNumber === 0){
                return true;
            }
            return false;
          },

          isLastPage(){
            if(this.pageNumber === this.total - 1){
                return true;
            }
            return false;
          },

          //Total number of pages
          pageCount() {
            return Math.ceil(this.total / this.size);
          },

          //Return the start range of the paginated results
          startResults() {
            return this.pageNumber * this.size + 1;
          },

          //Return the end range of the paginated results
          endResults() {
            let resultsOnPage = (this.pageNumber + 1) * this.size;

            if (resultsOnPage <= this.total) {
              return resultsOnPage;
            }

            return this.total;
          },

          //Link to navigate to page
          viewPage(index) {
            this.pageNumber = index;
          },

          viewForm(id, type){
            console.log(type)
            if(type == 'pdf'){
                window.location.assign('records/download/pdf/'+id)
            }else{
                window.location.assign('submitted-forms/details/'+id)
            }
          
        },

    }
}