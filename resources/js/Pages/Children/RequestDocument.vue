<template>
  <div class="row">
    <div class="p-10 col-6 column justify-start">
      <div class="p-5 text-lg font-bold">Request Document</div>
      <div class="column w-[500px] p-5 items-start">
        <div class="column w-full">
          <span class="py-2"> Requested by:</span>

          <UserModal >
            <template v-slot="{ open }">
                <q-btn @click="open" color="secondary" label="Select User" />
            </template>
            
          </UserModal>
        
        </div>

        <div class="w-full  row py-2">
          <q-select
          dense
         class="col-9"
            outlined
            v-model="model"
            :options="options"
            label="Select Type"
          />
          <div class="p-1 row col-3 ">
            <add-document-type> 
              <template v-slot="{open}">
                <q-btn @click="open" dense color="secondary"  class=""  label="Add" style="width:100%"/>
              </template>
            </add-document-type>
          
          </div>
       
        </div>
        <q-uploader
          label="Upload File"
          url="http://localhost:4444/upload"
          style="width: 100%"
        />
      </div>
    </div>

    <div class="p-10 col-6 column justify-start"> 
        <div class="p-5 text-lg font-bold">Request Details</div>
       <div class="column p-5">
        <div > 
          <span>Firstname </span>
          <span v-if="user">{{user.firstname }} </span>
          
        </div>
        <div > 
          <span>Lastname </span>
          <span  v-if="user">{{user.lastname}} </span>
          
        </div>
        <div > 
          <span>Middlename </span>
          <span  v-if="user">{{user.middlename}} </span>
          
        </div>

       </div>

    </div>
  </div>
</template>

<script>
import { ref } from "vue";
import {useDocumentStore} from '@/Store/document'
import { storeToRefs } from 'pinia'
import UserModal from './Modal/UserModal.vue';

import AddDocumentType from './Modal/AddDocumentType.vue';
export default {
    components: {UserModal,AddDocumentType},

  setup() {


    const documentStore = useDocumentStore()
      const {user} = storeToRefs(documentStore)

    return {
      user,
      
      model: ref(null),
      options: ["Google", "Facebook", "Twitter", "Apple", "Oracle"],
    };
  },
};
</script>

<style>
</style>