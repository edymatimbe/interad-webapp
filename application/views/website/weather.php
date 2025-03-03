<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Temperatura Atual</title>
    <style>
      body {
        background-color: #eaeaea;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
        font-family: 'Arial', sans-serif;
      }

      .weather-card {
        background-color: white;
        border-radius: 20px;
        padding: 20px 30px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
        width: 300px;
        text-align: center;
        position: relative;
      }

      h1 {
        font-size: 22px;
        color: #333;
        margin-bottom: 20px;
      }
      h2 {
        font-size: 24px;
      }
      .temperature {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        margin-bottom: 15px;
        color: #000;
      }

      .weather-icon {
        width: 100px; /* Adjust the size of the icon */
        margin-bottom: 15px;
      }

      .details {
        margin-top: 15px;
      }

      .detail {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-top: 1px solid #e0e0e0;
      }

      .detail:first-child {
        border-top: none;
      }

      .label {
        font-size: 14px;
        color: #666;
        display: flex;
        align-items: center;
      }

      .value {
        font-size: 14px;
        color: #666;
      }

      .label::before {
        content: '';
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-right: 6px;
      }

      .detail:nth-child(1) .label::before {
        background-color: #4caf50;
      }

      .detail:nth-child(2) .label::before {
        background-color: #2196f3;
      }

      .detail:nth-child(3) .label::before {
        background-color: red;
      }

      .detail:nth-child(4) .label::before {
        background-color: lightblue;
      }
      a {
        text-decoration: none;
      }

      /* Center button container */
      .back-button {
        background-color: white;
        border-radius: 1rem;
        color: black;
        padding: 1rem 0rem;
        margin-top: 1rem;
        text-decoration: none;
        font-size: 2rem;
        /* Adjust as needed */
      }

      .back-button div {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0.1rem 2rem;
      }

      .back-button img {
        width: 40px;
      }
    </style>
  </head>
  <body>
    <h2 id="location">TEMPERATURA</h2>
    <div class="weather-container" id="weather-container"></div>

    <a
      href="<?= base_url('homepage') ?>"
      style="
        background-color: white;
        border-radius: 1rem;
        color: black;
        padding: 1rem 1.5rem;
        margin-top: 2rem;
        text-decoration: none;
        font-size: 2rem;
      "
    >
      <div
        style="
          display: flex;
          justify-content: center;
          align-items: center;
          width: 40%;
          padding-left: 3.5rem;
        "
      >
        <img src="./back.svg" width="40" alt="" />
        <div>&nbsp;<b>Voltar</b></div>
      </div>
    </a>
    <div style="font-weight: bold; margin-top: 1rem" id="live-time"></div>
    <script>
      function fetchWeather(lat, lon) {
        const apiKey = '210f34a0a3ff4b29b84215941212610'; // Replace with your WeatherAPI key
        // const apiUrl = `http://api.weatherapi.com/v1/current.json?key=${apiKey}&q=${lat},${lon}`;
        const apiUrl = `http://api.weatherapi.com/v1/forecast.json?key=${apiKey}&q=${lat},${lon}&days=1`;
        fetch(apiUrl)
          .then((response) => response.json())
          .then((data) => {
            if (data.error) {
              document.getElementById('weather-container').innerHTML = `
                            <h1>Localização</h1>
                            <div class="temperature">-</div>
                            <div id="description">Cidade não encontrada</div>
                        `;
              return;
            }

            const location = `${data.location.name}, ${data.location.country}`;
            const temperature = `${data.current.temp_c} °C`;
            const description = data.current.condition.text;
            const wind = data.current.wind_kph + ' KM/H';
            const humidity = data.current.humidity + '%';
            const iconUrl = data.current.condition.icon;
            const tempMin = `${data.forecast.forecastday[0].day.mintemp_c} °C`;
            const tempMax = `${data.forecast.forecastday[0].day.maxtemp_c} °C`;

            document.getElementById('weather-container').innerHTML = `
                        <div class="weather-card">
                            <h1>${location}</h1>
                            <img src="http://${iconUrl}" alt="${description}" class="weather-icon" />
                            <div class="temperature">${temperature}</div>
                            <div id="description">${description}</div>
                            <div class="details">
                                <div class="detail">
                                    <span class="label">VENTO</span>
                                    <span class="value">${wind}</span>
                                </div>
                                <div class="detail">
                                    <span class="label">HUMIDADE</span>
                                    <span class="value">${humidity}</span>
                                </div>
                                 <div class="detail">
                                    <span class="label">MAXIMA</span>
                                    <span class="value">${tempMax}</span>
                                </div>
                                <div class="detail">
                                    <span class="label">MINIMA</span>
                                    <span class="value">${tempMin}</span>
                                </div>
                            </div>
                        </div>
                    `;
          })
          .catch((error) => {
            console.error('Error fetching weather data:', error);
          });
      }

      function getLocationAndFetchWeather() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
            (position) => {
              const lat = position.coords.latitude;
              const lon = position.coords.longitude;
              fetchWeather(lat, lon);
            },
            (error) => {
              console.error('Error getting location:', error);
              document.getElementById('weather-container').innerHTML = `
                        <h1>Localização</h1>
                        <div class="temperature">-</div>
                        <div id="description">Não foi possível obter a localização</div>
                    `;
            }
          );
        } else {
          document.getElementById('weather-container').innerHTML = `
                    <h1>Localização</h1>
                    <div class="temperature">-</div>
                    <div id="description">Geolocalização não suportada</div>
                `;
        }
      }

      window.addEventListener('load', getLocationAndFetchWeather);

      // JavaScript to randomly display a section
      document.addEventListener('DOMContentLoaded', () => {
        const sections = document.querySelectorAll('.section');
        const randomIndex = Math.floor(Math.random() * sections.length);
        sections[randomIndex].classList.add('active');
      });

      function updateTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const timeString = `${hours}:${minutes}:${seconds}`;

        document.getElementById('live-time').textContent = timeString;
      }

      // Update the time every second
      setInterval(updateTime, 1000);

      // Initialize the time on page load
      updateTime();
    </script>
  </body>
</html>
