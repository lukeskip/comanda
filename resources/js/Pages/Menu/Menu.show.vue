<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Cards from '@/Components/Cards.vue';

const props = defineProps({
    menu:{
        type:Object,
        required:true
    }
});
</script>

<template>
    <Head title="Restaurantes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detalle de menu</h2>
        </template>


        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    
                    <Cards v-if="menu.dishes" :items="menu.dishes"/>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
