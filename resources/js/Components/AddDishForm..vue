<template>
    <h3>Personaliza tu platillo</h3>
</template>
<script setup>

defineProps({
    variations:{
        type:Object,
        required:true
    }
});

const addItem = async()=>{
    try {
        const response = await axios.post(route('orders.add',props.order),{
        
        });
    } catch (error) {
        
    }
    
    
}
</script>