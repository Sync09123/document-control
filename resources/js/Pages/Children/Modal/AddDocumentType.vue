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

            <div class="text-red-400" v-if="errors.name">
{{errors.name}}
            </div>

                <q-input v-model="name" dense outlined label="Name"/>
            </div>

            <div class="row justify-end py-1">
                <ConfirmDialog :message="`Confirm adding ${name}?`" @onSubmit="onSubmit" >

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
import { computed, ref, watchEffect } from "vue";
import ConfirmDialog from '@/Components/ConfirmDialog.vue'
import { router, usePage } from "@inertiajs/vue3";
export default {
    components:{ConfirmDialog},

  
  setup() {
    const page = usePage()
    const dialog = ref(false);
    const name = ref('')
    const bag = computed(() => Object.keys(page.props.errorBags).length > 0);

    const errors = computed(()=>page.props.errors)

    watchEffect(() => {
      if (!bag.value) {
        dialog.value = false;
      }
    });

 
    return {
      open: () => {
        dialog.value = true;
      },
      dialog,
      name,errors,


      onSubmit:async()=>{

         router.post(route('documentType.create',{name:name.value}),{
          preserveState: (page) => Object.keys(page.props.errors).length > 0,
        })

         
      }
    };
  },
};
</script>

<style>
</style>