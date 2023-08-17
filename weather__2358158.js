const searchContainer = document.querySelector(".search");
const cardContainer = document.querySelector(".card");

let weather = {
  apiKey: "5e0508b3fe1d11466deb56f03a8aea50",
  fetchWeather: function (city) {
    fetch("https://api.openweathermap.org/data/2.5/weather?q=" +city +"&units=metric&appid=" +this.apiKey)
      .then((response) => {
        if (!response.ok) {
          const errorMessage = document.createElement("p");
          errorMessage.className = "error";
          errorMessage.innerHTML = "NO CITY FOUND!";
          cardContainer.innerHTML = ""; // Clear the card container
          cardContainer.appendChild(errorMessage);
          throw new Error("NO CITY FOUND!");
        }
        return response.json();
      })
      .then((data) => this.displayWeather(data));
  },
  displayWeather: function (data) {
    const { name } = data;
    const { icon, description } = data.weather[0];
    const { temp, humidity } = data.main;
    const { speed } = data.wind;
    const { rain } = data;
    const currentDate = new Date();
    const options = {
      weekday: "long",
      year: "numeric",
      month: "long",
      day: "numeric",
    };
    const formattedDate = currentDate.toLocaleDateString("en-US", options);

    // Create HTML elements for weather data
    const dateElement = document.createElement("h2");
    dateElement.className = "date";
    dateElement.textContent = formattedDate;

    const cityElement = document.createElement("h1");
    cityElement.className = "city";
    cityElement.innerText = "Weather in " + name;

    const detailsElement = document.createElement("div");
    detailsElement.className = "details";

    const iconElement = document.createElement("img");
    iconElement.className = "icon";
    iconElement.src = "https://openweathermap.org/img/wn/" + icon + ".png";

    const descriptionElement = document.createElement("p");
    descriptionElement.className = "description";
    descriptionElement.innerText = description;

    const tempElement = document.createElement("p");
    tempElement.className = "temp";
    tempElement.innerText = temp + "°C";

    const humidityElement = document.createElement("p");
    humidityElement.className = "humidity";
    humidityElement.innerText = "Humidity: " + humidity + "%";

    const windElement = document.createElement("p");
    windElement.className = "wind";
    windElement.innerText = "Wind: " + speed + " km/h";

    const maxElement = document.createElement("p");
    maxElement.className = "max";
    maxElement.innerText = "Max: " + data.main.temp_max + "°C";

    const minElement = document.createElement("p");
    minElement.className = "min";
    minElement.innerText = "Min: " + data.main.temp_min + "°C";

    const rainfallElement = document.createElement("p");
    rainfallElement.className = "rainfall";
    if (rain) {
      const { "1h": rainfallValue } = rain;
      if (rainfallValue) {
        rainfallElement.innerText = "Rainfall: " + rainfallValue + "mm";
      } else {
        rainfallElement.innerText = "Rainfall: N/A";
      }
    } else {
      rainfallElement.innerText = "Rainfall: N/A";
    }

    // Append elements to the card container
    cardContainer.innerHTML = "";
    cardContainer.appendChild(dateElement);
    cardContainer.appendChild(cityElement);
    cardContainer.appendChild(detailsElement);
    detailsElement.appendChild(iconElement);
    detailsElement.appendChild(descriptionElement);
    detailsElement.appendChild(tempElement);
    detailsElement.appendChild(humidityElement);
    detailsElement.appendChild(windElement);
    detailsElement.appendChild(maxElement);
    detailsElement.appendChild(minElement);
    detailsElement.appendChild(rainfallElement);

    cardContainer.classList.remove("loading");
  },
  search: function () {
    const searchInput = document.querySelector(".search-bar");
    this.fetchWeather(searchInput.value);
  },
  default: function () {
    this.fetchWeather("Gulariya");
  },
};

searchContainer.querySelector("button").addEventListener("click", function () {
  weather.search();
});

searchContainer.querySelector(".search-bar").addEventListener("keyup", function (event) {
  if (event.key === "Enter") {
    weather.search();
  }
});

weather.default();
