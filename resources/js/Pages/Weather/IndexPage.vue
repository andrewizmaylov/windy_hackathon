<template>
    <div class="bg-white text-black/50 dark:bg-black dark:text-white/50 flex min-h-screen flex-col items-center pt-6 sm:justify-center">
        <section class="max-w-[540px] rounded-0 shadow-md sm:rounded-[16px] overflow-hidden">
            <Header />
	        
            <section class="rounded-[16px] md:p-6 sm:p-4 p-2 w-full">
                <DaySelector @day_selected="daySelected" />
	            
                <DayForecast :data="intervals" />
            </section>
        </section>
    </div>
</template>
<script setup>
import DaySelector from '@/Pages/Weather/Components/DaySelector.vue';
import {computed, onMounted, ref} from 'vue';
import Header from '@/Pages/Weather/Components/Header.vue';
import DayForecast from '@/Pages/Weather/Components/DayForecast.vue';

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


let day_selected = ref(1);
function daySelected(day) {
    day_selected.value = day.id;
}
let intervals = computed(() => {
    let data = props.simple.split('Weather Summary for ');
	
    return day_selected.value ? data.slice(1, 9) : data.slice(9, 17);
});

const ai_forecast = ref(null);
const fetchForecast = async () => {
    try {
        const response = await axios.post(route('fetchWeather', {
            forecast: props.simple,
            request_data: props.request_data,
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