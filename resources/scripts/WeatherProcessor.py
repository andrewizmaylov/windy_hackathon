import json
from datetime import datetime

data = {
    "status": "success",
    "response": {
        "modelsUpdateTime": {
            "ecmwf_rain": 1732593023,
            "hrdps": 1732595799,
            "iconglobal": 1732565614,
            "gdps": 1732591773,
            "gfs_wave": 1732600832,
            "arome": 1732595587,
            "ukmet2": 1732604465,
            "gfs27": 1732600291,
            "ecmwf": 1732593023,
            "openskiron": 1732608692,
            "uvi": 1732582135,
            "mfwam": 1732573951,
            "silam": 1732543443,
            "cfs": 1732598447,
            "openwrf": 1732603776,
            "rdwps": 1732604124,
            "myocean": 1732592220,
            "hrrr": 1732606737,
            "icon_d2": 1732597815,
            "lew": 1732601139,
            "nam": 1732603907,
            "iconeuro": 1732593219,
        },
        "forecastTimestamp": 1732608692,
        "forecast": [
            {
                "timestamp": 1732611600,
                "date": "26.11.2024 09:00",
                "CWAT": 0,
                "PRMSL": 101477.77,
                "TCDC_HIGH": 0,
                "UGRD": 4.0175705,
                "GUST_GFSPLUS": 6.1089234,
                "PRATE": 7.89683E-7,
                "TCDC_LOW": 3.0452619,
                "TCDC_MED": 0,
                "CLOUD_BASE": 1558.471,
                "GUST": 5.1842856,
                "PRATE_PERIOD": 0.008528576,
                "PRES_LOW_CLOUD": 83699.31,
                "TMP": 281.52286,
                "VGRD": -1.538355,
                "FSI": 50.571735,
                "VGRD_GFSPLUS": -1.6180737,
                "DPT": 274.75568,
                "LAND": 0.75179905,
                "PRES": 101100.95,
                "RH": 62.80421,
                "TCDC_TOTAL": 3.1727839,
                "UGRD_GFSPLUS": 5.6699877,
                "SNOW_PRATE": 0,
                "FEELS_LIKE_TMP": 280.51579146633,
                "FEELS_LIKE_TMP_WIND_TO_FACE": 279.82513142195,
                "FEELS_LIKE_TMP_WIND_TO_BACK": 277.72914488203,
                "swellDirection": 238.78285,
                "swellDirection_MFWAM": 238.78285,
                "swellSize": 1.7196907,
                "swellSize_MFWAM": 1.7196907,
                "swellPeriod": 6.710124,
                "swellPeriod_MFWAM": 6.710124,
                "PRATE_ECMWF": 0,
                "PRATE_PERIOD_ECMWF": 0,
                "TCDC_TOTAL_ECMWF": 4.9761033,
                "UGRD_ECMWF": -0.2000852,
                "VGRD_ECMWF": -0.30394718,
                "GUST_ECMWF": 1.1389225,
                "TEMP_ECMWF": 279.3288,
                "SNOW_PRATE_ECMWF": 0,
            },
            {
                "timestamp": 1732622400,
                "date": "26.11.2024 12:00",
                "CWAT": 0.0007672877,
                "GUST": 3.827714,
                "PRMSL": 101574.09,
                "GUST_GFSPLUS": 3.8436527,
                "PRES": 101199.19,
                "TCDC_HIGH": 0,
                "VGRD_GFSPLUS": 1.7484326,
                "TMP": 283.36307,
                "UGRD": 3.1509626,
                "VGRD": 0.66543186,
                "FSI": 51.522453,
                "DPT": 275.54395,
                "PRES_LOW_CLOUD": 84423.31,
                "RH": 58.3654,
                "TCDC_TOTAL": 4.1127872,
                "TCDC_MED": 0,
                "UGRD_GFSPLUS": 3.4243274,
                "CLOUD_BASE": 1507.3301,
                "LAND": 0.75179905,
                "PRATE": 3.5787954E-7,
                "PRATE_PERIOD": 0.003865099,
                "TCDC_LOW": 3.9065065,
                "SNOW_PRATE": 0,
                "FEELS_LIKE_TMP": 279.30309532883,
                "FEELS_LIKE_TMP_WIND_TO_FACE": 278.73592733396,
                "FEELS_LIKE_TMP_WIND_TO_BACK": 280.15899691019,
                "swellDirection": 238.37825,
                "swellDirection_MFWAM": 238.37825,
                "swellSize": 1.5347371,
                "swellSize_MFWAM": 1.5347371,
                "swellPeriod": 6.3053865,
                "swellPeriod_MFWAM": 6.3053865,
                "PRATE_ECMWF": 5.8099345E-6,
                "PRATE_PERIOD_ECMWF": 0.06274729,
                "TCDC_TOTAL_ECMWF": 56.303955,
                "UGRD_ECMWF": -1.5608295,
                "VGRD_ECMWF": 1.4315625,
                "GUST_ECMWF": 4.3773065,
                "TEMP_ECMWF": 282.46606,
                "SNOW_PRATE_ECMWF": 0,
            },
            {
                "timestamp": 1732633200,
                "date": "26.11.2024 15:00",
                "PRES_LOW_CLOUD": 85235.8,
                "VGRD": 2.0013583,
                "PRATE": 1.2543946E-7,
                "PRES": 101146.82,
                "TMP": 282.61774,
                "VGRD_GFSPLUS": 3.3882763,
                "CWAT": 0.06262003,
                "PRATE_PERIOD": 0.0013547462,
                "RH": 61.56556,
                "TCDC_TOTAL": 66.25912,
                "FSI": 46.843254,
                "GUST": 2.4057596,
                "PRMSL": 101522.984,
                "TCDC_HIGH": 64.879974,
                "TCDC_LOW": 1.4399014,
                "TCDC_MED": 28.848137,
                "UGRD": -0.24704948,
                "UGRD_GFSPLUS": -0.5269458,
                "GUST_GFSPLUS": 3.70542,
                "DPT": 275.59283,
                "LAND": 0.75179905,
                "CLOUD_BASE": 1422.7773,
                "SNOW_PRATE": 0,
                "FEELS_LIKE_TMP": 279.02117417554,
                "FEELS_LIKE_TMP_WIND_TO_FACE": 281.90073863532,
                "FEELS_LIKE_TMP_WIND_TO_BACK": 280.90450215626,
                "swellDirection": 237.93015,
                "swellDirection_MFWAM": 237.93015,
                "swellSize": 1.3797525,
                "swellSize_MFWAM": 1.3797525,
                "swellPeriod": 6.2252626,
                "swellPeriod_MFWAM": 6.2252626,
                "PRATE_ECMWF": 0,
                "PRATE_PERIOD_ECMWF": 0,
                "TCDC_TOTAL_ECMWF": 99,
                "UGRD_ECMWF": -1.424799,
                "VGRD_ECMWF": 1.108004,
                "GUST_ECMWF": 3.143014,
                "TEMP_ECMWF": 281.96317,
                "SNOW_PRATE_ECMWF": 0,
            },
        ],
        "available_models": {
            0: "gfs27",
            1: "gfs27_long",
            2: "ecmwf",
            3: "ecmwf_ens",
            4: "arome",
            5: "iconeuro",
            6: "iconglobal",
            7: "openwrf",
            8: "uvi",
            9: "cfs",
            10: "silam",
            11: "gfs_wave",
            12: "lew",
            13: "ukmet2",
            14: "wrfg",
            15: "gdps",
        },
        "model_match_rates": [],
        "timezone": "Europe/London",
    },
    "time": 0.03914999961853
}


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
        precipitation = entry.get("PRATE")
        gust = entry.get("GUST")
        swell_size = entry.get("swellSize")
        swell_period = entry.get("swellPeriod")

        # Convert timestamp to a human-readable date (if needed)
        forecast_time = datetime.utcfromtimestamp(timestamp).strftime('%Y-%m-%d %H:%M:%S')

        # Create a readable weather summary
        summary = f"Weather Summary for {forecast_time} ({date}):\n"
        summary = f"  Temperature: {temperature - 273.15:.2f}°C\n"  # Convert Kelvin to Celsius
        summary += f"  Wind Speed: {wind_speed_u:.2f} m/s (U component), {wind_speed_v:.2f} m/s (V component)\n"
        summary += f"  Precipitation: {precipitation} mm\n"
        summary += f"  Gust Speed: {gust} m/s\n"
        summary += f"  Swell: {swell_size}m size, {swell_period} sec period\n"

        summaries.append(summary)

    return summaries

# Generate the summaries for each forecast
weather_summaries = generate_weather_summary(data["response"]["forecast"])

# Print out the summaries
for summary in weather_summaries:
    print(summary)
    print("-" * 40)

