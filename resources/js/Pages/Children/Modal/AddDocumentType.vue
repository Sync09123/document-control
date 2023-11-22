<template>
  <slot :open="open"></slot>
  <q-dialog v-model="dialog" persistent>
    <q-card style="width: 400px; max-width: 80vw">
      <q-card-section class="row items-center q-pb-none">
        <div>Add Document Type </div>
        <q-space />
        <q-btn icon="close" flat round dense v-close-popup />
      </q-card-section>

      <q-card-section class="p-5">
       

            <div>
                <q-input v-model="name" dense outlined label="Name"/>
            </div>

            <div class="row justify-end py-1">
                <ConfirmDialog @onSubmit="onSubmit" >

                    <template v-slot="{open}">
                        <q-btn  @click="open" type="submit" color="secondary" label="Submit"/>
                    </template>
                    
                </ConfirmDialog>
               

            </div>


        
    </q-card-section>
    </q-card>
  </q-dialog>
</template>

<script>
import { ref } from "vue";
import ConfirmDialog from '@/Components/ConfirmDialog.vue'
import { router } from "@inertiajs/vue3";
export default {
    components:{ConfirmDialog},
  setup() {
    const dialog = ref(false);
    const name = ref('')
    return {
      open: () => {
        dialog.value = true;
      },
      dialog,
      name,
      onSubmit:async()=>{

         router.post(route('documentType.create',{name:name.value}))

        console.log('submit',)
      }
    };
  },
};
</script>

<style>
</style>