<script setup>
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import Person from '@/Components/Person.vue';
import { onMounted, ref } from 'vue';


const props = defineProps({
    order:{
        type:Object,
        required:true
    },
});


onMounted(()=>{
    window.Echo.channel('channel-order')
    .listen('.order-updated', (event) => {
        console.log('la señal llega');
        if(event.item === props.order.id){
            router.reload();
        }
    });
});
</script>


<template>
    <Head title="Platillos mesa" />

    <PublicLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Orden</h2>
        </template>
        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div v-for="user in order.users" v-if="order.users">
                        <Person/>
                    </div>

                </div>
            </div>
        </div>
        <div>
            <h3>Total: ${{ order.total }}</h3>
        </div>
    </PublicLayout>
</template>
