<template>
    <div class="modalForm">
        <h2>Personaliza tu platillo</h2>

        <div class="variations">
            <div class="variation" v-if="dish.dish.variations" v-for="variation in dish.dish.variations" >
                <h3>{{ variation.name }}:</h3>
                <div class="error" v-if="errors[variation.name]">{{ errors[variation.name] }}</div>
                <div class="options">
                    <div v-for="option in variation.options">
                        <div class="option" @click="selectOption(variation, option)" :class="{ 'selected': isSelected(variation, option) }">{{option.label}} +${{option.price}}</div>
                    </div>
                </div>
            </div>
        </div>

        <h3>Mensaje a la cocina</h3>
        <textarea name="message" v-model="finalFormData['message']"></textarea>
        <footer>
            <div>
                <button class="btn" @click="submitUpdateOrdered(dish.id)">Agregar</button>
                <button class="btn" @click="emit('close')">Cancelar</button>
            </div>
            <div class="price">
                Total: ${{ checkPrice() }}
            </div>
        </footer>
    </div>
</template>
<script setup>
import { onMounted,ref,defineEmits } from 'vue';
import {useStore} from 'vuex';
import errorHandler from '@/helpers/errorHandler';

const emit  = defineEmits(['close']);

const props = defineProps({
    dish:{
        type:Object,
    },
});

const finalFormData  = ref({variations:{}});
const errors = ref({});
const store = useStore();

onMounted(()=>{
    loadInfo();

});


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

const checkMin = ()=>{
    errors.value = {};
    props.dish.dish.variations.map((item)=>{
        const min = item.min;
        if(min > 0 && (!finalFormData.value.variations[item.name] || finalFormData.value.variations[item.name].length < min)){
            errors.value = {...errors.value, [item.name]:`Tienes que elegir al menos ${min} opciones`};
        }
    })

    if(Object.keys(errors.value).length){
        return false;
    }

    return true;
}

const loadInfo = ()=>{
    finalFormData.value.message = props.dish.message;
    props.dish.options.map((option)=>{
        const variationName = option.variation.name;
            if(finalFormData.value.variations[variationName]){

                finalFormData.value.variations[variationName] = [
                    ...finalFormData.value.variations[variationName],
                    option
                ];
            }else{
                finalFormData.value.variations[variationName] = [option];
            }
        
       
    });
}


const checkPrice = ()=>{
    
    let price = props.dish.price;
    for (const variation in finalFormData.value.variations) {
        
        const totalOptions = finalFormData.value.variations[variation].reduce((accumulator,option)=>{
            return accumulator + Number(option.price); 
        },0)

        price += totalOptions;
    }
    
    return price;
}



const submitUpdateOrdered = async (id)=>{
    
    if(checkMin()){
        try {
            
            store.commit('toggleLoader');
            const response = await axios.post(route('orderedDish.update', id), {
                id,
                token: localStorage.getItem('token'),
                ...finalFormData.value,
                _method: 'put',
            });
            store.commit('toggleLoader');
            emit('close');
        } catch (error) {
            errorHandler(error,store);
            console.log(error);
        }
    }
}




</script>