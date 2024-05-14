<template>
    <Head title="Platillos mesa" />

    <PublicLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{table.restaurant.name}}</h2>
        </template>
        
        <div class="py-12">
            <Cards v-if="dishes" :items="dishes" :order="table.activeOrder.id"/>
        </div>
        <div class="bottomMenu">
            <PrimaryButton @click="toggleModal()">
                Revisar la orden <span class="money">{{ table.activeOrder.total }}</span>
            </PrimaryButton>
            <PrimaryButton @click="toggleModal(true)">
                <i class="fa-solid fa-filter"></i>
            </PrimaryButton>
        </div>
        <Modal :show="showModal" @close="showModal = false" >
            <OrderEmbed :order="table.activeOrder" @close="toggleModal()"/>
        </Modal>
        <Modal :show="showModalFilter" @close="showModalFilter = false" >
            <DishCategories :search="search" :selected="selectedCategory" :categories="table.categories" :cb="filterByCategory" @close="toggleModal(true)"/>
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
import DishCategories from  '@/Components/DishCategories.vue'


const props = defineProps({
    table:{
        type:Object,
        required:true
    },
});

let dishes = ref([...props.table.menu.dishes]);
let selectedCategory = ref("");

const showModal= ref(false);
const showModalFilter= ref(false);

const toggleModal = (filter = false) => {
    console.log("filter",filter);
    if(!filter){
        console.log("debería mostrar la orden");
        showModal.value = !showModal.value;
    }else{
        showModalFilter.value = !showModalFilter.value;
        
    }
};

const search = (input)=>{
    dishes.value = props.table.menu.dishes.filter((dish)=>{
        return dish.name.toLowerCase().includes(input.toLowerCase()) || dish.description.toLowerCase().includes(input.toLowerCase());
    })
}

const filterByCategory = (category)=>{
    selectedCategory.value = category;
    dishes.value = props.table.menu.dishes.filter((dish)=>{
        return dish.categories.some((item)=>{
            return item.slug === category;
        })
    })
    window.scrollTo({
        top: 180,
        behavior: 'smooth'
    });
    
}


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
