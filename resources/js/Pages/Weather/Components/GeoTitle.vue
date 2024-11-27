<template>
    <section class="text-xs mb-2 divide-gray-800 divide-x">
        <span class="px-1"
              v-if="address?.city">{{ address.city }}</span>
        <span class="px-1"
              v-if="address?.country">{{ address.country }}</span>
    </section>
</template>
<script setup>
import {onMounted, ref} from 'vue';

const props = defineProps({
    request_data: {
        type: Object,
        required: true,
    },
    api_key: {
        type: String,
        required: true,
    }
});
let address = ref(null);

function getGeoData() {
    const url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${props.request_data['lat']},${props.request_data['lon']}&key=${props.api_key}`;
	
    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'OK') {
                const addressComponents = data.results[0].address_components;
                let geoData = {
                    formatted_address: data.results[0].formatted_address,
                    city: '',
                    country: ''
                };
				
                // Loop through the address components to get the city and country
                addressComponents.forEach(component => {
                    if (component.types.includes('locality')) {
                        geoData.city = component.long_name;
                    }
                    if (component.types.includes('country')) {
                        geoData.country = component.long_name;
                    }
                });
	            
                address.value = geoData;
            } else {
                console.error('Geocoding failed: ' + data.status);
            }
        })
        .catch(error => console.error('Error fetching geolocation data: ', error));
}

onMounted(() => getGeoData());
</script>