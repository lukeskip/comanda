<template>

    <div class="w-full md:w-1/4 p-4">
        <div class="bg-white rounded-lg shadow-md p-4">
            <figure>
                <img :src="item.image" alt="Descripción de la imagen">
            </figure>
            <div class="h-40">
                <h3 class="mt-4 text-lg font-bold">{{ item.name }}</h3>
                <p class="">{{ item.description }}</p>
                <button class="addItem" v-if="order" @click="addItem(item.id)"> agregar</button>
                <div class="mt-2">
                    <Categories v-if="item.categories" :items="item.categories"/>
                </div>
               
            </div>
        </div>
    </div>

</template>
<script setup>
import Categories from '@/Components/Categories.vue';
import axios from 'axios';
import { onMounted } from 'vue';
const props = defineProps({
    item:{
        type:Object,
        required:true
    },
    order:{
        type:Number,
    },
});

onMounted(()=>{
    // console.log(props);
})

const addItem = async(id)=>{
    const response = await axios.post(route('orders.add',props.order),{
        dish_id:id
    });
    console.log(response);
}; 
</script>