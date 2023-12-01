<template>
  <div class="shadow-lg text-white bg-secondary rounded-lg p-5">
    <div class="column">
        <div class="text-md font-semibold"> {{title}}</div>
        <div class="text-3xl font-bold py-2">  {{value}} </div>


    </div>

  </div>
</template>

<script>
export default {
    props:['title','value']
}
</script>

<style>

</style>