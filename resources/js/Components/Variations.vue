<template>
    <div class="variations">
        <div class="variation" v-if="variations" v-for="variation in variations">
            <h3>{{ variation.name }}</h3>
            <div class="options">
                <div v-for="option in variation.options" class="option">
                    {{option.name}}
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    const props = defineProps({
        variations:{
            type:Array,
            required:true
        }
    });
</script>