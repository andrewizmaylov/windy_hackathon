<template>
    <div class="w-full my-2  text-gray-800 dark:text-gray-300/60 font-medium">
        <h5 class="font-extrabold text-lg">{{ data?.header ?? 'Отличный денек гулять!' }}</h5>
        <p class="font-normal text-sm">{{ data?.summary ?? 'Погода спокойная, приятная. Идеально для прогулок, активностей на улице или встреч на террасе. Хочешь на природу? Помогу с маршрутом!' }}</p>
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