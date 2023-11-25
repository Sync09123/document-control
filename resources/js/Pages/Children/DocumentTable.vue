<template>
  <div>
    <q-table
      :title="title ?? 'Table'"
      :rows="documents"
      :columns="columns"
      row-key="name"
    >
      <template #body="props">
        <q-tr :props="props">
          <q-td key="user" :props="props">
            {{ props.row.user_info.full_name }}
          </q-td>
          <q-td key="document_type" :props="props">
            {{ props.row.document_type.name }}
          </q-td>
          <q-td key="date" :props="props">
            {{ formatDate(props.row.created_at,'MMMM DD YYYY') }}
          </q-td>
          <q-td key="prepared_by" :props="props">
            {{ props.row.user.name }}
          </q-td>

          <q-td key="action" :props="props">
          
            <view-document >

              <template v-slot="{open}" >
                <q-btn color="secondary" @click="open(props.row.id)" label="View"/>

              </template>
            </view-document>
          </q-td>
        </q-tr>
      </template>
    </q-table>
  </div>
</template>
  
  <script>
import { usePage } from "@inertiajs/vue3";
import { ref } from "vue";
import formatDate from '@/Util/date'
import ViewDocument from '@/Pages/Children/Modal/ViewDocument.vue'

const columns = [
  {
    name: "user",
    required: true,
    label: "Requested By:",
    align: "left",
    //   field: row => row.user.full_name,
    format: (val) => `${val}`,
    sortable: true,
  },
  {
    name: "document_type",
    align: "center",
    label: "Document Type",
    field: "calories",
    sortable: true,
  },
  { name: "date", label: "Date Requested", field: "fat", sortable: true },
  { name: "prepared_by", label: "Prepared by", field: "carbs" },
  {
    name: "action",
    label: "Action",
    align: "center",
  },
];
export default {
  props: ["title"],
  components:{ViewDocument},
  setup() {
    const page = usePage();
    const documents = ref(page.props.documents);

    return {
      columns,
      documents,
      formatDate
    };
  },
};
</script>
  