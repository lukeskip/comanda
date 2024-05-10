<template>

    <div class="w-full md:w-1/4 p-4">
        <div class="card">
            
            <figure>
                <img :src="item.image" alt="Descripción de la imagen">
            </figure>
            <div class="info">
                <h3>{{ item.name }}</h3>
                <div class="price">{{ item.price }}</div>
                
                <p class="description">{{ item.description }}</p>
            </div>
            <footer>
                <button class="btn addItem" v-if="order" @click="addItem(item.id)">Ordenar</button>
            </footer>
            
        </div>
    </div>
    <Modal :show="showModal" @close="showModal = false" >
        <AddDishForm :formData="formData" :dish="item"/>
    </Modal>
</template>
<script setup>
import Categories from '@/Components/Categories.vue';
import Modal from '@/Components/Modal.vue';
import { onMounted,ref } from 'vue';
import AddDishForm from '@/Components/AddDishForm.vue'
const props = defineProps({
    item:{
        type:Object,
        required:true
    },
    order:{
        type:Number,
    },
});

const showModal= ref(false);
const formData= ref({});

const toggleModal = () => {
    console.log('debería de abrirse');
    showModal.value = !showModal.value;
};
const counter = ref(0);

const counterChange = (type)=>{
    if(type === 'minus' && counter.value > 0){
        counter.value -= 1;
    }

    if(type === 'plus'){
        counter.value += 1;
    }
}

const addItem = async(id)=>{
    formData.value = {
        dish_id:id,
        order:props.order,
        token:localStorage.getItem('token')
    }
    toggleModal();
    
}; 
</script>