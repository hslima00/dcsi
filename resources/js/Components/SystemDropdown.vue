<template>
    <div>
        <template v-for="(dropdown, index) in dropdowns" :key="index">
            <select
                v-model="dropdown.selected"
                class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
            >
                <option value="">Select System</option>
                <option
                    v-for="system in dropdown.systems"
                    :key="system.id"
                    :value="system.id"
                >
                    {{ system.name }} ({{ system.id }})
                </option>
            </select>
        </template>
    </div>
</template>


<script setup>
import { ref } from 'vue';

const dropdowns = ref([]);
</script>
