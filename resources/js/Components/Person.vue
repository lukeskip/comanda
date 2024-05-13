<template>
    <div class="person">
        <h2>Persona {{person.index}}</h2>
        <div v-for="ordered in person.orders" v-if="person" class="dish">
            <h3>{{ ordered.dish.name }}</h3>
            <div class="options">
                <div v-for="option in ordered.options" class="option">
                    <div>{{ option.label }}</div>
                    <div>${{ option.price }}</div>
                </div>
                <div class="option">
                    {{ ordered.message }}
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
const props = defineProps({
    person:{
        type:Object,
        required:true
    }
});


</script>