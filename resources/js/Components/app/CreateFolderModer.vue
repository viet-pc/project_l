<script setup lang="ts">
import Modal from "@/Components/Modal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import {useForm, usePage} from "@inertiajs/vue3";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {nextTick, ref} from "vue";

const page = usePage();
const form = useForm({
    name: ''
})

const folderNameInput = ref(null)

const {modelValue} = defineProps({
    modelValue: Boolean
})
const emit = defineEmits(['update:modelValue'])

function createFolder() {
    const name = form.name;
    form.post(route('folder.create'), {
        preserveScroll: true,
        onSuccess: () => {
            closeModal()
            form.reset()
        },
        onError: () => folderNameInput.value.focus()
    })
}

function onShow() {
    nextTick(() => folderNameInput.value.focus())
}

function closeModal() {
    emit('update:modelValue')
    form.clearErrors()
    form.reset()
}

</script>

<template>
    <modal :show="modelValue" @show="onShow" max-width="sm">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Create New Folder
            </h2>
            <div class="mt-6">
                <InputLabel for="folderName" value="folderName" class="sr-only"/>
                <TextInput
                    type="text"
                    id="folderName"
                    ref="folderNameInput"
                    v-model="form.name"
                    class="mt-1 w-full"
                    :class="form.errors.name ? 'border-red-500 focus:border-red-500 focus:ring-red-500' : ''"
                    placeholder="Folder Name"
                    @keyup.enter="createFolder"
                />
                <InputError :message="form.errors.name" class="mt-2"/>
            </div>
            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="closeModal">Cancel</SecondaryButton>
                <PrimaryButton class="ml-3"
                               :class="{'opacity-25' : form.processing}"
                               @click="createFolder"
                               :disable="form.processing">
                    Submit
                </PrimaryButton>
            </div>
        </div>

    </modal>
</template>

<style scoped>

</style>
