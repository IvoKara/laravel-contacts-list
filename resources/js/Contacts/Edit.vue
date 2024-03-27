<script setup lang="ts">
import { useForm, router } from '@inertiajs/vue3';
import {ref, computed} from 'vue'

const props = defineProps<{
    contact: Record<string, any>
}>()

const form = useForm(props.contact)

const url = computed(() => `/contacts/${props.contact.id}`)

function submit() {
    form.put(url.value)
}

function destroy() {
    form.delete(url.value)
}
</script>

<template>
    <div>
        <pre>{{ contact }}</pre>
        <h1>Edit contact</h1>
        <form @submit.prevent="submit" class="flex flex-col w-min">
            <label>
            Name:
            <input v-model="form.name">
            <small v-if="form.errors.name" class="text-red">
                {{ form.errors.name }}
            </small>
        </label>
        <label>
            Nickame:
            <input v-model="form.nickname">
            <small v-if="form.errors.nickname" class="text-red">
                {{ form.errors.nickname }}
            </small>
        </label>
        <label>
            Email:
            <input v-model="form.email">
            <small v-if="form.errors.email" class="text-red">
                {{ form.errors.email }}
            </small>
        </label>
        <label>
            Phone:
            <input v-model="form.phone">
            <small v-if="form.errors.phone" class="text-red">
                {{ form.errors.phone }}
            </small>
        </label>
            <button type="submit">Update</button>
        </form>

        <button @click="destroy"> Delete contact</button>
    </div>
</template>