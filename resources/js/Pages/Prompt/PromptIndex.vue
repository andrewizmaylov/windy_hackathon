<template>
    <div class="bg-white min-h-screen flex justify-center items-center">
        <main class="ringed_box w-[80%] mx-auto shadow rounded-lg">

            <div class="mx-auto my-16 max-w-7xl px-6 sm:mt-32 lg:px-8">
                <h2 class="text-6xl font-semibold">Defined Prompts</h2>

                <p class="mx-auto mt-6 max-w-2xl text-pretty text-center text-sm font-medium text-gray-600">
                    Choose prompt for Edit or <Link class="text-blue-500 underline"
                                                    :href="route('promptCreate')">Create New</Link>.
                </p>

                <div class="ringed_box my-2 shadow-2xl">
                    <div v-for="prompt in prompts"
                         :key="prompt.id"
                         class="ring-1 ring-gray-200 rounded-3xl p-8 col-span-1 cursor-pointer hover:shadow"
                         @click="router.get(route('promptUpdate', {prompt: prompt.id}))" >
                        <h2 :id="prompt.id"
                            :class="['text-gray-900 text-lg/8 font-semibold']">{{ prompt.type }} ID: {{ prompt.id }}</h2>
                        <p v-html="prompt.text" />
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script setup>
import {Link, router} from '@inertiajs/vue3';

defineProps({
    prompts: {
        type: Array,
    }
});
</script>