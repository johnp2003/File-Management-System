<template>
    <div class="px-2">
        <div class="file-item mt-0" v-for="file in files">
            <div class="image-item">
                <img :src="`/images/icons/files_type/${file.type}.png`">

            </div>
            <div class="file-details">
                <p class="file-name">{{ file.name }}</p>
                <p class="file-date">{{ file.created_at }}</p>
            </div>
            <div class="file-actions">
                <i @click="$event => download(file.id, file.name)" class="fa fa-cloud-download text-blue-600" aria-hidden="true"></i>
                <i @click="$event => deleteFile(file.id)" class="fa fa-trash text-red-600" aria-hidden="true"></i>
            </div>
        </div>
    </div>
    <input type="file" ref="uploadFile" @change="handleFileChange" style="display: none;">
    <div @click="openDialog" class="floating-icon">
        <i class="fa fa-cloud-upload" aria-hidden="true"></i>
    </div>
</template>
<script>
import Swal from 'sweetalert2';
export default {
    data(){
        return{
            files: [],
            selectedFile: null
        };
    },
    created: function(){
        this.getData();
    },
    watch:{
        selectedFile(){
            this.uploadFile();
        }
    },
    methods: {
        async getData(){
            try{
                const {data} = await axios.get('/api/file/get-data/'+this.$route.params.id); 
                this.files = data;  
                console.log(data);
            }catch (error){
                console.log(error);
            }
        },
        handleFileChange(event){
            this.selectedFile = event.target.files[0];
        },
        openDialog(){
            const elem = this.$refs.uploadFile;
            elem.click();
        },
        async uploadFile(){
            const formData = new FormData();
            formData.append('file', this.selectedFile);
            try{
                const {data} = await axios.post('/api/file/upload/'+this.$route.params.id, formData); 
                this.getData();
            }catch(error){
                console.log(error);
                Swal.fire(error?.response?.data?.message);
            }
        },
        async download(id, name){
            axios.get('/api/file/download/'+id, {responseType: 'blob'})
            .then(response => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', name);
                document.body.appendChild(link);
                link.click();
            })
            .catch(error=>{
                console.log(error);
            });
        },
        async deleteFile(id){
            try{
                const {data} = await axios.get('/api/file/delete/'+id);   
                if(data){
                    this.getData();
                }
            }catch (error){
                console.log(error);
                Swal.fire(error?.response?.data?.message);
            }
        },
    },
}
</script>