<template>
    <h3>Personaliza tu platillo</h3>
    <button class="btn" @click="addItem">Agregar</button>
</template>
<script setup>
import { onMounted } from 'vue';


const props = defineProps({
    variations:{
        type:Object,
        // required:true
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