<template>
    <DashboardLayout>
        <div class="bg-gray-50">
            <div class="mx-auto max-w-2xl px-4 pb-24 pt-16 sm:px-6 lg:max-w-7xl lg:px-8">
                <h2 class="sr-only">Checkout</h2>

                <form class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16" @submit.prevent="submit">
                    <div>
                        <div>
                            <h2 class="text-lg font-medium text-gray-900">Informação do Item</h2>
                            <div>
                                <InputLabel for="name" value="Nome"/>

                                <TextInput id="name"
                                           v-model="form.name"
                                           class="mt-1 block w-full"
                                           required
                                           type="text"
                                />

                                <InputError :message="form.errors.name" class="mt-2"/>
                            </div>
                            <div>
                                <InputLabel for="stock" value="Stock"/>

                                <TextInput id="name"
                                           v-model="form.stock"
                                           class="mt-1 block w-full"
                                           required
                                           type="number"
                                />

                                <InputError :message="form.errors.name" class="mt-2"/>
                            </div>
                            <div>
                                <InputLabel for="serial_n" value="Nº Série"/>

                                <TextInput id="serial_n"
                                           v-model="form.serial_n"
                                           class="mt-1 block w-full"
                                           type="text"

                                />

                                <InputError :message="form.errors.serial_n" class="mt-2"/>
                            </div>
                            <div>
                                <InputLabel for="part_number" value="Part Number"/>

                                <TextInput id="part_number"
                                           v-model="form.part_number"
                                           class="mt-1 block w-full"
                                           type="text"

                                />

                                <InputError :message="form.errors.part_number" class="mt-2"/>
                            </div>
                            <div>
                                <InputLabel for="price" value="Preço (€)"/>
                                <TextInput id="price"
                                           v-model="form.price"
                                           class="mt-1 block w-full"
                                           type="number"

                                />
                                <InputError :message="form.errors.part_number" class="mt-2"/>
                            </div>
                            <div>
                                <InputLabel for="calibration_date" value="Data de Calibração (MM/DD/YYYY)"/>
                                <TextInput id="calibration_date"
                                           v-model="form.calibration_date"
                                           :model-value="form.calibration_date"
                                           class="mt-1 block w-full"
                                           type="date"

                                />
                                <InputError :message="form.errors.calibration_date" class="mt-2"/>
                            </div>


                        </div>
                    </div>

                    <!-- grelha direita (foto e comentario) -->
                    <div class="mt-10 lg:mt-0">


                        <div class="mt-0 rounded-lg border border-gray-200 bg-white shadow-sm ">
                            <ul class="divide-y divide-gray-200" role="list">
                                <div class="flex-shrink-0">
                                    <div class="overflow-hidden rounded-md w-96 h-auto">
                                        <!--                                    <img
                                                                                src="asset(form.image)"
                                                                                class="object-contain"
                                                                            />-->
                                    </div>
                                </div>
                            </ul>

                            <label
                                class="block mb-2 text-sm font-medium text-gray-900"
                                for="content"
                            > &zwnj; &zwnj; &zwnj; &zwnj; &zwnj; &zwnj; &zwnj;
                                <!--vertical space                            -->
                                <br>

                                &nbsp; &nbsp; &nbsp; Comentário

                            </label>
                            <TextInput id="comment" v-model="form.comment" :model-value="form.comment"
                                       class="mt-1 block w-full"
                                       type="text"/>

                            <InputError :message="form.errors.comment" class="mt-2"/>

                            <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                                               type="submit">
                                    Submeter Alterações
                                </PrimaryButton>
                            </div>

                        </div>
                    </div>

                </form>

                <div>
                    <form class="px-4 py-2 text-white rounded-lg mt-2 "
                          @submit.prevent="destroy(props.item.id)">
                        <PrimaryButton
                            :class="{ 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150': form.processing }"
                            :disabled="form.processing"
                            type="apagar">

                            Apagar Item

                        </PrimaryButton>

                        <a class="px-2">
                        </a>

                        <Link
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            href="/items"

                        >
                            Voltar
                        </Link>


                    </form>


                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

<script setup>

import '@vuepic/vue-datepicker/dist/main.css';

/*const products = [
    {
        id: 1,
        name: "Basic Tee",
        href: '#',
        stock: 30,
        serial_n: '123456789',
        part_number: 'EAB1233',
        calibration_date: '2021-10-10',
        imageSrc: 'https://tailwindui.com/img/ecommerce-images/checkout-page-02-product-01.jpg',
        comment: "Front of men's Basic Tee in black.",
    },

]*/
/*receive the item*/
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import {Link, useForm} from "@inertiajs/vue3";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";


const props = defineProps({
    item: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    id: props.item.id,
    name: props.item.name,
    stock: props.item.stock,
    serial_n: props.item.serial_n,
    part_number: props.item.part_number,
    price: props.item.price,
    calibration_date: props.item.calibration_date,
    comment: props.item.comment || '',
    image: props.item.image,

});

const go_home = () => {
    return route('items.index');
};

const submit = () => {
    form.put(route("items.update", props.item.id));
};
const apagar = () => {
    if (confirm("Are you sure you want to delete?")) {
        form.delete(route('items.destroy', props.item.id));
    } else {

    }
};


function destroy(id) {
    if (confirm("Tem a certeza que quer apagar este item da base de dados? (Irreversível)")) {
        form.delete(route('items.destroy', id));
    }
}
</script>
