<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import {ref, computed, watch} from 'vue'
import {watchDebounced} from '@vueuse/core'

const props = defineProps<{
    group: Record<string, any>
    contacts: Record<string, any>
    search: Record<string, any>
}>()


const name = ref(props.group.name)    
const url = computed(() => `/contacts-groups/${props.group.id}`)

const typeSearch = ref('')

watchDebounced(typeSearch, (newSearch) => {
    router.get(`${url.value}/edit?contact=${newSearch}`, {}, {
        only: ['search'],
        preserveScroll: true,
        preserveState: true,
    })
}, { 
    debounce: 600, 
    maxWait: 1500 
})

function submit() {
    router.patch(url.value, {
        name: name.value
    })
}

function destroy() {
    router.delete(url.value)
}
</script>

<template>
    <div class="p-6">
        <h1 class="font-bold text-3xl capitalize">{{ group.name }}</h1>
        <h3 class="text-gray-400 text-xs">Edit group</h3>
        <form @submit.prevent="submit" class="flex flex-col items-center gap-2 w-min">
            <label>
                Name:
                <input v-model="name">
                <small class="text-red">
                    {{ $page.props.errors.name }}
                </small>
            </label>
            <button class="px-3 py-2 w-fit rounded-md bg-violet-800 text-white" type="submit">Update</button>
        </form>

        <div class="py-4">
            <label for="contacts" class="block">Contacts:</label>
            <input id="contacts"  v-model="typeSearch">

            <ul class="grid gap-2">
                <li v-for="result in search" class="p-4 rounded-lg border border-gray-200 shadow-sm flex justify-between gap-4">
                    <span class="font-bold">
                        {{ result.name }} <span class="text-gray-400 font-normal">({{ result.nickname }})</span>
                    </span>

                    <div class="text-sm text-gray-500 flex flex-col gap-2 items-end">
                        <span>{{ result.email }}</span>
                        <span>{{ result.phone }}</span>
                    </div>
                </li>
            </ul>
        </div>

        <button @click="destroy" class="mt-10 px-3 py-2 w-fit rounded-md bg-red-700 text-white"> Delete group</button>
    </div>
</template>