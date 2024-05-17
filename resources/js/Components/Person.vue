<template>
    <div class="person">
        <h2>Persona {{person.index}}</h2>
        <div v-for="ordered in person.orders" v-if="person" class="dish">
            <div class="title">
                <h3>{{ ordered.dish.name }}</h3>

                <div class="actions" v-if="edit">

                   <div class="action" @click="updateOrdered(ordered)">
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
        <Modal :show="showModal">
            <EditDishForm  :dish="item" @close="toggleModal()"/>
        </Modal>
    </div>
</template>
<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {router} from '@inertiajs/vue3';
import {useStore} from 'vuex';
import errorHandler from '@/helpers/errorHandler.js';
import Modal from '@/Components/Modal.vue';
import EditDishForm from '@/Components/EditDishForm.vue';
import {ref} from 'vue';

const props = defineProps({
    person:{
        type:Object,
        required:true
    },
    edit:{
        type:Boolean,
        default:false
    }
});
const store = useStore();
const showModal= ref(false);
const item = ref();

const updateOrdered = (ordered) => {
    item.value = ordered;
    showModal.value = !showModal.value;
};


const toggleModal = () => {
    showModal.value = !showModal.value;
};

const deleteOrdered = async (id)=>{
    
    try {
        
        store.commit('toggleLoader');
        const response = await axios.delete(route('orderedDish.destroy', id), {
            data: {
                token: localStorage.getItem('token')
            }
        });
        store.commit('toggleLoader');
    } catch (error) {
        errorHandler(error,store);
        console.log(error);
    }
}
</script>