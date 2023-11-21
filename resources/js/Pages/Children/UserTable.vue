<template>
  <div>
  
    <q-table :filter="filter" :columns="columns" :rows="users" row-key="full_name">
      <template v-slot:top-right>
        <q-input v-model="filter" borderless dense debounce="300" placeholder="Search">
          <template v-slot:append>
            <q-icon  name="search" />
          </template>
        </q-input>
      </template>
      <template v-slot:top-left>
        <AddUserModal>
          <template v-slot="{ open }">
            <q-btn @click="open" color="secondary" label="Add user" />
          </template>
        </AddUserModal>
      </template>
    </q-table>
  </div>
</template>
  
  <script>
import AddUserModal from "./Modal/AddUserModal.vue";
import { usePage } from "@inertiajs/vue3";
import { computed, ref } from 'vue';

const columns = [
  {
    name: "full_name",
    required: true,
    label: "Full Name",
    align: "left",
    field: (row) => row.full_name,
    format: (val) => `${val}`,
    sortable: true,
  },
  {
    name: "birthdate",
    align: "center",
    label: "Date of Birth",
    field: (row) => row.birthdate,
    sortable: true,
  },
  {
    name: "contact",
    required: true,
    label: "Contact",
    align: "left",
    field: (row) => row.contact,
    format: (val) => `${val}`,
  },
  {
    name: "address",
    required: true,
    label: "Full Name",
    align: "left",
    field: (row) => row.address,
    format: (val) => `${val}`,
  },
];

export default {
  components: { AddUserModal },

  setup() {
    const page = usePage();
    const users = computed(()=>page.props.users)

    
    return {
      columns,
      users,
      filter:ref('')
    };
  },
};
</script>
  