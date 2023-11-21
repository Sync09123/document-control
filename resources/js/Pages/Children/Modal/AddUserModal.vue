<template>
  <slot :open="open"> </slot>

  <q-dialog v-model="addDialog" persistent>
    <q-card style="width: 500px">
      <q-card-section class="row items-center q-pb-none">
        <div class="font-bold text-lg">Add User</div>
        <q-space />
        <q-btn icon="close" flat round dense v-close-popup />
      </q-card-section>
      <q-card-section class="row items-center">
        <div class="w-full">
          <q-form @submit.prevent="onSubmit">
            <q-input v-model="form.firstname" class="py-1" outlined label="Firstname" />

            <q-input v-model="form.lastname" class="py-1" outlined label="Lastname" />

            <q-input v-model="form.middlename" class="py-1" outlined label="Middlename" />

            <q-input outlined v-model="form.birthdate" label="Birth Date" mask="date" >
              <template v-slot:append>
                <q-icon name="event" class="cursor-pointer">
                  <q-popup-proxy
                    cover
                    transition-show="scale"
                    transition-hide="scale"
                  >
                    <q-date v-model="form.birthdate">
                      <div class="row items-center justify-end">
                        <q-btn
                          v-close-popup
                          label="Close"
                          color="primary"
                          flat
                        />
                      </div>
                    </q-date>
                  </q-popup-proxy>
                </q-icon>
              </template>
            </q-input>
            
            <q-input  v-model="form.contact" class="py-1" outlined label="Contact" />
            <q-input v-model="form.address" class="py-1" type="textarea" outlined label="Address" />

            <div class="row justify-end">
              <q-btn type="submit" label="Submit" color="secondary" />
            </div>
          </q-form>
        </div>
      </q-card-section>
    </q-card>
  </q-dialog>
</template>

<script>
import { router } from "@inertiajs/vue3";
import { ref } from "vue";
export default {
  setup() {
    const addDialog = ref(false);
    const form = ref({
      firstname: "",
      lastname: "",
      middlename: "",
      contact: "",
      birthdate: "",
      contact: "",
      address: "",
    });

    return {
      addDialog,
      form,
      open: () => {
        console.log("open");
        addDialog.value = true;
      },
      router,
      onSubmit: () => {
        router.post(route("user.create", form.value));
      },
    };
  },
};
</script>

<style>
</style>