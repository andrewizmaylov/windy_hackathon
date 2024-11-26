import sys
import json
from datetime import datetime

# Function to generate a weather summary
def generate_weather_summary(forecast):
    summaries = []

    # Loop through each forecast and generate a summary
    for entry in forecast:
        timestamp = entry.get("timestamp")
        date = entry.get("date")
        temperature = entry.get("TMP")
        wind_speed_u = entry.get("UGRD")
        wind_speed_v = entry.get("VGRD")
        precipitation = entry.get("PRATE", "N/A")
        gust = entry.get("GUST")
        swell_size = entry.get("swellSize", "N/A")
        swell_period = entry.get("swellPeriod", "N/A")
        pressure = entry.get('PRES', None)
        humidity = entry.get('RH', None)

        # Convert timestamp to a human-readable date (if needed)
        forecast_time = datetime.utcfromtimestamp(timestamp).strftime('%Y-%m-%d %H:%M:%S')

        # Create a readable weather summary
        summary = f"Weather Summary for {forecast_time} ({date}):\n"
        summary += f"  Temperature: {temperature - 273.15:.2f}°C\n"  # Convert Kelvin to Celsius
        summary += f"  Wind Speed: {wind_speed_u:.2f} m/s (U component), {wind_speed_v:.2f} m/s (V component)\n"
        summary += f"  Precipitation: {precipitation} mm\n"
        summary += f"  Gust Speed: {gust} m/s\n"
        summary += f"  Swell: {swell_size}m size, {swell_period} sec period\n"
        summary += f"  Pressure: {pressure}mm\n"
        summary += f"  Humidity: {humidity}%\n"

        summaries.append(summary)

    return summaries

def main():
    # Retrieve the JSON data passed from the Laravel controller
    data = json.loads(sys.argv[1])  # The data is passed as the first command-line argument

    # Generate weather summaries
    weather_summaries = generate_weather_summary(data)

    # Print the result (this will be captured by the Laravel controller)
    for summary in weather_summaries:
        print(summary)

if __name__ == "__main__":
    main()
