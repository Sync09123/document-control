<script >

import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Stat from '@/Components/Stat.vue'
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
export default{
    components:{Stat},
    props:['user'],
    setup(){


        const page = usePage()


        return{
            userCount : computed(()=>page.props.user_count),
            documentCount: computed(()=>page.props.document_count),
            requestToday:computed(()=>page.props.request_today),
            requestMonth:computed(()=>page.props.request_month)
        }

         
        
    }
}
</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <div class="text-4xl"> Dashboard</div>

            <h1 class="mt-8 text-2xl font-medium text-gray-900">
                Welcome  {{user.name}}!
            </h1>

          
        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-2 md:grid-cols-4 gap-6 lg:gap-8 p-6 lg:p-8">
          
            <Stat title="Users" :value="userCount"/>

            <Stat :title="'Number of Documents'" :value="documentCount"/>
            <Stat :title="'Today\'s Request'" :value="requestToday"/>
            <Stat :title="'Request this month'" :value="requestMonth"/>
       
        
            
        </div>
    </div>
</template>
