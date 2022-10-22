function multipleUpload(){
    return{
        imgsrc:[],
        fileName: [],
        previewFile() {
            let files = this.$refs.multipleFile.files;
            this.fileName = [];
            this.imgsrc = [];
           
            Array.from(files).forEach(file => {
                if(!file || file.type.indexOf('image/') === -1) return;
                
                let reader = new FileReader();
    
                reader.onload = e => {
                    this.imgsrc.push(e.target.result);
                }
                this.fileName.push(file.name)
                reader.readAsDataURL(file)
    
            });
        }
    }
}

function singleUpload(){
    return{
        imgsrc:null,
        fileName: null,
        previewFile() {
            let file = this.$refs.singleFile.files[0];
            this.fileName = [];
            this.imgsrc = [];
           
            if(!file || file.type.indexOf('image/') === -1) return;
            let reader = new FileReader();

            reader.onload = e => {
                this.imgsrc = e.target.result;
            }
            this.fileName = file.name;

            reader.readAsDataURL(file)
        }
    }
}