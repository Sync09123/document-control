<template>
  
  <slot :open="open"> </slot>
  <q-dialog v-model="confirm" persistent>
      <q-card>
        <q-card-section class="row items-center">
          <q-avatar icon="signal_wifi_off" color="primary" text-color="white" />
          <span class="q-ml-sm">You are currently not connected to any network.</span>
        </q-card-section>

        <q-card-actions align="right">
          <q-btn flat label="Cancel" color="primary" v-close-popup />
          <q-btn flat @click="submit" label="Submit" color="primary" v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>
</template>

<script>
import { ref } from 'vue'
export default {
    emits:['onSubmit'],
    setup(props,{emit}){
        const confirm = ref(false)

        return {
            confirm,
            open:()=>{
                confirm.value = true
            },
            submit:()=>{
                emit('onSubmit')
            }
        }
    }

}
</script>

<style>

</style>