<script setup>
import {Link, Head} from '@inertiajs/vue3';
defineProps({
    user_data: {
        type: Array,
        required: true,
    }
});
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-white text-black/50 dark:bg-black dark:text-white/50 flex min-h-screen flex-col items-center p-6 justify-center">
        <section class="max-w-[360px]">
            <Link :href="route('forecastIndex')">
                <section class="flex items-center justify-between space-x-4 w-full cursor-pointer">
                    <img src="/images/logo.svg"
                         alt="logo">
                    <section class="font-extrabold text-5xl">
                        <h1>Simple</h1>
                        <h1>Weather</h1>
                    </section>
                </section>
            </Link>
            <section class="mt-36 w-full px-2">
                <h3 class="font-light text-lg">Your weather buddy, fast as lightning and always accurate</h3>
     
                <a href="https://windy.app"
                   class="flex items-center mt-6 cursor-pointer"
                   target="_blank">
                    <img src="/images/windy_logo.svg"
                         alt="windy_logo">
                    <section class="text-[10px] font-medium -mt-1 ml-2">
                        <h6>Powered</h6>
                        <h6>by Windy.app</h6>
                    </section>
                </a>
            </section>
        </section>
    </div>
</template>
