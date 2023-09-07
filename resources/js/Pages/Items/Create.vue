<script setup>
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import {computed, watch, ref} from "vue";

// create onFileChange method
/*const onFileChange = (e) => {
    const file = e.target.files[0];
    form.image = file;
    console.log(form.image);
};*/

const props = defineProps({
    items: {
        type: Object,
        default: () => ({}),
    },
    systems: Array,

});
const dropdowns = ref([]);
const form = useForm({
    stock: "",
    name: "",
    serial_n: "",
    price: "",
    calibration_date: "",
    part_number: "",
    comment: "",
    image: "",
    system_id: "",
});

const submit = () => {
    form.post(route("items.store"));
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
    dropdowns.value.splice(index+1);
    //dropdowns.value.push(newDropdown);
};
createDropdown(null);


watch(() => dropdowns.value[dropdowns.value.length - 2]?.selected, (newValue) => {
    console.log(newValue);
  form.system_id = newValue;
});

const createNextDropdown = (index) => {
    // Check if this is the last dropdown in the array

    if (index === dropdowns.value.length - 1) {

        const parentId = dropdowns.value[index].selected;

        if (parentId) {
            createDropdown(parentId);
            form.system_id = parentId;
        }
    }else{
        removeDropdown(index);
    }
};
/*const selectedSystem = computed({
    get: () => dropdowns.value[dropdowns.value.length - 1].selected,
    set: (newValue) => {
        dropdowns.value[dropdowns.value.length - 1].selected = newValue;
        form.system_id = newValue; // Update form.system_id with the selected value
    },
});*/
</script>

<template>
    <Head title="Adicionar Item"/>

    <DashboardLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Adicionar Item
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="name" value="Nome *"/>

                                <TextInput
                                    id="name"
                                    v-model="form.name"
                                    autofocus
                                    class="mt-1 block w-full"
                                    default="Campo Obrigatório"
                                    required
                                    type="text"

                                />

                                <InputError
                                    :message="form.errors.name"
                                    class="mt-2"
                                />
                            </div>
                            <div>
                                <InputLabel for="stock" value="Stock *"/>

                                <TextInput
                                    id="stock"
                                    v-model="form.stock"
                                    class="mt-1 block w-full"
                                    default="Campo Obrigatório"
                                    required
                                    type="number"


                                />

                                <InputError
                                    :message="form.errors.stock"
                                    class="mt-2"
                                />
                            </div>
                            <div>
                                <InputLabel for="serial_n" value="Nº Série"/>

                                <TextInput
                                    id="serial_n"
                                    v-model="form.serial_n"
                                    class="mt-1 block w-full"
                                    type="text"


                                />

                                <InputError
                                    :message="form.errors.serial_n"
                                    class="mt-2"
                                />
                            </div>
                            <div>
                                <InputLabel for="part_number" value="Part Number"/>

                                <TextInput
                                    id="part_number"
                                    v-model="form.part_number"
                                    class="mt-1 block w-full"
                                    type="text"


                                />

                                <InputError
                                    :message="form.errors.part_number"
                                    class="mt-2"
                                />
                            </div>
                            <div>
                                <InputLabel for="price" value="Preço (€) "/>

                                <TextInput
                                    id="price"
                                    v-model="form.price"
                                    class="mt-1 block w-full"
                                    default="Campo Obrigatório"
                                    type="number"


                                />

                                <InputError
                                    :message="form.errors.price"
                                    class="mt-2"
                                />
                            </div>
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
                            <div v-if="form.errors.system_id" class="text-sm text-red-600">
                                {{ form.errors.system_id }} <br>
                                {{ form.system_id }}
                            </div>
                            <div>
                                <InputLabel for="calibration_date" value="Data de Calibração"/>

                                <input id="date" v-model="form.calibration_date" type="date">


                                <InputError
                                    :message="form.errors.calibration_date"
                                    class="mt-2"
                                />
                            </div>


                            <div class="my-6">
                                <label
                                    class="block mb-2 text-sm font-medium text-gray-900"
                                    for="content"
                                >Content</label
                                >
                                <textarea
                                    id="comment"
                                    v-model="form.comment"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    name="content"
                                    type="text"
                                ></textarea>

                                <div
                                    v-if="form.errors.comment"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.comment }}
                                </div>
                            </div>
                            <!-- upload image -->
                            <div class="my-6">
                                <label
                                    class="block mb-2 text-sm font-medium text-gray-900"
                                    for="content"
                                >Upload Image</label
                                >
                                <input
                                    name="image"
                                    type="file"
                                    @input="form.image = $event.target.files[0]"
                                />

                                <div
                                    v-if="form.errors.image"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.image }}
                                </div>
                            </div>


                            <PrimaryButton
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                                type="submit"
                            >
                                Submeter
                            </PrimaryButton>
                            <a class="px-2"></a>
                            <Link
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                href="/items"

                            >
                                Cancelar
                            </Link>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>
