<template>

    <div class="w-full md:w-1/4 p-4">
        <div class="bg-white rounded-lg shadow-md p-4">
            <figure>
                <img :src="item.image" alt="Descripción de la imagen">
            </figure>
            <div class="h-40">
                <h3 class="mt-4 text-lg font-bold">{{ item.name }}</h3>
                <p class="">{{ item.description }}</p>
                <div class="mt-2">
                    <Categories :items="item.categories"/>
                </div>
               
            </div>
        </div>
    </div>

</template>
<script setup>
import Categories from '@/Components/Categories.vue';
const props = defineProps({
    item:{
        type:Object,
        required:true
    }
})
</script>