<script setup lang="ts">

import {MenuItem} from "@headlessui/vue";
import {emitter, FILE_UPLOAD_STARTED} from "@/event-bus";


function onChange(ev) {
    emitter.emit(FILE_UPLOAD_STARTED, ev.target.files)
}
</script>

<template>
    <MenuItem v-slot="{ active }">
        <label for="dropzone-file"
               class="text-gray-700 block px-4 py-2 text-sm relative w-full">
            Upload Files
            <input @change="onChange" id="dropzone-file" type="file" class="hidden" multiple/>
        </label>
    </MenuItem>
</template>

<style scoped>

</style>
