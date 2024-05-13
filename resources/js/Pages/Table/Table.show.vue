<template>
    <Head title="Platillos mesa" />

    <PublicLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{table.restaurant.name}}</h2>
        </template>
        
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="">
                    
                    <Cards v-if="table.menu.dishes" :items="table.menu.dishes" :order="table.activeOrder.id"/>

                </div>
            </div>
        </div>
        <div class="bottomMenu">
            <PrimaryButton @click="toggleModal">
                Revisar la orden {{ table.activeOrder.ordered_dishes.length }} {{ table.activeOrder.total }}
            </PrimaryButton>
        </div>
        <Modal :show="showModal" @close="showModal = false" >
            <OrderEmbed :order="table.activeOrder" @close="toggleModal()"/>
        </Modal>
    </PublicLayout>
</template>
<script setup>
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import Cards from '@/Components/Cards.vue';
import { onMounted, ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Modal from '@/Components/Modal.vue';
import OrderEmbed from '../Order/Order.embed.vue';


const props = defineProps({
    table:{
        type:Object,
        required:true
    },
});

const showModal= ref(false);
const toggleModal = () => {
    showModal.value = !showModal.value;
};

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
    console.log(props.table);
    window.Echo.channel('channel-order')
    .listen('.order-updated', (event) => {
        if(event.item === props.table.activeOrder.id){
            router.reload();
        }
    });
});
</script>
