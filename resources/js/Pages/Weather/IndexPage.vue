<template>
    <div
        class="bg-white text-black/80 dark:bg-black dark:text-white/50 flex min-h-screen flex-col items-center pt-6 sm:justify-center">
        <section class="max-w-[540px] rounded-0 shadow-md sm:rounded-[16px] overflow-hidden">
            <Header/>
			
            <section class="rounded-[16px] md:p-6 sm:p-4 p-2 w-full">
                <DaySelector @day_selected="daySelected"/>
	            
                <div v-if="ai_forecast"
                     class="my-4 space-y-1"
                     v-html="marked.parse(first_message)" />
            </section>
        </section>
    </div>
</template>
<script setup>
import DaySelector from '@/Pages/Weather/Components/DaySelector.vue';
import {computed, onMounted, ref} from 'vue';
import Header from '@/Pages/Weather/Components/Header.vue';
import {marked} from 'marked';

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

const ai_forecast = ref(null);
const fetchForecast = async () => {
    try {
        const response = await axios.post(route('fetchWeather', {
            forecast: props.simple,
            request_data: props.request_data,
            prompt: props.request_data?.prompt
        }));
        ai_forecast.value = await response.data;
    } catch (error) {
        console.error('Error fetching additional data:', error);
    }
};

onMounted(() => {
    fetchForecast();
});

let first_message = computed(() => {
    return ai_forecast.value
        ? ai_forecast.value.choices[0].message.content
        : null;
});
</script>