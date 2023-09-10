<template>

  <div class="inline-block min-w-full py-2 align-middle">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto justify-between">
        <p class="mt-2 text-sm text-gray-700">
          Base de dados de todos os items do armazem da DCSI.
        </p>
      </div>
      <Link
          :href="route('items.create')"
          class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring focus:ring-indigo-300"
      >Adicionar Item
      </Link>
    </div>

    <div class="inline-block min-w-full py-2 align-middle">
      <table class="min-w-full border-separate border-spacing-0">
        <thead>
        <tr>
          <th
              class="sticky top-0 z-10 border-b border-gray-300 bg-white bg-opacity-75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8"
              scope="col"
          >
            Id
          </th>
          <th
              class="sticky top-0 z-10 hidden border-b border-gray-300 bg-white bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:table-cell"
              scope="col"
          >
            Name
          </th>

          <th
              class="sticky top-0 z-10 hidden border-b border-gray-300 bg-white bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter lg:table-cell"
              scope="col"
          >
            Info
          </th>
          <th
              class="sticky top-0 z-10 hidden border-b border-gray-300 bg-white bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter lg:table-cell"
              scope="col"
          >
            Stock
          </th>
          <th
              class="sticky top-0 z-10 hidden border-b border-gray-300 bg-white bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter lg:table-cell"
              scope="col"
          >
            Data de Calibração
          </th>
          <th
              class="sticky top-0 z-10 border-b border-gray-300 bg-white bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter"
              scope="col"
          >
            Comentário
          </th>
          <th class="sticky top-0 z-10 border-b border-gray-300 bg-white bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter"
              scope="col">
            <span class="sr-only">Edit</span>
          </th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
        <tr v-for="item in items" :key="item.system">
          <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
            <div class="text-gray-900">{{ item.id }}</div>
          </td>
          <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm">
            <div class="flex items-center">
              <div class="ml-4">
                <!-- name that is clicable and has a link-->
                <a :href="'/items/' + item.id">
                  <div class="font-medium text-gray-900">{{ item.name }}</div>
                </a>
                <!-- Display system and parent systems -->
                <div class="mt-1 text-gray-500">{{ getSystemName(item, props.systems) }}</div>
              </div>
            </div>
          </td>
          <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
            <!-- if item.serial_n is not null  -->
            <div v-if="(item.serial_n != null) ">
              <div class="text-gray-900">Nº: {{ item.serial_n }}</div>
            </div>
            <!-- if item.part_number is not null  -->
            <div v-if="(item.part_number != null) ">
              <div class="mt-1 text-gray-500">PN: {{ item.part_number }}</div>
            </div>


          </td>
          <td class="whitespace-nowrap px-3 py-5 text-sm">
              <span
                  :class="{
                  'bg-yellow-50 text-yellow-700 ring-yellow-600':
                    item.stock === 1,
                  'bg-red-50 text-red-700 ring-red-600': item.stock === 0,
                  'bg-green-50 text-green-700 ring-green-600': item.stock > 1,
                }"
                  class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset"
              >
                {{ item.stock }}
                <!-- horizontal space -->
                    <span class="px-1"></span>

                <!-- add + and - buttons to reduce stock -->
                    <button
                        class="bg-gray-200 hover:bg-gray-300 text-gray-600 font-bold py-1 px-2 rounded-l"
                        @click="decrementStock(item)"
                    >
                        -
                    </button>
                    <button
                        class="bg-gray-200 hover:bg-gray-300 text-gray-600 font-bold py-1 px-2 rounded-r"
                        @click="incrementStock(item)"
                    >
                        +
                    </button>


              </span>
          </td>
          <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
            {{ item.calibration_date }}
          </td>
          <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
            <!-- se o comentário for diferente de "NULL" então mostra um icone de informação-->
            <div v-if="item.comment != null">
              <svg
                  display="block"
                  fill="none"
                  height="32px"
                  viewBox="0 0 24 24"
                  width="32px"
                  xmlns="http://www.w3.org/2000/svg"
              >
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g
                    id="SVGRepo_tracerCarrier"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                ></g>
                <g id="SVGRepo_iconCarrier">
                  <path
                      clip-rule="evenodd"
                      d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12ZM12 17.75C12.4142 17.75 12.75 17.4142 12.75 17V11C12.75 10.5858 12.4142 10.25 12 10.25C11.5858 10.25 11.25 10.5858 11.25 11V17C11.25 17.4142 11.5858 17.75 12 17.75ZM12 7C12.5523 7 13 7.44772 13 8C13 8.55228 12.5523 9 12 9C11.4477 9 11 8.55228 11 8C11 7.44772 11.4477 7 12 7Z"
                      fill="#1C274C"
                      fill-rule="evenodd"
                  ></path>
                </g>
              </svg>
            </div>
          </td>
          <td
              class="relative whitespace-nowrap py-5 pl-3 pr-4 text-right text-sm font-medium"
          >

            <button>
              <Link
                  class="px-4 py-2 text-white bg-red-600 rounded-lg"
                  @click="destroy(item.id)"
                  href="#"
              >
                <i class="fa-solid fa-xl fa-trash-can "></i>
              </Link>
            </button>
            &nbsp;
            <button>
              <Link
                  :href=" '/items/' + item.id "

                  class="px-4 py-2 text-white bg-blue-600 rounded-lg">
                <i class="fa-solid fa-xl fa-pen-to-square"></i>
              </Link>
            </button>

          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>

</template>

<script setup>

import {Link} from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import '@fortawesome/fontawesome-free/css/all.css';
import {watch, ref} from "vue";
import {Inertia} from "@inertiajs/inertia";


const props = defineProps({
  items: Array,
  systems: Array,
});






function destroy(id) {
  if (confirm("Are you sure you want to Delete")) {
    router.delete(route('items.destroy', id));
  }
}


const incrementStock = (item) => {

  item.stock++;
  router.put(route('items.update', item.id), {
    stock: item.stock,
  });
};
const decrementStock = (item) => {

    item.stock--;
    router.put(route('items.update', item.id), {
      stock: item.stock,
    });
};
const getSystemName = (item, systems) => {
  let systemName = '';
  let currentSystemId = item.system_id;

  while (currentSystemId) {
    const currentSystem = systems.find((system) => system.id === currentSystemId);
    if (!currentSystem) break; // Stop if no matching system is found
    systemName = `${currentSystem.name} > ${systemName}`;
    currentSystemId = currentSystem.parent_system_id;
  }

  return systemName.slice(0, -3); // Remove the trailing " > "
};



</script>
