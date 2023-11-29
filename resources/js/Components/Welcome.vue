<script >

import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Stat from '@/Components/Stat.vue'
export default{
    components:{Stat},
    props:['user'],
    setup(){
        
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
          
            <Stat title="Users" :value="299"/>

            <Stat/>
            <Stat/>
            <Stat/>

        
            
        </div>
    </div>
</template>
