<template>
   <div class="loader" :class="{ 'show': store.state.loader }">
        <div class="spinner">
            <div></div>   
            <div></div>    
            <div></div>    
            <div></div>    
        </div>
   </div>
</template>
<script setup>
import {useStore} from 'vuex';
const store = useStore();
</script>