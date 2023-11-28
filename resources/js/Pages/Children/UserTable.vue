<template>
  <div>
    <q-table
      :filter="filter"
      :columns="columns"
      :rows="users"
      row-key="full_name"
    >
      <template v-slot:top-right>
        <q-input
          v-model="filter"
          borderless
          dense
          debounce="300"
          placeholder="Search"
        >
          <template v-slot:append>
            <q-icon name="search" />
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

      <template v-slot:body="props">
        <q-tr :props="props" @dblclick="onRowClick(props.row)">

          <q-td key="firstname" :props="props">
            {{ props.row.lastname }}
         
            <q-popup-edit @update:model-value="onEdit" v-model="props.row.lastname" title="Edit the Name" auto-save v-slot="scope">
              <q-input v-model="scope.value" dense autofocus counter @keyup.enter="scope.set" />
            </q-popup-edit>
          </q-td>
          <q-td key="firstname" :props="props">
            {{ props.row.firstname }}
            
            <q-popup-edit v-model="props.row.firstname" title="Edit the Name" auto-save v-slot="scope">
              <q-input v-model="scope.value" dense autofocus counter @keyup.enter="scope.set" />
            </q-popup-edit>
          </q-td>
          <q-td key="birthdate" :props="props">
            {{ props.row.birthdate }}
          </q-td>

          <q-td key="contact" :props="props">
            {{ props.row.contact }}
          </q-td>

          <q-td key="address" :props="props">
            {{ props.row.address }}
          </q-td>
          <q-td key="actions" :props="props">
            <div class="px-5">
          
              <ConfirmDialog @onSubmit="onDelete(props.row.id)" :iconColor="'red'" :icon="'delete_forever'" :message="`Are you sure you wamt to delete ${props.row.full_name}`">
                
                <template v-slot="{open}">
                  <q-btn
                  @click="open"
                  size="1em"
                  class="glossy mx-1"
                  round

                  color="red"
                  icon="delete"
              />
                </template>
               

              </ConfirmDialog>
           
            </div>
          </q-td>
        </q-tr>
      </template>
    </q-table>
  </div>
</template>
  
  <script>
import AddUserModal from "./Modal/AddUserModal.vue";
import { router, usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import { useDocumentStore } from "@/Store/document";
import { storeToRefs } from "pinia";

import ConfirmDialog from '@/Components/ConfirmDialog.vue';
const columns = [
{
    name: "lastname",
    required: true,
    label: "Last Name",
    align: "left",
    field: (row) => row.lastname,
    format: (val) => `${val}`,
    sortable: true,
  },
  {
    name: "firstname",
    required: true,
    label: "Full Name",
    align: "left",
    field: (row) => row.firstname,
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
    label: "Address",
    align: "left",
    field: (row) => row.address,
    format: (val) => `${val}`,
  },
  {
    name: "actions",
    label: "Actions",
    align: "center",
  },
];

export default {
  components: { AddUserModal ,ConfirmDialog},
  emits: ["selectUser"],

  setup(props, { emit }) {
    const page = usePage();
    const users = computed(() => page.props.users);
    const documentStore = useDocumentStore();
    const { user } = storeToRefs(documentStore);

    return {
      columns,
      users,
      filter: ref(""),
      onRowClick: (row) => {
        user.value = row;
        emit("selectUser");
      },
      onDelete:(id)=>{
        console.log('id',id)
        router.delete(route('user.destroy',id))
      },
      onEdit:(value)=>{

        
        console.log('edit',value)
      }
    };
  },
};
</script>
  