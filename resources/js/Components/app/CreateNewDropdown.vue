<script setup lang="ts">

import {Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
</script>

<template>
        <Menu as="div" class="relative block text-left">
            <div>
                <MenuButton
                    class="flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300  hover:bg-gray-50"
                >
                    Create New
                    <ChevronDownIcon
                        class="ml-2 -mr-1 h-5 w-5 text-gray-800"
                        aria-hidden="true"
                    />
                </MenuButton>
            </div>

            <transition
                enter-active-class="transition duration-100 ease-out"
                enter-from-class="transform scale-95 opacity-0"
                enter-to-class="transform scale-100 opacity-100"
                leave-active-class="transition duration-75 ease-in"
                leave-from-class="transform scale-100 opacity-100"
                leave-to-class="transform scale-95 opacity-0"
            >
                <MenuItems
                    class="absolute right-0 mt-2 w-32 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                >
                    <div class="px-1 py-1">
                        <MenuItem v-slot="{ active }">
                            <ResponsiveNavLink href="route('profile.edit')"
                                               :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700','block px-4 py-2 text-sm']">
                                New Folder
                            </ResponsiveNavLink>
                        </MenuItem>
                        <MenuItem v-slot="{ active }">
                            <ResponsiveNavLink href="route('profile.edit')"
                                               :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700','block px-4 py-2 text-sm']">
                                Upload File
                            </ResponsiveNavLink>
                        </MenuItem>
                    </div>
                </MenuItems>
            </transition>
        </Menu>
</template>

<style scoped>

</style>
