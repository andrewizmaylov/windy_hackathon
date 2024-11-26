import sys
import json

# Read input JSON data (as passed from Laravel)
data = json.loads(sys.stdin.read())

# Initialize summary list to hold summaries for each timestamp
summaries = []

# Process each weather entry in the data by timestamp
for entry in data:
    timestamp = entry.get('timestamp', None)
    date = entry.get('date', None)
    temperature = entry.get('TMP', None)
    pressure = entry.get('PRES', None)
    humidity = entry.get('RH', None)
    gust = entry.get('GUST', None)
    wind_speed = entry.get('UGRD', None)

    # Gather the data for each timestamp
    summary = {
        "timestamp": timestamp,
        "date": date,
        "temperature": temperature,
        "pressure": pressure,
        "humidity": humidity,
        "gust": gust,
        "wind_speed": wind_speed,
    }

    summaries.append(summary)

# Prepare the output JSON data
output = json.dumps(summaries, indent=4)

# Return the output (no echo, just store it)
sys.stdout.write(output)
