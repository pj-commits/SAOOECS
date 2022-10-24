function search(){
    return{
        forms:[],
        results: [],
        total: '',
        size: 2,
        pageNumber: 0,

        addForms(encryptedForms){
            let myForms = JSON.parse(atob(encryptedForms))

            myForms.forEach(form => {
                this.forms.push({
                    id: form.id,
                    organization: form.organization,
                    eventTitle: form.eventTitle,
                    formType: form.formType,
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
                    this.results = filtered;
                    this.total = this.results.length;

                 }else{
                    let filter = this.$refs.filter.value;
    
                    let filtered = this.forms.filter(form => {
                        if((form.organization.toLowerCase().includes($el.value.toLowerCase()) || form.eventTitle.toLowerCase().includes($el.value.toLowerCase())) && form.formType === filter){
                           return form;
                        }
                    })
                    this.results = filtered;
                    this.total = this.results.length;
                }
                
            }, 500)
        },

        filter($el){
            if($el.value === ''){
                if(this.$refs.searchTerm.value === ''){
                    this.results = this.forms;
                    this.total = this.results.length;
                }else{
                    this.searchTerm(this.$refs.searchTerm)
                }
            }else if(this.$refs.searchTerm.value === ''){
                let filtered = this.forms.filter(form => {
                    if(form.formType === $el.value){
                        return form;
                    }
                })
                this.results = filtered
            }else{
                this.searchTerm(this.$refs.searchTerm)
            }
            
        },

        viewForm(id){
            window.location.assign('submitted-forms/details/'+id)
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
            this.pageNumber++;
          },

          //Previous Page
          prevPage() {
            this.pageNumber--;
          },

          //Total number of pages
          pageCount() {
            console.log(this.total)
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

    }
}