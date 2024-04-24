<template>
    <Pagination :pagination="items.links"/>
    <div class="flex flex-wrap">
        <Card v-if="items" v-for="item in items.data" :item="item"/>
    </div>
</template>
<script setup>
    import Card from '@/Components/Card.vue'
    import Pagination from '@/Components/Pagination.vue'
    const props = defineProps({
        items:{
            type:Object,
            required:true,
        }
    })  
</script>