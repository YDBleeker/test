import colors from './tailwind.config.js';

console.log(colors);

var ctx = document.getElementById('source').getContext('2d');

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
var myChartVisitors = new Chart(ctx, {
    type: 'line',
    data: {
        labels: visitorDays,
        datasets: [{
            label: 'Visitors',
            data: visitorCounts,
            backgroundColor: theme.colors.webinsights-linegraph-color,
            borderColor: theme.colors.webinsights-linegraph-color,
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
