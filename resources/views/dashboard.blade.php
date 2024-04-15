<header class="flex flex-row justify-between">
    <h1 class="m-10 text-5xl font-bold">Digital Up Analytics </h1>
    <div class="flex flex-row w-2/5 mb-auto mt-auto">
      <p class="m-1">Van:</p>
      <div class="relative max-w-sm mr-5">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
          </svg>
        </div>
        <input datepicker type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
      </div>
      <p class="m-1">Tot:</p>
      <div class="relative max-w-sm">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
          <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
          </svg>
        </div>
        <input datepicker type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
      </div>
    </div>
  </header>
  
  <div class="flex justify-between">
    <div class= "w-4/5 p-5">
      <div class="flex justify-between">
        <div class="w-1/6 px-4 py-8 my-4 {{ $bgColor }} shadow-md rounded-xl flex flex-col">
            <p class="font-bold text-1xl mr-2 mb-4">Bezoekers Vandaag</p>
            <p class="text-4xl mb-4">115</p>
        </div>
  
        <div class="w-1/6 px-4 py-8 my-4 {{ $bgColor }} shadow-md rounded-xl flex flex-col">
            <p class="font-bold text-1xl mr-2 mb-4">Bounce Percentage</p>
            <p class="text-4xl mb-4">2%</p>
        </div>
  
        <div class="w-1/6 px-4 py-8 my-4 {{ $bgColor }} shadow-md rounded-xl flex flex-col">
            <p class="font-bold text-1xl mr-2 mb-4">Gemiddelde Sessie Duur</p>
            <p class="text-4xl mb-4">3.2min</p>
        </div>
  
        <div class="w-1/6 px-4 py-8 my-4 {{ $bgColor }} shadow-md rounded-xl flex flex-col">
            <p class="font-bold text-1xl mr-2 mb-4">Mobiele Gebruikers</p>
            <p class="text-4xl mb-4">60%</p>
        </div>
  
        <div class="w-1/6 px-4 py-8 my-4 {{ $bgColor }} shadow-md rounded-xl flex flex-col">
            <p class="font-bold text-1xl mr-2 mb-4">Desktop Gebruikers</p>
            <p class="text-4xl mb-4">40%</p>
        </div>
      </div>
  
      <div class="flex justify-between">
        <div class="w-6/12 px-4 py-8 my-4 {{ $bgColor }} shadow-md rounded-xl flex flex-col">
            <p class="font-bold text-1xl mr-2 mb-4">Bezoekers</p>
            <p class="text-4xl mb-4">graph</p>
        </div>
        <div class="w-5/12 px-4 py-8 my-4 {{ $bgColor }} shadow-md rounded-xl flex flex-col">
            <p class="font-bold text-1xl mr-2 mb-4">Bezoekers Afkomst</p>
            <p class="text-4xl mb-4">graph</p>
        </div>
      </div>
    </div>
  
    <div class="w-1/5 p-5">
      <div class="pl-4 py-8 my-4 {{ $bgColor }} shadow-md rounded-xl flex flex-col">
          <p class="font-bold text-1xl mr-2 mb-4">Meest bekeken pagina's</p>
          <p class="text-l mb-4">1. https://test.be/pagina 115</p>
          <p class="text-l mb-4">2. https://test.be/pagina 115</p>
          <p class="text-l mb-4">3. https://test.be/pagina 115</p>
          <p class="text-l mb-4">4. https://test.be/pagina 115</p>
          <p class="text-l mb-4">5. https://test.be/pagina 115</p>
          <p class="text-l mb-4">6. https://test.be/pagina 115</p>
      </div>
  
      <div class="pl-4 py-8 my-4 {{ $bgColor }} shadow-md rounded-xl flex flex-col">
          <p class="font-bold text-1xl mr-2 mb-4">Minst Bekeken Pagina's</p>
          <p class="text-l mb-4">1. https://test.be/pagina 115</p>
          <p class="text-l mb-4">2. https://test.be/pagina 115</p>
          <p class="text-l mb-4">3. https://test.be/pagina 115</p>
          <p class="text-l mb-4">4. https://test.be/pagina 115</p>
          <p class="text-l mb-4">5. https://test.be/pagina 115</p>
          <p class="text-l mb-4">6. https://test.be/pagina 115</p>
      </div>
    </div>
  </div>
  
  <footer>
    <p class="m-3">Powered by digitalUp</p>
  </footer>
  