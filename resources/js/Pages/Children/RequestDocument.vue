<template>
  <div class="row">
    <div class="p-10 col-6 column justify-start">
      <div class="p-5 text-lg font-bold">Request Document</div>
      <div class="column w-[500px] p-5 items-start">
        <div class="column w-full">
          <span class="py-2"> Requested by:</span>

          <UserModal>
            <template v-slot="{ open }">
              <q-btn @click="open" color="secondary" label="Select User" />
            </template>
          </UserModal>
        </div>

        <div class="w-full row py-2">
          <q-select
            dense
            class="col-9"
            outlined
            v-model="documentType"
            :options="documentTypes"
            label="Select Type"
         
          />
          <div class="p-1 row col-3">
            <add-document-type>
              <template v-slot="{ open }">
                <q-btn
                  @click="open"
                  dense
                  color="secondary"

                  class=""
                  label="Add"
                  style="width: 100%"
                />
              </template>
            </add-document-type>
          </div>
        </div>
        <q-uploader
          label="Upload File"
          @upload="upload"
          @added="added"
         hide-upload-btn
        
          style="width: 100%"
          accept=".pdf, .docx"
          :factory="upload"
        />
      </div>
    </div>

    <div class="p-10 col-6 column justify-start">
      <div class="p-5 text-lg font-bold">Request Details</div>
      <div class="column p-5">
        <div class="flex">
          <span class="font-bold w-32" >Firstname: </span>
          <span class="px-1" >{{ user ? user.firstname :'--' }} </span>
        </div>
        <div class="flex">
          <span class="font-bold  w-32">Lastname: </span>
          <span class="px-1" >{{  user ? user.lastname  :'--'}} </span>
        </div>
        <div class="flex">
          <span class="font-bold w-32">Middlename: </span>
          <span class="px-1"  >{{ user ? user.middlename:'--' }} </span>
        </div>

        <div class="flex">
          <span  class="font-bold w-32">Document Type: </span>
          <span class="px-1" >{{ documentType ? documentType.label : '--' }} </span>
        </div>

        <div>
          <q-btn color="secondary" :disable="!user && !documentType" @click="upload" label="Save"/>

            
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, watchEffect } from "vue";
import { useDocumentStore } from "@/Store/document";
import { storeToRefs } from "pinia";
import UserModal from "./Modal/UserModal.vue";
import { usePage } from "@inertiajs/vue3";
import AddDocumentType from "./Modal/AddDocumentType.vue";
import { router } from "@inertiajs/vue3";
export default {
  components: { UserModal, AddDocumentType },

  setup() {
    const page = usePage();
    const documentTypes = ref(null);

    watchEffect(() => {
      if (page.props.documentType) {
        documentTypes.value = page.props.documentType.map((item) => {
          return {
            label: item.name,
            value: item.id,
          };
        });
      }
    
    });

    const documentStore = useDocumentStore();
    const { user } = storeToRefs(documentStore);
    const documentType = ref(null)
    const file = ref(null)

    return {
      user,
      model: ref(null),
      options: ["Google", "Facebook", "Twitter", "Apple", "Oracle"],
      documentTypes,
      documentType,
      added:(files)=>{
        file.value = files[0]
     
      },
      upload(){

       
        const fileData = new FormData()
        fileData.append('file_path', file.value)
        fileData.append('user_info_id', user.value.id)
        fileData.append('document_type_id', documentType.value.value)

        router.post(route('upload'),fileData,{
          forceFormData:true
        })

      }
    };
  },
};
</script>

<style>
</style>