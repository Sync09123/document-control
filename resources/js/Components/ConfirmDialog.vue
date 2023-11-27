<template>
  
  <slot :open="open"> </slot>
  <q-dialog v-model="confirm" persistent>
      <q-card>
        <q-card-section class="row items-center">
          <q-avatar color="secondary" text-color="white" :icon="icon ?? 'question_mark' " />
          <span class="q-ml-sm text-lg">{{message}}</span>
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
    props:['message','icon'],
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