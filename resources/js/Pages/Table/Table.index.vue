<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { onMounted,ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import TableList from '@/Components/TableList.vue';


const props = defineProps({
    tables:{
        type:Object,
        required:true
    }
});

const tokenRef = ref();



onMounted(async()=>{
    
    window.Echo.channel('channel-order')
    .listen('.order-updated', (event) => {
        if(event.item === props.table.activeOrder.id){
            router.reload();
        }
    });
});
</script>

<template>
    <Head title="Mesas" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mesas de {{ tables[0].restaurant.name }}</h2>
        </template>

       <div>
            <TableList v-if="tables && tables.length" :tables="tables"/>
            <div v-else>No hay mesas abiertas</div>
       </div>
    </AuthenticatedLayout>
</template>
