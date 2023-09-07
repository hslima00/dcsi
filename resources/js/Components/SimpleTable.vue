<template>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mt-8">
            <ul>
                <SytemItem v-for="system in props.systems" :key="system.id" :system="system"></SytemItem>
            </ul>
        </div>
    </div>
</template>


<script setup>

import SytemItem from "@/Components/SytemItem.vue";

// Helper function to create a hierarchical structure

const props = defineProps({
    systems: Array,
});

</script>
