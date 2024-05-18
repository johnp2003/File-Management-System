<template>
    <div class="p-3">
        <div class="mb-5">
            <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Folder Name</label>
            <input v-model="formData.name" type="text" id="large-input" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <button @click="changeFolderName" type="button" class="text-white mt-2 w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update</button>
            <button @click="deleteFolder" type="button" class="text-white w-full bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-500 dark:hover:bg-red-500 focus:outline-none dark:focus:ring-red-500">Delete</button>
        </div>
    </div>
</template>
<script>
import Swal from 'sweetalert2';
    export default {
    data(){
        return{
            formData:{
                name: ""
            }
        };
    },
    created: function(){
        this.getFolderName();
    },
    methods: {
        async getFolderName(){
            try{
                const {data} = await axios.get('/api/folder/edit/'+this.$route.params.id);   
                this.formData.name = data.name;  
            }catch (error){
                console.log(error);
                Swal.fire(error?.response?.data?.message);
            }
        },
        async changeFolderName(){
            try{
                const {data} = await axios.post('/api/folder/edit/'+this.$route.params.id, this.formData);   
                if(data){
                    this.$router.push({name:'Home'});
                }
            }catch (error){
                console.log(error);
                Swal.fire(error?.response?.data?.message);
            }
        },
        async deleteFolder(){
            try{
                const {data} = await axios.get('/api/folder/delete/'+this.$route.params.id);   
                if(data){
                    this.$router.push({name:'Home'});
                }
            } catch (error){
                console.log(error);
                Swal.fire(error?.response?.data?.message);
            }
        }
    },
}
</script>