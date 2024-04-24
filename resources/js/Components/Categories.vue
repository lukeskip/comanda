<template>
    <Link href="" v-if="items && items.length" v-for="item in items" class="mt-1 mx-1 inline-flex items-center px-3 py-1 bg-gray-200 text-gray-800 rounded-full text-xs">
        {{ item.label }}
    </Link>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
    const props = defineProps({
        items:{
            type:Object,
            required:true
        }
    })
</script>