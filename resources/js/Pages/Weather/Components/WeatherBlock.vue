<template>
    <div class="w-full text-gray-800">
        <section class="flex items-center justify-between pt-2">
            <section class="flex space-x-2">
                <img src=""
                     alt="weather_icon">
                <h4 class="font-extrabold">{{ data.header }}</h4>
            </section>
            <section class="flex items-center space-x-2">
                <h4 class="font-normal text-sm">{{ data.temperature }}C</h4>
                <h4 class="font-normal text-sm px-4 py-0.3 rounded-full bg-red-100">{{ data.wind }}kts</h4>
            </section>
        </section>
        <p class="font-normal text-sm">{{ data?.summary }}</p>
    </div>
</template>
<script setup>
defineProps({
    data: {
        type: Object,
        required: true,
    }
});
</script>