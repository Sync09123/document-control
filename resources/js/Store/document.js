import { defineStore } from "pinia";
import { ref } from "vue";


export const useDocumentStore = defineStore('document',()=>{


    const user = ref(null)

    return {
        user
    }
})