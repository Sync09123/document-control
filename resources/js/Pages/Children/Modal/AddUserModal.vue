<template>

<slot :open="open" > </slot>

<q-dialog v-model="addDialog" persistent >
      <q-card style="width:500px">
        <q-card-section class="row items-center q-pb-none">
        <div class="font-bold text-lg">Add User</div>
        <q-space />
        <q-btn icon="close" flat round dense v-close-popup />
      </q-card-section>
        <q-card-section class="row items-center">
            <div class=" w-full"> 
           
                <q-form> 
                    <q-input class="py-1" outlined label="Firstname"/>

                    <q-input class="py-1" outlined label="Lastname"/>


                    <q-input class="py-1" outlined label="Middlename"/>

                    <div class="row justify-end"> 
                        <q-btn type="submit"  label="Submit" color="secondary" v-close-popup />
                    </div>

                </q-form>

            </div>
          
          
        </q-card-section>

   
      </q-card>
    </q-dialog>
  
</template>

<script>
import { ref } from 'vue'
export default {

    setup(){
        const addDialog = ref(false)

        return{
            addDialog,
            open:()=>{
                console.log('open')
                addDialog.value = true
            }
        }
    }
}
</script>

<style>

</style>