<script setup lang="ts">
import { router, useForm } from '@inertiajs/vue3';
import {ref} from 'vue'
import {watchDebounced} from '@vueuse/core'

const props = defineProps<{
    search: Record<string, any>
}>()

const typeSearch = ref('')

const form = useForm({
    name: '',
    contacts: []
})

watchDebounced(typeSearch, (newSearch) => {
    router.get(`/contacts-groups/create?search=${newSearch}`, {}, {
        only: ['search'],
        preserveScroll: true,
        preserveState: true,
    })
}, { 
    debounce: 600, 
    maxWait: 1500 
})

function submit() {
    form.post('/contacts-groups')
}
</script>

<template>
    <form @submit.prevent="submit">

        <label for="">
            Name:
            <input v-model="form.name">
        </label>

        <div class="py-4">
            <label for="contacts" class="block">Contacts:</label>
            <input id="contacts"  v-model="typeSearch">
            <p>Selected: {{ form.contacts }}</p>

            <ul class="grid mt-4 gap-2">
                <li v-for="result in search">
                    <label 
                        :for="result.nickname" 
                        class="cursor-pointer p-4 rounded-lg border border-gray-200 shadow-sm flex justify-between gap-4"
                        :class="{'bg-gray-200': form.contacts.includes(result.id)}"
                    >
                        <input
                            class="hidden" type="checkbox"
                            :id="result.nickname" :value="result.id"
                            v-model="form.contacts"
                        >
                        <span class="font-bold">
                            {{ result.name }} <span class="text-gray-400 font-normal">({{ result.nickname }})</span>
                        </span>
                        <div class="text-sm text-gray-500 flex flex-col gap-2 items-end">
                            <span>{{ result.email }}</span>
                            <span>{{ result.phone }}</span>
                        </div>
                    </label>
                </li>
            </ul>
        </div>
        <button type="submit" class="px-3 py-2 w-fit rounded-md bg-violet-800 text-white">Submit</button>
    </form>
</template>