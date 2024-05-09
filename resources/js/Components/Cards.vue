<template>
  
    <div class="flex flex-wrap">
        <Card v-if="items" v-for="item in items" :item="item" :order="order"/>
    </div>
</template>
<script setup>
    import Card from '@/Components/Card.vue'
    import { onMounted } from 'vue';
    
    const props = defineProps({
        items:{
            type:Array,
            required:true,
        },
        order:{
            type:Number,
        }
    });

</script>