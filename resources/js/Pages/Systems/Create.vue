<script setup>
import {computed, ref, watch} from 'vue';
import {useForm} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import Dropdown from "@/Components/Dropdown.vue";


const dropdowns = ref([]);
const form = useForm({
    name: "",
    parent_system_id: "",
});

const props = defineProps({
    systems: {
        type: Object,
        default: () => ({}),
    },
});

const submit = () => {
    form.post(route("systems.store"));
};


const filteredSystems = computed(() => {
    if (dropdowns.value.length === 0) {
        return rootSystems.value;
    }
    const lastDropdown = dropdowns.value[dropdowns.value.length - 1];
    return lastDropdown.systems;
});

const rootSystems = computed(() => {
    return props.systems.filter((system) => !system.parent_system_id);
});
const getChildrenSystems = (parentId) => {
    return props.systems.filter((system) => system.parent_system_id === parentId);
};
const createDropdown = (parentId) => {
    const newDropdown = {
        selected: '',
        systems: getChildrenSystems(parentId),
    };
    dropdowns.value.push(newDropdown);
};
const removeDropdown = (index) => {
    dropdowns.value.splice(index + 1);

};
createDropdown(null);


watch(() => dropdowns.value[dropdowns.value.length - 2]?.selected, (newValue) => {
    console.log(newValue);
    form.parent_system_id = newValue;
});

const createNextDropdown = (index) => {
    // Check if this is the last dropdown in the array

    if (index === dropdowns.value.length - 1) {

        const parentId = dropdowns.value[index].selected;

        if (parentId) {
            createDropdown(parentId);
            form.parent_system_id = parentId;
        }
    } else {
        removeDropdown(index);
    }
};
</script>

<template>
    <DashboardLayout>
        <div>
            <h2 class="text-lg font-semibold mb-2">Create New System</h2>
            <form @submit.prevent="submit">
                <InputLabel id="name" for="name" value="Nome *"/>
                <TextInput
                    id="name"
                    v-model="form.name"
                    autofocus
                    class="mt-1 block w-full"
                    default="Campo Obrigatório"
                    required
                    type="text"
                />
                <div v-if="form.errors.name" class="text-sm text-red-600">
                    {{ form.errors.name }}
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium" for="parentSystem">Parent System
                        (Optional)</label>
                    <div v-for="(dropdown, index) in dropdowns" :key="index">
                        <select
                            v-model="dropdown.selected"

                            class="mt-1 p-2 block w-full border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                            @change="createNextDropdown(index)"
                        >

                            <option value="">Select System</option>
                            <option v-for="system in dropdown.systems" :key="system.id" :value="system.id">
                                {{ system.name }} ({{ system.id }})
                            </option>
                        </select>
                    </div>


                    <div v-if="form.errors.parent_system_id" class="text-sm text-red-600">
                        {{ form.errors.parent_system_id }}
                    </div>
                    <div>
                        <PrimaryButton
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                            type="submit"
                        >
                            Submeter
                        </PrimaryButton>
                    </div>
                </div>
            </form>
        </div>
    </DashboardLayout>
</template>



