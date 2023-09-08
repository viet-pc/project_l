<script setup lang="ts">

import {MenuItem} from "@headlessui/vue";
import {emitter, FILE_UPLOAD_STARTED} from "@/event-bus";
function onChange(ev) {
    console.log(123)
    emitter.emit(FILE_UPLOAD_STARTED, ev.target.files)
}
</script>

<template>
    <MenuItem v-slot="{ active }">
        <label for="upload-folder"
               class="text-gray-700 block px-4 py-2 text-sm relative w-full">
            Upload Folder
            <input @change="onChange" id="upload-folder" type="file" class="hidden" multiple webkitdirectory directory/>
        </label>
    </MenuItem>
</template>

<style scoped>

</style>
