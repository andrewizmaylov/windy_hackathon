<template>
    <section class="dark:bg-dark mx-auto w-[80%] rounded-lg bg-white p-6">
        <input type="text"
               v-model="search"
               class="w-full rounded base_text"/>
        <div v-if="search.length"
             class="my-6 max-h-[100px] flex flex-wrap gap-4 ringed_box overflow-auto">
            <img src="/images/walking_dog.gif"
                 alt="walking_dog"
                 class="h-24 mx-auto"
                 v-if="show_spinner"/>
            <h5 class="base_text base_btn"
                v-for="spot in output"
                :key="spot.id"
                @click="fetchForecast(spot)"
                v-else>
                {{ spot?.name }}
            </h5>
        </div>
        <div class="ringed_box my-6"
             v-if="forecast?.system_fingerprint">
            <section class="flex items-center space-x-4 mb-4"
                     v-for="(choice, i) in forecast.choices"
                     :key="i">
                <span class="base_text base_btn"
                      @click="selectChoice(choice)"> Choice {{ i + 1 }}</span>
            </section>
		    
            <p v-html="selected_choice.message.content"/>
        </div>
    </section>
	
</template>
<script setup>
import {computed, ref} from 'vue';

const props = defineProps({
    spots: {
        type: Array,
        required: true,
    },
});

let selected_choice = ref(null);
let search = ref('');
let show_spinner = ref(false);

let output = computed(() =>
    search.value.length
        ? props.spots.original.filter((spot) =>
            spot.name.toLowerCase().includes(search.value.toLowerCase()),
        )
        : props.spots.original,
);

let forecast = ref({});

function fetchForecast(spot) {
    search.value = spot.name;
    show_spinner.value = true;
    axios.post(route('fetchWeather'), {spot: spot}).then((response) => {
        forecast.value = response.data;
        selected_choice.value = response.data?.choices[0];
        show_spinner.value = false;
        search.value = '';
    });
}

function selectChoice(choice) {
    selected_choice.value = choice;
}
</script>

