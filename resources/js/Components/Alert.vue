<template>
    <div class="rounded-md bg-yellow-50 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <ExclamationTriangleIcon
                    class="h-5 w-5 text-yellow-400"
                    aria-hidden="true"
                />
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-yellow-800">Itens com calibração agendada em menos de 2 meses:</h3>
                <div class="mt-2 text-sm text-yellow-700">

                    <tr v-for="item in dueItems" :key="item.id">

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ item.id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ item.name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ item.serial_n }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ item.part_number }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ item.stock }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ item.calibration_date }}</div>
                        </td>


                    </tr>
                    <p>
                        Após a calibração, editar o item e atualizar a data de calibração.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {ExclamationTriangleIcon} from "@heroicons/vue/20/solid";

const props = defineProps({
    dueItems: Array,
});
</script>
