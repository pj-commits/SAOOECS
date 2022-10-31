function inputChecker(){
    return{
        forms: [],
        id: null,

        addEventTitle(form){
            parsedForms = JSON.parse(form);

            parsedForms.forEach(form => {
                this.forms.push({
                    id: form.id,
                    title: form.event_title
                })
            });
             
        },

        setId(id){
            this.id = id;
        },

        getEventTitle(){
            let setEventTitle = this.forms.filter((form) => {
                if(form.id === this.id) return form;
            })

            return setEventTitle[0].title
        },

        clearInputField(){
            setTimeout( () => {
                this.$refs.inputField.value = "";
                this.$refs.formId.value = this.id;
            }, 50)
            
        },

        checkInput($el){
            let eventTitle = this.getEventTitle();

            if($el.value === eventTitle) {
                this.$refs.button.classList.remove('bg-gray-500', 'hover:bg-gray-400', 'cursor-not-allowed');
                this.$refs.button.classList.add('bg-semantic-danger', 'hover:bg-rose-600', 'cursor-pointer');
                this.$refs.button.type = 'submit';
            }else{
                this.$refs.button.classList.remove('bg-semantic-danger', 'hover:bg-rose-600', 'cursor-pointer');
                this.$refs.button.classList.add('bg-gray-500', 'hover:bg-gray-400', 'cursor-not-allowed');
                this.$refs.button.type = 'button';
            }
        },
    }    
 }