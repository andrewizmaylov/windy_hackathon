import {onMounted, ref} from 'vue';
export default () => {
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
		lat.value = position.coords.latitude.toFixed(2);
		lon.value = position.coords.longitude.toFixed(2);
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
	
	return {
		lat, lon, url,
	};
};