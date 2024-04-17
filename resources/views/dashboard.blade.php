<!doctype html>
<html class="bg-slate-200">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>
    <header class="flex flex-row justify-between">
    <h1 class="m-10 text-5xl font-bold">Digital Up Analytics </h1>
    <div class="flex flex-row w-2/5 mb-auto mt-auto">
      <p class="m-3">Van:</p>
      <div class="relative max-w-sm mr-5">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
          </svg>
        </div>
        <input datepicker datepicker-format="dd/mm/yyyy" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Selecteer datum">
      </div>
      <p class="m-3">Tot:</p>
      <div class="relative max-w-sm">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
          </svg>
        </div>
        <input datepicker datepicker-format="dd/mm/yyyy" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Selecteer datum">
      </div>
    </div>
  </header>

  <div class="flex justify-between">
    <div class= "w-4/5 p-5">
      <div class="flex justify-between">
        <div class="w-1/6 px-4 py-8 my-4 bg-white shadow-md rounded-xl flex flex-col">
            <p class="font-bold text-1xl mr-2 mb-4">Bezoekers Vandaag</p>
            <p class="text-4xl mb-4">{{ $averageVisitorsEachDay }}</p>
        </div>

        <div class="w-1/6 px-4 py-8 my-4 bg-white shadow-md rounded-xl flex flex-col">
            <p class="font-bold text-1xl mr-2 mb-4">Bounce Percentage</p>
            <p class="text-4xl mb-4">{{ $bounce_rate }}%</p>
        </div>

        <div class="w-1/6 px-4 py-8 my-4 bg-white shadow-md rounded-xl flex flex-col">
            <p class="font-bold text-1xl mr-2 mb-4">Gemiddelde Sessie Duur</p>
            <p class="text-4xl mb-4">{{ $average_time }}min</p>
        </div>

        <div class="w-1/6 px-4 py-8 my-4 bg-white shadow-md rounded-xl flex flex-col">
            <p class="font-bold text-1xl mr-2 mb-4">Mobiele Gebruikers</p>
            <p class="text-4xl mb-4">{{ $desktop_and_mobile_visitors["mobile"] }}%</p>
        </div>

        <div class="w-1/6 px-4 py-8 my-4 bg-white shadow-md rounded-xl flex flex-col">
            <p class="font-bold text-1xl mr-2 mb-4">Desktop Gebruikers</p>
            <p class="text-4xl mb-4">{{ $desktop_and_mobile_visitors["desktop"] }}%</p>
        </div>
      </div>

      <div class="flex justify-between">
        <div class="w-6/12 px-4 py-8 my-4 bg-white shadow-md rounded-xl flex flex-col">
            <p class="font-bold text-1xl mr-2 mb-4">Bezoekers</p>
            <canvas id="visitors" class="w-full h-1/2 m-4"></canvas>
        </div>
        <div class="w-5/12 px-4 py-8 my-4 bg-white shadow-md rounded-xl flex flex-col">
            <p class="font-bold text-1xl mr-2 mb-4">Bezoekers Afkomst</p>
            <canvas id="source" class="w-full h-1/2 m-4"></canvas>
        </div>
      </div>
    </div>

    <div class="w-1/5 p-5">
      <div class="pl-4 py-8 my-4 shadow-md bg-white rounded-xl flex flex-col">
          <p class="font-bold text-1xl mr-2 mb-4">Meest bekeken pagina's</p>
          @foreach ($mostPageViews as $item)
          <p class="text-l mb-4">{{ $loop->iteration }}. {{ $item['name'] }} {{ $item['count'] }}</p>
          @endforeach
      </div>

      <div class="pl-4 py-8 my-4 shadow-md bg-white rounded-xl flex flex-col">
          <p class="font-bold text-1xl mr-2 mb-4">Minst Bekeken Pagina's</p>
          @foreach ($leastPageViews as $item)
          <p class="text-l mb-4">{{ $loop->iteration }}. {{ $item['name'] }} {{ $item['count'] }}</p>
          @endforeach
      </div>
    </div>
  </div>

  <footer class="w-full">
    <p class="m-3 content-center">Digital up © 2024</p>
  </footer>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('source').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['other', 'facebook', 'google'],
            datasets: [{
                label: 'Source',
                data: [300, 50, 100],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }]
        }
    });

    var ctx = document.getElementById('visitors').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            datasets: [{
                label: 'Visitors',
                data: [12, 19, 3, 5, 2, 3, 10],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                ],
                borderWidth: 1
            }]
        }
    });
</script>
