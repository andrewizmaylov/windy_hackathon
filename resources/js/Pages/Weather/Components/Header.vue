<template>
    <div class="relative">
        <img src="/images/fon.png"
             alt="fon">
        <section class="absolute top-0 left-0 w-full flex items-center p-1">
            <Link :href="route('home')">
                <img class="shadow-md"
                     src="/images/inner_logo.png"
                     alt="inner_logo">
            </Link>
			
            <a href="https://windy.app"
               target="_blank"
               class="ml-auto mr-2 shadow cursor-pointer">
                <img src="/images/windy_btn.png"
                     alt="windy_btn">
            </a>
			
            <img class="shadow cursor-pointer"
                 src="/images/siri_btn.png"
                 alt="siri_btn">
        </section>
    </div>
</template>
<script setup>
import {Link} from '@inertiajs/vue3';
</script>