<script setup>
import {Link, Head} from '@inertiajs/vue3';
import {onMounted, ref} from 'vue';

onMounted(() => getLocation());
function getLocation() {
    // Check if geolocation is supported
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        document.getElementById('location').innerHTML = 'Geolocation is not supported by this browser.';
    }
}

let lat = ref(null);
let lon = ref(null);
let url = ref(null);

// Success callback
function showPosition(position) {
    lat.value = position.coords.latitude;
    lon.value = position.coords.longitude;
    if (lat.value && lon.value) {
        url.value = `?lat=${lat.value}&lon=${lon.value}`;
    }
    document.getElementById('location').innerHTML = `Latitude: ${lat.value}, Longitude: ${lon.value}`;
}

// Error callback
function showError(error) {
    switch(error.code) {
    case error.PERMISSION_DENIED:
        document.getElementById('location').innerHTML = 'User denied the request for Geolocation.';
        break;
    case error.POSITION_UNAVAILABLE:
        document.getElementById('location').innerHTML = 'Location information is unavailable.';
        break;
    case error.TIMEOUT:
        document.getElementById('location').innerHTML = 'The request to get user location timed out.';
        break;
    case error.UNKNOWN_ERROR:
        document.getElementById('location').innerHTML = 'An unknown error occurred.';
        break;
    }
}
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-white text-black/50 dark:bg-black dark:text-white/50 flex min-h-screen flex-col items-center p-6 justify-center">
        <section class="max-w-[360px]">
            <Link :href="route('forecastIndex', {
                lat: lat?.value,
                lon: lon?.value,
            })">
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
                <p class="text-xs my-2 hidden"
                   id="location" />
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
