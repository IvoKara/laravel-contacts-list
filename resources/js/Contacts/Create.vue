<script setup lang="ts">
import { router, useForm } from '@inertiajs/vue3';
import {ref} from 'vue'

const form = useForm({
    name: '',
    nickname: '',
    email: '',
    phone: ''
})

function submit() {
    form.post('/contacts')
}
</script>

<template>
    <form @submit.prevent="submit" class="flex flex-col gap-4 w-min">
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
        <button type="submit">Submit</button>
    </form>
</template>