<template>
    <div class="w-full text-gray-800 dark:text-gray-300/60 font-medium">
        <section class="flex items-center justify-between pt-2">
            <section class="flex space-x-2">
                <img src=""
                     alt="weather_icon">
                <h4 class="font-extrabold">{{ data.header }}</h4>
            </section>
            <section class="flex items-center space-x-2">
                <h4 class="text-sm">{{ data.temperature }}C</h4>
                <h4 class="text-sm px-4 py-0.3 rounded-full bg-red-100 text-gray-800">{{ data.wind }}kts</h4>
            </section>
        </section>
        <p class="text-sm">{{ data?.summary }}</p>
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