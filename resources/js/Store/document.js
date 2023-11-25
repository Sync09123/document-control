import axios from "axios";
import { defineStore } from "pinia";
import { ref } from "vue";


export const useDocumentStore = defineStore('document',()=>{


    const user = ref(null)
    const document = ref(null)

    const displayDocument = async(id)=>{
        const response =await axios.get(`http://127.0.0.1:8000/document/show/${id}`, {
            responseType: 'blob'
        })
        document.value =  window.URL.createObjectURL(new Blob([response.data]));
    }

    return {
        user,
        document,
        displayDocument
    }
})