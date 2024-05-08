<script setup>
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import Cards from '@/Components/Cards.vue';
import { onMounted, ref } from 'vue';


const props = defineProps({
    table:{
        type:Object,
        required:true
    },
});

const tokenRef = ref();

const setToken = ()=>{
    let token = localStorage.getItem('token');

    if (!token) {
        console.log('no hay token');
        const tokenLength = 32;
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

        let token = '';
        for (let i = 0; i < tokenLength; i++) {
            const randomIndex = Math.floor(Math.random() * characters.length);
            token += characters.charAt(randomIndex);
        }
        localStorage.setItem('token', token);
    }
    tokenRef.value = token;
}

onMounted(()=>{
    setToken();

    window.Echo.channel('channel-order')
    .listen('.order-updated', (event) => {
        if(event.item === props.table.activeOrder.id){
            router.reload();
        }
    });
});
</script>


<template>
    <Head title="Platillos mesa" />

    <PublicLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Restaurante</h2>
        </template>

        {{ table.activeOrder.dishes.length }}
        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    
                    <Cards v-if="table.menu.dishes" :items="table.menu.dishes" :order="table.activeOrder.id"/>

                </div>
            </div>
        </div>
    </PublicLayout>
</template>
