<template>
    <slot :open="open" ></slot>
   <q-dialog
      v-model="dialog"
      persistent
    >
      <q-card style="width: 900px; max-width: 80vw;">
        <q-card-section class="row items-center q-pb-none">
        
          <q-space />
          <q-btn icon="close" flat round dense v-close-popup />
        </q-card-section>

        <q-card-section class="q-pt-none">
            <UserTableVue />
        </q-card-section>

      </q-card>
    </q-dialog>
</template>

<script>
import { ref } from 'vue'

import UserTableVue from '@/Pages/Children/UserTable.vue'
export default {
components:{UserTableVue},
    setup(){
        const dialog = ref(true)
        return {
            open:()=>{
                dialog.value = true
                
            },
            dialog
        }
    }
}
</script>

<style>

</style>