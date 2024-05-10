<template>
    <div class="modalForm">
        <h2>Personaliza tu platillo</h2>

        <div class="variations">
            <div class="variation" v-if="dish.variations" v-for="variation in dish.variations" >
                <h3>{{ variation.name }}:</h3>
                <div class="options">
                    <div v-for="option in variation.options">
                        <div class="option" @click="selectOption(variation, option)" :class="{ 'selected': isSelected(variation, option) }">{{option.label}} +${{option.price}}</div>
                    </div>
                </div>
            </div>
        </div>

        <label for="">Mensaje a la cocina</label>
        <textarea name="message" v-model="formData['message']"></textarea>
        <footer>
            <button class="btn" @click="addItem">Agregar</button>
            <div class="price">
                Total: ${{ checkPrice() }}
            </div>
        </footer>
    </div>
</template>
<script setup>
import { onMounted,ref } from 'vue';




const props = defineProps({
    dish:{
        type:Object,
    },
    formData:{
        type:Object
    }
});

const finalFormData  = ref({variations:{}});

onMounted(()=>{
    finalFormData.value = {...finalFormData.value,...props.formData,}; 
    console.log(props.formData);
});

const errors = ref({});

const checkMax = (variation)=>{
    if(finalFormData.value.variations[variation.name] && finalFormData.value.variations[variation.name].length >= variation.max){
        return false;
    }
    return true;
    
}

const selectOption = (variation,option)=>{

    if(!isSelected(variation,option)){
        if(checkMax(variation)){

            finalFormData.value = {
                ...finalFormData.value,
                variations: {
                    ...finalFormData.value.variations,
                    [variation.name]: [
                        ...(finalFormData.value.variations[variation.name] || []),
                        {...option }
                    ]
                }
            };
        } 
    }else{
        unselect(variation,option);
    }

   console.log(finalFormData.value);
}

const unselect = (variation,option)=>{
    finalFormData.value.variations[variation.name] = finalFormData.value.variations[variation.name].filter((item)=>{
            return item.name !== option.name
    });
}

const isSelected = (variation,option)=>{
    
    if(finalFormData.value.variations[variation.name]){

        const selected = finalFormData.value.variations[variation.name].find((item)=>{
            return item.name === option.name
        });

        if(selected){
            return true;
        }
    }

    
    return false;
    
}

const addItem = async()=>{
    checkVariations();
    try {
        const response = await axios.post(route('orders.add',props.formData.order),{
            ...props.formData
        });
    } catch (error) {
        console.log(error);
    }
}

const checkPrice = ()=>{
    console.log("se suman");
    let price = props.dish.price;
    for (const variation in finalFormData.value.variations) {
        
        const totalOptions = finalFormData.value.variations[variation].reduce((accumulator,option)=>{
            console.log("Esta es la opción",option);
            return accumulator + Number(option.price); 
        },0)

            price += totalOptions;
        
    }
    return price;
}








</script>