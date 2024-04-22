// tailwind.config.js
module.exports = {
    purge: [
      "./node_modules/flowbite/**/*.js",
      './vendor/yonidebleeker/webinsights/resources/views/*.blade.php',
    ],
    theme: {
      extend: {
        colors: {
          'webinsights-bg-color': '#e2e8f0',
          'webinsights-text-color': '#000000',
          'webinsights-widget-color': '#ffffff',
          'webinsights-linegraph-color': '#a3e635',
          'webinsights-piegraph-color-1': '#a3e635',
          'webinsights-piegraph-color-2': '#4ade80',
          'webinsights-piegraph-color-3': '#22d3ee',
          'webinsights-piegraph-color-4': '#facc15',
          'webinsights-piegraph-color-5': '#f87171',
        },
      },
    },
    plugins: [
    ],
  };
