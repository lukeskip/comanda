<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import TableComponent from '@/Components/TableComponent.vue';

const props = defineProps({
    restaurants:{
        type:Object,
        required:true
    }
});
</script>

<template>
    <Head title="Restaurantes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Lista de restaurantes</h2>
        </template>


        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    
                     <TableComponent :items="restaurants" :actions="['delete']" root="restaurants"/>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
