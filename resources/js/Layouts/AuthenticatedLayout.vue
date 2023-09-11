<script setup lang="ts">
import Navigation from "@/Components/app/Navigation.vue";
import SearchForm from "@/Components/app/SearchForm.vue";
import UserSettingDropdown from "@/Components/app/UserSettingDropdown.vue";
import {onMounted, ref} from "vue";
import {emitter, FILE_UPLOAD_STARTED} from "@/event-bus";
import {useForm, usePage} from "@inertiajs/vue3";

const page = usePage()
const dragOver = ref(false)
const fileUploadForm = useForm({
    files: [],
    relative_paths: [],
    parent_id: null
})
function uploadFiles(files) {
    console.log(files)
    fileUploadForm.parent_id = page.props.folder.id
    fileUploadForm.files = files
    fileUploadForm.relative_paths = [...files].map(f => f.webkitRelativePath)

    fileUploadForm.post(route('file.store'))
}
function onDragOver() {
    dragOver.value = true
}

function onDragLeave() {
    dragOver.value = false
}

function handleDrop(ev) {
    dragOver.value = false;
    const files = ev.dataTransfer.files
    if (!files.length){

    }
}
onMounted(() => {
    emitter.on(FILE_UPLOAD_STARTED, uploadFiles)
})
</script>

<template>
    <div @drop.prevent="handleDrop" @dragover.prevent="onDragOver" @dragleave.prevent="onDragLeave" class="h-screen bg-gray-50 flex w-full gap-4 ">

        <template v-if="dragOver" class="flex items-center justify-center w-full h-screen">
            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Drag and drop to upload</span></p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                </div>
            </label>
        </template>
        <template v-else class="h-screen bg-gray-50 flex w-full gap-4 ">
            <Navigation/>

            <main class="flex flex-col flex-1 px-4 overflow-hidden">
                <div class="flex items-center justify-between w-full">
                    <SearchForm/>
                    <UserSettingDropdown/>
                </div>
                <div class="flex-1 flex  flex-col overflow-hidden ">
                    <slot/>
                </div>
            </main>
        </template>
    </div>
</template>
