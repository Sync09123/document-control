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
        <q-form>

            <div>
                <q-input dense outlined label="Name"/>
            </div>

            <div class="row justify-end py-1">
                <q-btn type="submit" color="secondary" label="Submit"/>

            </div>


        </q-form>
        
    </q-card-section>
    </q-card>
  </q-dialog>
</template>

<script>
import { ref } from "vue";

export default {
  setup() {
    const dialog = ref(false);
    return {
      open: () => {
        dialog.value = true;
      },
      dialog,
    };
  },
};
</script>

<style>
</style>