<script setup>
const props = defineProps({
    system: Object
});
</script>

<template>
    <li :class="{ 'border border-grey-500 p-2 rounded': system.parent_system != null }" class="py-1 mt-3">
        <div class="flex items-center">
            <span :class="{ 'underline': system.parent_system != null }" class="text-gray-900 font-semibold">{{ system.name }}</span>
        </div>
        <ul v-if="system.parent_system && system.parent_system.length > 0" class="pl-4 mt-2">
            <SytemItem
                v-for="childSystem in system.parent_system"
                :key="childSystem.id"
                :system="childSystem"
            ></SytemItem>
        </ul>
    </li>
</template>
