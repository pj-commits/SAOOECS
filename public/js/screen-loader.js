function loader(){
   return{
        loading(isLoad){
            if(isLoad) {
                document.querySelector('#loader').style.display="block"
                if(document.readyState === "complete"){
                    setTimeout( () => {
                        document.querySelector('#loader').style.display="none"
                    }, 1000)
                }
            }
        }
   }    
}
  