<script setup>
    import Menu from  '@/Components/Menu.vue';
    import Loader from '@/Components/Loader.vue';
</script>

<template>
    <div>
        <Loader/>
        <div class="min-h-screen bg-gray-100">
            
            <Menu/>
            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
