<template>
    <div>
        <Loader  />
        <slot name="content" />
    </div>
</template>
<script setup>
import {useStore} from 'vuex';
import Loader from '@/Components/Loader.vue';
const store = useStore();


</script>