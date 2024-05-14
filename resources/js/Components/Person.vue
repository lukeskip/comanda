<template>
    <div class="person">
        <h2>Persona {{person.index}}</h2>
        <div v-for="ordered in person.orders" v-if="person" class="dish">
            <div class="title">
                <h3>{{ ordered.dish.name }}</h3>
                <div class="actions">

                   <div class="action" >
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                   <div class="action" @click="deleteOrdered(ordered.id)">
                    <i class="fa-solid fa-trash"></i>
                    </div>
         
                </div>
            </div>
            <div class="info">
                <div class="options">
                    <div v-for="option in ordered.options" class="option">
                        <div>{{ option.label }}</div>
                        <div>${{ option.price }}</div>
                    </div>
                    <div class="option">
                        {{ ordered.message }}
                    </div>
                </div>
            </div>
            <div class="price">
            ${{ ordered.price }}
            </div>
        </div>
        <div class="total">
            Total persona {{ person.index }}: <span class="money">{{ person.total }}</span>
        </div>
    </div>
</template>
<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {router} from '@inertiajs/vue3';
import {useStore} from 'vuex';

const props = defineProps({
    person:{
        type:Object,
        required:true
    }
});
const store = useStore();
const deleteOrdered = async (id)=>{
    
    try {
        
        store.commit('toggleLoader');
        const response = await axios.delete(route('orderedDish.destroy',id));
        store.commit('toggleLoader');
    } catch (error) {
        console.log(error);
    }
}
</script>