<template>
    <div class="bg-white text-black/50 dark:bg-black dark:text-white/50 flex min-h-screen flex-col items-center pt-6 sm:justify-center">
        <section class="max-w-[540px] rounded-0 shadow-md sm:rounded-[16px] overflow-hidden">
            <Header />
	        
            <section class="rounded-[16px] md:p-6 sm:p-4 p-2 w-full">
                <DaySelector @day_selected="daySelected" />
                <section class="space-y-4 divide-y divide-gray-200">
                    <WeatherSummary  :data="qwa"/>
		            
                    <WeatherBlock v-for="chank in forecast"
                                  :key="chank.id"
                                  :data="qwe"/>
                </section>
            </section>
        </section>
    </div>
</template>
<script setup>
import DaySelector from '@/Pages/Weather/Components/DaySelector.vue';
import {computed, onMounted, ref} from 'vue';
import Header from '@/Pages/Weather/Components/Header.vue';
import WeatherSummary from '@/Pages/Weather/Components/WeatherSummary.vue';
import WeatherBlock from '@/Pages/Weather/Components/WeatherBlock.vue';

let summary = computed(() => Object.assign({}, { title: 'lorem', summary: 'lorem'}));
const props = defineProps({
    spots: {
        type: Object,
    },
    simple: {
        type: String,
    },
    request_data: {
        type: Object,
    }
});
let qwa = {
    title: 'Отличный денек гулять!',
    summary:'Погода спокойная, приятная. Идеально для прогулок, активностей на улице или встреч на террасе. Хочешь на природу? Помогу с маршрутом!'
};
let qwe = {
    header: 'Утро',
    temperature: '12-14',
    wind: '13-14',
    summary: 'Оденься потеплее, ночью будет ветерок и небольшая влажность, может выпасть снег.',
};

function daySelected(day) {
    console.log(day);
}

let forecast = ref([
    1,2,3,4
]);


const ai_forecast = ref(null);
const fetchForecast = async () => {
    try {
        const response = await axios.post(route('fetchWeather', {
            forecast: props.simple,
            prompt: props.request_data?.prompt
        }));
        ai_forecast.value = await response.json();
    } catch (error) {
        console.error('Error fetching additional data:', error);
    }
};

onMounted(() => {
    fetchForecast();
});

</script>