<script setup>
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import Person from '@/Components/Person.vue';
import { onMounted, ref } from 'vue';
import orderEmbed from '@/Pages/Order/Order.embed.vue';


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
        
        <div>
            <orderEmbed :order="order"/>
        </div>
        <div>
            <h3>Total: ${{ order.total }}</h3>
        </div>
    </PublicLayout>
</template>
