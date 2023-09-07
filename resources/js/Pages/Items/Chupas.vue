<template>
    <Dashboard>
        <nav
            class="relative flex w-full flex-wrap items-center justify-between py-2 border-b-2 border-sky-900"
        >
            <div class="flex w-full flex-wrap items-center justify-between px-3">
                <div>
                    <p
                        class="text-2xl font-semibold text-sky-900 font-sans"
                    >Criar Cliente</p
                    >
                </div>
            </div>
        </nav>

        <div
            class="mt-8 sm:ml-20 justify-center sm:justify-start flex flex-col 2xl:flex-row 2xl:space-x-20"
        >
            <div>
                <label
                    class="ml-4 sm:ml-0 text-base sm:text-2xl font-semibold text-sky-900 font-sans"
                >Detalhes do Cliente</label
                >

                <div
                    class="mt-4 ml-4 sm:ml-0 h-auto px-10 py-4 w-80 sm:w-auto border-2 rounded-lg border-sky-900 bg-gray-100"
                >
                    <InputBox
                        v-model="form.name"
                        :errorMessage="form.errors.name"
                        label="Nome:"
                        inputId="nome"
                        inputType="text"
                        inputName="nome"
                    />

                    <InputBox
                        v-model="form.short_name"
                        :errorMessage="form.errors.short_name"
                        label="Nome Abreviado:"
                        inputId="nomeAbreviado"
                        inputType="text"
                        inputName="nomeAbreviado"
                    />

                    <div class="sm:mt-2 flex flex-wrap">
                        <label class="my-2 font-medium text-sky-900 w-24 sm:w-40"
                        >Logo:</label
                        >
                        <div
                            class="mt-1 sm:ml-2 flex w-56 sm:w-auto justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10"
                        >
                            <div class="text-center">
                                <PhotoIcon
                                    class="mx-auto h-12 w-12 text-gray-300"
                                    aria-hidden="true"
                                />
                                <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                    <label
                                        for="file-upload"
                                        class="relative cursor-pointer w-40 sm:w-80 rounded-md bg-white font-semibold text-sky-900 focus-within:outline-none focus-within:ring-2 focus-within:ring-sky-900 focus-within:ring-offset-2 hover:text-sky-900"
                                    >
                                        <span>Carregar Ficheiro</span>
                                        <input
                                            id="file-upload"
                                            name="file-upload"
                                            type="file"
                                            class="sr-only"
                                        />
                                    </label>
                                </div>
                                <p class="text-xs leading-5 text-gray-600">
                                    PNG, JPG, GIF até 10MB
                                </p>
                            </div>
                        </div>
                    </div>

                    <InputBox
                        v-model="form.vat_number"
                        :errorMessage="form.errors.vat_number"
                        label="NIF:"
                        inputId="nif"
                        inputType="text"
                        inputName="nif"
                    />

                    <InputBox
                        v-model="form.cod"
                        :errorMessage="form.errors.cod"
                        label="Cod:"
                        inputId="cod"
                        inputType="text"
                        inputName="cod"
                    />

                    <InputBox
                        v-model="form.address"
                        :errorMessage="form.errors.address"
                        label="Morada:"
                        inputId="morada"
                        inputType="text"
                        inputName="morada"
                    />

                    <InputBox
                        v-model="form.zip_code"
                        :errorMessage="form.errors.zip_code"
                        label="Código Postal:"
                        inputId="codigoPostal"
                        inputType="text"
                        inputName="codigoPostal"
                    />

                    <InputBox
                        v-model="form.city"
                        :errorMessage="form.errors.city"
                        label="Cidade:"
                        inputId="city"
                        inputType="text"
                        inputName="city"
                    />

                    <InputBox
                        v-model="form.country"
                        :errorMessage="form.errors.country"
                        label="País:"
                        inputId="pais"
                        inputType="text"
                        inputName="pais"
                    />

                    <InputBoxNumeric
                        v-model="form.vat"
                        :errorMessage="form.errors.vat"
                        label="IVA:"
                        inputId="iva"
                        inputType="text"
                        inputName="iva"
                    />

                    <InputBox
                        v-model="form.email"
                        :errorMessage="form.errors.email"
                        label="Email:"
                        inputId="email"
                        inputType="email"
                        inputName="email"
                    />

                    <InputBox
                        v-model="form.phone"
                        :errorMessage="form.errors.phone"
                        label="Telefone:"
                        inputId="telefone"
                        inputType="text"
                        inputName="telefone"
                    />

                    <InputBox
                        v-model="form.mobile_phone"
                        :errorMessage="form.errors.mobile_phone"
                        label="Telemóvel:"
                        inputId="telemovel"
                        inputType="text"
                        inputName="telemovel"
                    />
                </div>
            </div>

            <div class="mt-8 sm:mt-0 ml-4 sm:ml-0">
                <label
                    class="text-base sm:text-2xl font-semibold text-sky-900 font-sans"
                >Detalhes Comerciais</label
                >
                <div
                    class="mt-4 h-auto px-10 py-4 w-80 sm:w-auto border-2 rounded-lg border-sky-900 bg-gray-100"
                >
                    <InputBox
                        v-model="form.quote_language"
                        :errorMessage="form.errors.quote_language"
                        label="Língua da Proposta:"
                        inputId="linguaProposta"
                        inputType="text"
                        inputName="linguaProposta"
                    />

                    <InputBoxNumeric
                        v-model="form.increment"
                        :errorMessage="form.errors.increment"
                        label="Incremento (%):"
                        inputId="incremento"
                        inputType="text"
                        inputName="incremento"
                    />

                    <div class="mt-2 flex flex-wrap">
                        <label class="my-2 font-medium text-sky-900 w-40 sm:w-40"
                        >Termo de Pagamento:</label
                        >
                        <div class="mt-2 sm:-ml-32 px-4 sm:px-6 lg:px-8">
                            <div class="sm:mt-10 flow-root">
                                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div
                                        class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8 w-56 sm:w-auto h-80"
                                    >
                                        <table class="min-w-full divide-y divide-gray-300">
                                            <thead>
                                            <tr class="bg-sky-900">
                                                <th
                                                    scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white"
                                                >
                                                    Percentagem
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-white"
                                                >
                                                    Condição de Pagamento
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                            <tr v-for="product in products" :key="product.id">
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-sky-900 bg-white"
                                                >
                                                    {{ product.name }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 bg-white"
                                                >
                                                    <input
                                                        class="rounded-md border-white focus:ring-2 focus:ring-inset focus:ring-sky-900"
                                                        type="text"
                                                        v-model="product.title"
                                                    />
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex flex-wrap">
                        <label class="my-2 font-medium text-sky-900 w-48 sm:w-48"
                        >Descontos p/Produtos:</label
                        >
                        <div class="mt-2 sm:-ml-40 px-4 sm:px-6 lg:px-8">
                            <div class="sm:mt-12 flow-root">
                                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div
                                        class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8 h-auto w-56 sm:w-auto"
                                    >
                                        <table class="min-w-full divide-y divide-gray-300">
                                            <thead>
                                            <tr class="bg-sky-900">
                                                <th
                                                    scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white"
                                                >
                                                    Produto
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-white"
                                                >
                                                    Desconto
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-white"
                                                >
                                                    Desconto Médio
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                            <tr v-for="product in products" :key="product.name">
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-sky-900 bg-white"
                                                >
                                                    {{ product.name }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 bg-white"
                                                >
                                                    {{ product.discount }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 bg-white"
                                                >
                                                    {{ product.averageDiscount }}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 sm:mt-0 ml-4 sm:ml-0">
                <label
                    class="ml-4 sm:ml-0 text-base sm:text-2xl font-semibold text-sky-900 font-sans"
                >Detalhes de Logística</label
                >
                <div
                    class="mt-4 sm:mb-36 h-auto px-10 py-4 w-80 sm:w-auto border-2 rounded-lg border-sky-900 bg-gray-100"
                >
                    <InputBox
                        v-model="form.incoterms"
                        :errorMessage="form.errors.incoterms"
                        label="INCOTERMS:"
                        inputId="incoterms"
                        inputType="text"
                        inputName="incoterms"
                    />

                    <InputBox
                        v-model="form.destination_country"
                        :errorMessage="form.errors.destination_country"
                        label="País Destino:"
                        inputId="paisDestino"
                        inputType="text"
                        inputName="paisDestino"
                    />

                    <InputBox
                        v-model="form.transportation_details"
                        :errorMessage="form.errors.transportation_details"
                        label="Detalhes Transporte:"
                        inputId="transporte"
                        inputType="text"
                        inputName="transporte"
                    />
                </div>

                <div class="mt-2">
                    <label
                        class="ml-4 sm:ml-0 text-base sm:text-2xl font-semibold text-sky-900 font-sans"
                    >Observações</label
                    >
                    <div
                        class="mt-5 h-auto px-10 py-14 w-80 sm:w-auto border-2 rounded-lg border-sky-900 bg-gray-100"
                    >
						<textarea
                            v-model="form.observations"
                            rows="4"
                            name="comment"
                            id="comment"
                            class="block h-96 w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-900 sm:text-sm sm:leading-6"
                        />

                        <InputError :message="form.errors.observations" />
                    </div>
                </div>
            </div>
        </div>

        <div
            class="mt-4 sm:mt-8 ml-16 flex flex-col sm:flex-row sm:justify-center gap-2 sm:space-x-10"
        >
            <BaseButton
                customClass="w-56 sm:w-80 rounded-md bg-sky-900 px-3.5 py-2.5 text-sm text-center font-semibold text-white shadow-sm hover:bg-sky-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                customLabel="Criar"
                @click="submit"
            />

            <BaseButton
                v-if="props.client !== null"
                customClass="w-56 sm:w-80 rounded-md bg-red-700 px-3.5 py-2.5 text-sm text-center font-semibold text-white shadow-sm hover:bg-red-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                customLabel="Apagar"
                @click="deleteClient"
            />

            <BaseButton
                customClass="w-56 sm:w-80 rounded-md bg-red-700 px-3.5 py-2.5 text-sm text-center font-semibold text-white shadow-sm hover:bg-red-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                customLabel="Cancelar"
                @click="toggleModal"
            />
        </div>

        <ModalDialog :modalActive="modalActive" @close-modal="toggleModal">
            <h1 class="text-2xl font-semibold text-sky-900 font-sans text-center">
                Cancelar Criação do Cliente
            </h1>

            <p class="font-normal text-sky-900 font-sans text-center mt-16">
                Tem a certeza que deseja cancelar a criação do cliente?
            </p>
        </ModalDialog>
    </Dashboard>
</template>

<script setup lang="ts">
import Dashboard from "@/Pages/Dashboard.vue";
import InputBox from "@/Components/Macro/InputBox.vue";
import BaseButton from "@/Components/Macro/BaseButton.vue";
import ModalDialog from "@/Components/Macro/ModalDialog.vue";
import { PropType, ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { PhotoIcon } from "@heroicons/vue/24/solid";
import InputError from "@/Components/InputError.vue";
import { Client } from "@/types/client";
import InputBoxNumeric from "@/Components/Macro/InputBoxNumeric.vue";

const props = defineProps({
    client: {
        type: Object as PropType<Client>,
        default: null,
        required: false,
    },
});

// eslint-disable-next-line vue/no-setup-props-destructure
const form = useForm({
    id: props.client?.id ?? null,
    name: props.client?.name ?? "",
    vat_number: props.client?.vat_number ?? "",
    address: props.client?.address ?? "",
    city: props.client?.city ?? "",
    zip_code: props.client?.zip_code ?? "",
    country: props.client?.country ?? "",
    email: props.client?.email ?? "",
    phone: props.client?.phone ?? "",
    mobile_phone: props.client?.mobile_phone ?? "",
    short_name: props.client?.short_name ?? "",
    cod: props.client?.cod ?? "",
    vat: props.client?.vat ?? 0,
    quote_language: props.client?.quote_language ?? "",
    increment: props.client?.increment ?? 0,
    incoterms: props.client?.incoterms ?? "",
    destination_country: props.client?.destination_country ?? "",
    transportation_details: props.client?.transportation_details ?? "",
    observations: props.client?.observations ?? "",
});

const submit = () => {
    if (props.client !== null) {
        form.put(route("clients.update", props.client.id));
    } else {
        form.post(route("clients.store"));
    }
};

const deleteClient = () => {
    if (props.client !== null)
        form.delete(route("clients.destroy", props.client.id));
};

const products = [
    {
        name: "CALHA",
        discount: "5%",
        averageDiscount: "5%",
        title: "Example Product",
        id: 1,
    },
    {
        name: "ALMA",
        discount: "10%",
        averageDiscount: "10%",
        title: "Example Product",
        id: 2,
    },
    {
        name: "AQUA",
        discount: "10%",
        averageDiscount: "10%",
        title: "Example Product",
        id: 3,
    },
    {
        name: "WAVE",
        discount: "10%",
        averageDiscount: "10%",
        title: "Example Product",
        id: 4,
    },
    {
        name: "AMA_STRUCT",
        discount: "10%",
        averageDiscount: "10%",
        title: "Example Product",
        id: 5,
    },
];

const modalActive = ref(false);

const toggleModal = () => {
    modalActive.value = !modalActive.value;
};
</script>
