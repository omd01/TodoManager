<?php include "../head.php"?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/icon?family=Material+Icons"
        />
        <title>Weather App</title>
        <link rel="stylesheet" href="stylee.css" />
    </head>
    <body>
        <div class="weather-app">
            <form class="search-form" action="">
                <input
                    class="city-input"
                    type="text"
                    placeholder="Enter City Name"
                />
                <button class="search-btn" type="submit">
                    <i class="material-icons">search</i>
                </button>
            </form>
            <div class="city-date-section">
                <h2 class="city">Pune</h2>
                <p class="date">7 Jan 2024</p>
            </div>
            <div class="temperature-info">
                <div class="description">
                    <i class="material-icons">sunny</i>
                    <span class="description-text">Sunny</span>
                </div>
                <div class="temp">20°</div>
            </div>
            <div class="additional-info">
                <div class="wind-info">
                    <i class="material-icons">air</i>
                    <div>
                        <h3 class="wind-speed">4 KM/H</h3>
                        <p class="wind-label">Wind</p>
                    </div>
                </div>
                <div class="humidity-info">
                    <i class="material-icons">water_drop</i>
                    <div>
                        <h3 class="humidity">45%</h3>
                        <p class="humidity-label">humidity</p>
                    </div>
                </div>
                <div class="visibility-info">
                    <i class="material-icons">visibility</i>
                    <div>
                        <h3 class="visibility-distance">4 KM/H</h3>
                        <p class="visibility">Visibility</p>
                    </div>
                </div>
            </div>
        </div>

        <script>
        const apiKey = '34305f1a36d2ad042b8c9c4e0b723d7f'
var latitude = null;
var longitude = null;


if (navigator.geolocation)
{
    navigator.geolocation.getCurrentPosition((loc) => {
        latitude = loc.coords.latitude;
        longitude = loc.coords.longitude;
        fetchWeatherDataGps()
     })

}
 else {
    alert("Geolocation is not supported by this browser.");
}

async function fetchWeatherDataGps() {
    try {
        const response = await fetch(
            `https://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longitude}&units=metric&appid=${apiKey}`);

        if (!response.ok) {
            throw new Error("Unable to fetch weather data");
        }
        const data = await response.json();
      
        updateWeatherUI(data);
    } catch (error) {
        console.error(error);
    }
}


async function fetchWeatherData(city) {
    try {
        const response = await fetch(
            `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${apiKey}`
        );

        if (!response.ok) {
            throw new Error("Unable to fetch weather data");
        }
        const data = await response.json();
      
        updateWeatherUI(data);
    } catch (error) {
        console.error(error);
    }
}


const cityElement = document.querySelector(".city");
const temperature = document.querySelector(".temp");
const windSpeed = document.querySelector(".wind-speed");
const humidity = document.querySelector(".humidity");
const visibility = document.querySelector(".visibility-distance");
const descriptionText = document.querySelector(".description-text");
const date = document.querySelector(".date");
const descriptionIcon = document.querySelector(".description i");


function updateWeatherUI(data) {
    cityElement.textContent = data.name;
    temperature.textContent = `${Math.round(data.main.temp)}`;
    windSpeed.textContent = `${data.wind.speed} km/h`;
    humidity.textContent = `${data.main.humidity}%`;
    visibility.textContent = `${data.visibility / 1000} km`;
    descriptionText.textContent = data.weather[0].description;

    const currentDate = new Date();
    date.textContent = currentDate.toDateString();
    const weatherIconName = getWeatherIconName(data.weather[0].main);
    descriptionIcon.innerHTML = `<i class="material-icons">${weatherIconName}</i>`;
}

const formElement = document.querySelector(".search-form");
const inputElement = document.querySelector(".city-input");

formElement.addEventListener("submit", function (e) {
    e.preventDefault();

    const city = inputElement.value;
    if (city !== "") {
        fetchWeatherData(city);
        inputElement.value = "";
    }
});

function getWeatherIconName(weatherCondition) {
    const iconMap = {
        Clear: "wb_sunny",
        Clouds: "wb_cloudy",
        Rain: "umbrella",
        Thunderstorm: "flash_on",
        Drizzle: "grain",
        Snow: "ac_unit",
        Mist: "cloud",
        Smoke: "cloud",
        Haze: "cloud",
        Fog: "cloud",
    };

    return iconMap[weatherCondition] || "help";
}

        </script>
    </body>
</html>
