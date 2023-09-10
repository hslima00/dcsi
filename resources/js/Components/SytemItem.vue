<template>
    <li>
        <!-- Display system name here -->
        {{ system.name }}

        <!-- Recursively render child systems if they exist -->
        <ul v-if="system.parent_system">
            <SytemItem :system="system.parent_system"></SytemItem>
        </ul>
    </li>
</template>

<script setup>
import SytemItem from "@/Components/SytemItem.vue";

const { system  } = defineProps({
    system: Object,
});
</script>
