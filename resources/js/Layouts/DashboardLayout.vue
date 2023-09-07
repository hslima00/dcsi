<template>
    <!--
      This example requires updating your template:

      ```
      <html class="h-full">
      <body class="h-full">
      ```
    -->

    <div class="min-h-full">
        <Disclosure v-slot="{ open }" as="nav" class="border-b border-gray-200 bg-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8"> <!-- the header vertical padding is 16px -->
                <div class="flex h-20 justify-between">
                    <div class="flex">
                        <div class="flex flex-shrink-0 items-center">
                            <img alt="dcsi logo" class="block h-12 w-auto lg:hidden" src="/img/brasao.png"/>
                            <img alt="dcsi logo" class="hidden h-12 w-auto lg:block" src="/img/brasao.png"/>
                        </div>
                        <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
                            <Link v-for="item in navigation" :key="item.name" :aria-current="item.current ? 'page' : undefined"
                               :class="[($page.url.startsWith(item.current))? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700', 'inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium']"
                               :href="item.href">{{ item.name }}</Link>
                        </div>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:items-center">


                        <!-- Profile dropdown -->
                        <Menu as="div" class="relative ml-3">
                            <div>
                                <MenuButton
                                    class="relative flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <span class="absolute -inset-1.5"/>
                                    <span class="sr-only">Menu de Utilizador</span>
                                    <img :src="user.imageUrl" alt="" class="h-10 w-10 rounded-full"/>
                                </MenuButton>
                            </div>
                            <transition enter-active-class="transition ease-out duration-200"
                                        enter-from-class="transform opacity-0 scale-95"
                                        enter-to-class="transform opacity-100 scale-100"
                                        leave-active-class="transition ease-in duration-75"
                                        leave-from-class="transform opacity-100 scale-100"
                                        leave-to-class="transform opacity-0 scale-95">
                                <MenuItems
                                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                    <MenuItem>
                                        <Link as="button" class="block px-4 py-2 text-sm text-gray-700" href="/logout"
                                              method="post">Terminar Sessão
                                        </Link>
                                    </MenuItem>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                    <div class="-mr-2 flex items-center sm:hidden">
                        <!-- Mobile menu button -->
                        <DisclosureButton
                            class="relative inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            <span class="absolute -inset-0.5"/>
                            <span class="sr-only">Open main menu</span>
                            <Bars3Icon v-if="!open" aria-hidden="true" class="block h-6 w-6"/>
                            <XMarkIcon v-else aria-hidden="true" class="block h-6 w-6"/>
                        </DisclosureButton>
                    </div>
                </div>
            </div>

            <DisclosurePanel class="sm:hidden">
                <div class="space-y-1 pb-3 pt-2">
                    <DisclosureButton v-for="item in navigation" :key="item.name" :aria-current="item.current ? 'page' : undefined" :class="[item.current ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-transparent text-gray-600 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800', 'block border-l-4 py-2 pl-3 pr-4 text-base font-medium']"
                                      :href="item.href"
                                      as="a">{{ item.name }}
                    </DisclosureButton>
                </div>
                <div class="border-t border-gray-200 pb-3 pt-4">
                    <div class="flex items-center px-4">
                        <div class="flex-shrink-0">
                            <img :src="user.imageUrl" alt="" class="h-10 w-10 rounded-full"/>
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium text-gray-800">{{ user.name }}</div>
                            <div class="text-sm font-medium text-gray-500">{{ user.email }}</div>
                        </div>
                        <button class="relative ml-auto flex-shrink-0 rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                type="button">
                            <span class="absolute -inset-1.5"/>
                            <span class="sr-only">View notifications</span>
                            <BellIcon aria-hidden="true" class="h-6 w-6"/>
                        </button>
                    </div>
                    <div class="mt-3 space-y-1">
                        <DisclosureButton v-for="item in userNavigation" :key="item.name" :href="item.href" as="a"
                                          class="block px-4 py-2 text-base font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-800">
                            {{ item.name }}
                        </DisclosureButton>
                    </div>
                </div>
            </DisclosurePanel>
        </Disclosure>

        <div class="py-10">
            <header>
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold leading-tight tracking-tight text-gray-900">DCSI</h1>
                </div>
            </header>
            <main>
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <slot>

                    </slot>
                </div>
            </main>
        </div>
    </div>
</template>

<script setup>
import {Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue'
import {Bars3Icon, BellIcon, XMarkIcon} from '@heroicons/vue/24/outline'
import {Link} from '@inertiajs/inertia-vue3'

const user = {
    name: 'Tom Cook',
    email: 'tom@example.com',
    imageUrl:
        '/img/af_logo.jpg',
}
const navigation = [
    {
        name: 'Itens',
        href: '/items',
current: '/items'
        // if current page is items, then current is true, else current is false

    },
    {name: 'Sistemas', href: '/systems', current: '/systems'},
]
const userNavigation = [
    {name: 'Terminar Sessão', href: '#'},
]
</script>
