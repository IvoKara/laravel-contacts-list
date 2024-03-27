<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import {ref} from 'vue'



const name = ref('')

function submit() {
    router.post('/test', {
        name: name.value
    })
}
</script>

<template>
    <form @submit.prevent="submit">
        <input v-model="name">
        <button type="submit">Submit</button>
    </form>
</template>