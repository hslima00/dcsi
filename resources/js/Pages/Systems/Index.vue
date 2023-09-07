<template>
    <DashboardLayout>
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <p class="mt-2 text-sm text-gray-700">
                    Hierarquia de Sistemas
                </p>
            </div>
            <Link
                :href="route('systems.create')"
                class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring focus:ring-indigo-300"
            >Adicionar Item
            </Link>
        </div>
        <SimpleTable :systems="systems"/>
    </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import {Link, useForm} from '@inertiajs/vue3';

import {defineProps} from "vue";
import SimpleTable from "@/Components/SimpleTable.vue";


const props = defineProps({
    systems: Array,
});


</script>
