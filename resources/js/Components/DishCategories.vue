<template>
    <div class="filtersPage">
        <div class="searchForm">
            <input type="text" placeholder="Buscar" v-model="searchInput"><PrimaryButton class="button" @click="searchTerm(searchInput)">Buscar</PrimaryButton>
        </div>
        <div class="categories">
            <div :class="[selected === category.slug ? 'selected' : '']"class="category" v-for="category in categories" @click="filter(category.slug)" >
                {{ category.label }}
            </div>
        </div>
    </div>
</template>
<script setup>
import { onMounted } from 'vue';
import { defineEmits } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {ref} from 'vue';

onMounted(()=>{
    console.log(props.categories);
})
const emit = defineEmits(['close']);
const searchInput = ref("");
const props = defineProps({
    categories:{
        type:Object,
        default:[]
    },
    selected:{
        type:String,
    },
    search:{
        type:Function,

    },
    cb:{
        type:Function,
        require:true,
    }
});

const filter = (slug)=>{
    emit('close');
    props.cb(slug);
}
const searchTerm = (slug)=>{
    emit('close');
    props.search(slug);
}
</script>