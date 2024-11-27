<template>
    <section class="relative sm:rounded-[16px] sm:shadow-md max-w-[540px] mx-auto overflow-hidden sm:translate-y-[10%]">
        <div class="h-screen sm:h-[80vh] bg-cover bg-center p-6"
             style="background-image: url('/images/sky.jpeg');">
            <input type="text"
                   placeholder="Найди мой спот"
                   v-model="search"
                   class="bg-white rounded-[10px] w-full mt-16">
	        
            <div v-if="search.length"
                 class="my-2 max-h-[260px] flex flex-wrap gap-4 ringed_box overflow-auto bg-white">
                <h5 class="base_text base_btn shadow hover:shadow-md"
                    v-for="spot in output"
                    :key="spot.id"
                    @click="fetchForecast(spot)" >
                    {{ spot?.name }}
                </h5>
            </div>
            <Link :href="route('forecastIndex', { lat: lat,  lon: lon })">
                <div class="absolute bottom-6 w-full font-medium -ml-3">
                    <h6 class="text-center text-white">
                        Для моего местоположения
                    </h6>
                </div>
            </Link>
        </div>
	    
        <p class="text-xs my-2"
           id="location" />
	    
        <TopMenu class="absolute top-0 left-0"/>
    </section>
</template>
<script setup>
import TopMenu from '@/Pages/Weather/Components/TopMenu.vue';
import useGeoComposable from '@/Pages/Weather/Composables/useGeoComposable.js';
import {computed, ref} from 'vue';
import {router} from '@inertiajs/vue3';
import {Link} from '@inertiajs/vue3';

let {lat, lon} = useGeoComposable();

const props = defineProps({
    spots: {
        type: Object,
        required: true,
    },
	
});

let search = ref('');

let output = computed(() =>
    search.value.length
        ? props.spots.filter((spot) =>
            spot.name.toLowerCase().includes(search.value.toLowerCase()),
        )
        : props.spots,
);

function fetchForecast(spot) {
    search.value = spot.name;
    router.get(route('forecastIndex', {
        lat: spot.lat,
        lon: spot.lon,
    }));
}
</script>