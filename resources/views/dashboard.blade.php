<!doctype html>
<html class="bg-webinsights-bg-color">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>
    <header class="flex flex-col px-5 items-center text-center xl:text-left xl:items-start xl:flex-row xl:justify-between">
        <div class="my-8 xl:my-8 flex flex-col xl:flex-row">
            <button class="absolute top-3 left-3 xl:static xl:top-3 xl:left-3 bg-webinsights-widget-color font-bold p-2 xl:mr-6 rounded" onclick="goBack()">Terug</button>
            <h1 class="mt-8 xl:mt-0 text-5xl font-bold ">Digital Up Analytics</h1>
        </div>
        <div class="flex flex-col xl:flex-row xl:justify-center w-3/6 mb-auto mt-auto">
            <p class="m-3">Van:</p>
            <div class="relative">
                <input type="date" class="block rounded-lg p-2 w-full bg-white border border-gray-300 py-2 px-3 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <p class="m-3">Tot:</p>
            <div class="relative">
                <input type="date" class="block rounded-lg p-2 w-full bg-white border border-gray-300 py-2 px-3 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <button class="bg-black-500 font-bold py-6 xl:py-2 px-4 rounded" onclick="clearFilter()">Verwijder Filter</button>
        </div>
    </header>

  <div class="flex flex-col xl:flex-row justify-between">
    <div class= "xl:w-4/5 px-5">
      <div class="flex flex-col xl:flex-row justify-between">
        <div class="xl:w-1/6 px-4 py-8 my-4 bg-webinsights-widget-color shadow-md rounded-xl flex flex-col">
            <p class="font-bold text-1xl mr-2 mb-4">Gem Bezoekers</p>
            <div class="flex flex-row mb-4">
                <p class="text-2xl">{{ $averageVisitorsEachDay }}</p>
                @php
                $previousChange = $previousPeriodComparison["averageVisitorsEachDay"];
                $changeColorClass = $previousChange > 0 ? 'text-green-400 bg-green-50' : ($previousChange < 0 ? 'text-red-400 bg-red-50' : 'text-gray-600 bg-gray-50');
                $sign = $previousChange > 0 ? '+' : ($previousChange < 0 ? '-' : '+');
                @endphp
                <p class="text-l {{ $changeColorClass }} rounded-xl p-1 ml-2 mt-auto">{{ $sign }}{{ abs($previousChange) }}%</p>
            </div>

        </div>

        <div class="xl:w-1/6 px-4 py-8 my-4 bg-webinsights-widget-color shadow-md rounded-xl flex flex-col">
            <p class="font-bold text-1xl mr-2 mb-4">Bounce Percentage</p>
            <div class="flex flex-row mb-4">
                <p class="text-2xl">{{ $bounce_rate }}%</p>
                @php
                $previousChange = $previousPeriodComparison["bounceRate"];
                $changeColorClass = $previousChange > 0 ? 'text-green-400 bg-green-50' : ($previousChange < 0 ? 'text-red-400 bg-red-50' : 'text-gray-600 bg-gray-50');
                $sign = $previousChange > 0 ? '+' : ($previousChange < 0 ? '-' : '+');
                @endphp
                <p class="text-l {{ $changeColorClass }} rounded-xl p-1 ml-2 mt-auto">{{ $sign }}{{ abs($previousChange) }}%</p>
            </div>
        </div>

        <div class="xl:w-1/6 px-4 py-8 my-4 bg-webinsights-widget-color shadow-md rounded-xl flex flex-col">
            <p class="font-bold text-1xl mr-2 mb-4">Gem Sessie Duur</p>
            <div class="flex flex-row mb-4">
                <p class="text-2xl">{{ $average_time }}min</p>
                @php
                $previousChange = $previousPeriodComparison["averageTime"];
                $changeColorClass = $previousChange > 0 ? 'text-green-400 bg-green-50' : ($previousChange < 0 ? 'text-red-400 bg-red-50' : 'text-gray-600 bg-gray-50');
                $sign = $previousChange > 0 ? '+' : ($previousChange < 0 ? '-' : '+');
                @endphp
                <p class="text-l {{ $changeColorClass }} rounded-xl p-1 ml-2 mt-auto">{{ $sign }}{{ abs($previousChange) }}%</p>
            </div>
        </div>

        <div class="xl:w-1/6 px-4 py-8 my-4 bg-webinsights-widget-color shadow-md rounded-xl flex flex-col">
            <p class="font-bold text-1xl mr-2 mb-4">Mobiele Gebruikers</p>
            <div class="flex flex-row mb-4">
            <p class="text-2xl">{{ $desktop_and_mobile_visitors["mobile"] }}%</p>
            @php
            $previousChange = $previousPeriodComparison["desktopAndMobileVisitors"]["mobile"];
            $changeColorClass = $previousChange > 0 ? 'text-green-400 bg-green-50' : ($previousChange < 0 ? 'text-red-400 bg-red-50' : 'text-gray-600 bg-gray-50');
            $sign = $previousChange > 0 ? '+' : ($previousChange < 0 ? '-' : '+');
            @endphp
            <p class="text-l {{ $changeColorClass }} rounded-xl p-1 ml-2 mt-auto">{{ $sign }}{{ abs($previousChange) }}%</p>
            </div>
        </div>

        <div class="xl:w-1/6 px-4 py-8 my-4 bg-webinsights-widget-color shadow-md rounded-xl flex flex-col">
            <p class="font-bold text-1xl mr-2 mb-4">Desktop Gebruikers</p>
            <div class="flex flex-row mb-4">
            <p class="text-2xl">{{ $desktop_and_mobile_visitors["desktop"] }}%</p>
            @php
            $previousChange = $previousPeriodComparison["desktopAndMobileVisitors"]["desktop"];
            $changeColorClass = $previousChange > 0 ? 'text-green-400 bg-green-50' : ($previousChange < 0 ? 'text-red-400 bg-red-50' : 'text-gray-600 bg-gray-50');
            $sign = $previousChange > 0 ? '+' : ($previousChange < 0 ? '-' : '+');
            @endphp
            <p class="text-l {{ $changeColorClass }} rounded-xl p-1 ml-2 mt-auto">{{ $sign }}{{ abs($previousChange) }}%</p>
            </div>
        </div>
      </div>

      <div class="flex flex-col xl:flex-row justify-between">
        <div class="xl:w-6/12 px-4 py-8 my-4 bg-webinsights-widget-color shadow-md rounded-xl flex flex-col">
            <p class="font-bold text-1xl mr-2 mb-4">Bezoekers</p>
            <canvas id="visitors" class="w-full h-1/2 m-4"></canvas>
        </div>
        <div class="xl:w-5/12 px-4 py-8 my-4 bg-webinsights-widget-color shadow-md rounded-xl flex flex-col">
            <p class="font-bold text-1xl mr-2 mb-4">Bezoekers Afkomst</p>
            <canvas id="source" class="w-full h-1/2 m-4"></canvas>
        </div>
      </div>
    </div>

    <div class="flex flex-col xl:w-1/5 px-5">
      <div class="px-4 py-8 my-4 bg-webinsights-widget-color shadow-md rounded-xl flex flex-col">
          <p class="font-bold text-1xl mr-2 mb-4">Meest bekeken pagina's</p>
          @foreach ($mostPageViews as $item)
          <p class="text-l mb-4">{{ $loop->iteration }}. {{ $item['name'] }} - {{ $item['count'] }}</p>
          @endforeach
      </div>

      <div class="px-4 py-8 my-4 bg-webinsights-widget-color shadow-md rounded-xl flex flex-col">
          <p class="font-bold text-1xl mr-2 mb-4">Minst Bekeken Pagina's</p>
          @foreach ($leastPageViews as $item)
          <p class="text-l mb-4">{{ $loop->iteration }}. {{ $item['name'] }} - {{ $item['count'] }}</p>
          @endforeach
      </div>
    </div>
  </div>

  <footer class="w-full bg-slate-300">
    <p class="py-2 text-center">Digital up © 2024</p>
  </footer>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('source').getContext('2d');

    var sourceLabels = {!! json_encode($source->pluck('source')->toArray()) !!};
    var sourceCounts = {!! json_encode($source->pluck('count')->toArray()) !!};

    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: sourceLabels,
            datasets: [{
                data: sourceCounts,
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

    // Extracting days and counts from the $visitors variable
    var visitorDays = {!! json_encode($visitorsEachDay->pluck('date')->toArray()) !!};
    var visitorCounts = {!! json_encode($visitorsEachDay->pluck('visitor_count')->toArray()) !!};
    var myChartVisitors = new Chart(ctx, {
        type: 'line',
        data: {
            labels: visitorDays,
            datasets: [{
                label: 'Visitors',
                data: visitorCounts,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        }
    });

    const startDateInput = document.getElementById('startDate');
    const endDateInput = document.getElementById('endDate');

    startDateInput.addEventListener('changeDate', function() {
      // Ensure endDate cannot be before startDate
      if (new Date(endDateInput.value) < new Date(startDateInput.value)) {
        endDateInput.value = startDateInput.value;
      }
      if (endDateInput.value && startDateInput.value) {
        updateStatistics(startDateInput.value, endDateInput.value);
      }
    });

    endDateInput.addEventListener('changeDate', function() {
      // Ensure startDate cannot be after endDate
      console.log(endDateInput.value);
      if (new Date(startDateInput.value) > new Date(endDateInput.value)) {
        startDateInput.value = endDateInput.value;
      }
      if (endDateInput.value && startDateInput.value) {
        updateStatistics(startDateInput.value, endDateInput.value);
      }
    });

    function updateStatistics(startDate, endDate) {
        //go to the page with the new dates
        window.location.href = `?start_date=${startDate}&end_date=${endDate}`;
    }

    function clearFilter() {
        window.location.href = '/webinsights';
    }

    function goBack() {
        window.history.back();
    }
</script>
