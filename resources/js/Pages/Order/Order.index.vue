<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { onMounted,ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import TableComponent from '@/Components/TableComponent.vue';


const props = defineProps({
    menus:{
        type:Object,
        required:true
    }
});

const tokenRef = ref();



onMounted(async()=>{
    
    window.Echo.private('channel-cart')
    .listen('.cart-item-added', (event) => {
        console.log('Evento CartItemAdded recibido:', event);
        // Manejar los datos del evento aquí
    });
});
</script>

<template>
    <Head title="Menus" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Lista de restaurantes</h2>
        </template>


        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    
                     <TableComponent :items="menus" :actions="['delete']" root="menus"/>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
