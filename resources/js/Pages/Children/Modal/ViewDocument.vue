<template>
  
  <slot :open="open" > </slot>

  <q-dialog  v-model="dialog">
      <q-card style="width: 900px; max-width: 80vw;">
        <q-card-section class="row items-center q-pb-none">
          <div class="text-h6">Close icon</div>
          <q-space />
          <q-btn icon="close" flat round dense v-close-popup />
        </q-card-section>

        <q-card-section>
            <iframe :src="document" width="100%" height="1000" frameborder="0"></iframe>
        </q-card-section>
      </q-card>
    </q-dialog>


</template>


<script>
import {useDocumentStore} from '@/Store/document'
import {  ref } from 'vue'
import { storeToRefs } from 'pinia'
export default {

    setup(){

        const dialog = ref(false)
        const documentStore = useDocumentStore()

        const {document } = storeToRefs(documentStore)

      

        return{
            dialog,
            open:(val)=>{
                dialog.value= true
                console.log('ooopen',val)
                documentStore.displayDocument(val)
            },
            document
        }
    }
}
</script>

<style>

</style>