<template>
    <div class="modalForm">
        <h3>Personaliza tu platillo</h3>
        <Variations :variations="variations"/>
        <button class="btn" @click="addItem">Agregar</button>
    </div>
</template>
<script setup>
import { onMounted } from 'vue';
import Variations from '@/Components/Variations.vue'


const props = defineProps({
    variations:{
        type:Object,
    },
    formData:{
        type:Object
    }
});

onMounted(()=>{
    console.log(props.formData);
})

const addItem = async()=>{
    try {
        const response = await axios.post(route('orders.add',props.formData.order),{
            ...props.formData
        });
    } catch (error) {
        console.log(error);
    }
    
    
}
</script>