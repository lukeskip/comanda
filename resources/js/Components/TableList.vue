<template>
    <div class="tableList">
        <Link :href="route('orders.show',table.activeOrder)" class="tableItem" v-for="table in tables">
            <div class="tableNumber">{{ table.table_number }}</div>
            <div class="status">{{ table.activeOrder.status }}</div>
            <div class="total"><span class="money">{{ table.activeOrder.total }}</span></div>
        </Link>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    tables:{
        type:Array,
        required:true,
    }
    
})
</script>