<template>
  <AppLayout title="Documents">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Documents
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <request-document />
          {{users}}
        </div>
      </div>
    </div>

    <div class="">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
         <DocumentTable/>
        
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import RequestDocument from "@/Pages/Children/RequestDocument.vue";

import DocumentTable from './Children/DocumentTable.vue';
export default {
    props:['users'],
  components: { 
    AppLayout, 
    RequestDocument ,
    DocumentTable},
};
</script>

<style>
</style>