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

        <div class="w-full py-2">
          <q-select
            outlined
            v-model="model"
            :options="options"
            label="Select Type"
          />
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

    </div>
  </div>
</template>

<script>
import { ref } from "vue";

import UserModal from './Modal/UserModal.vue';
export default {
    components: {UserModal},
  setup() {
    return {
      model: ref(null),
      options: ["Google", "Facebook", "Twitter", "Apple", "Oracle"],
    };
  },
};
</script>

<style>
</style>