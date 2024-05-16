## Installation

1. Add the git repository in the `composer.json` file:

    ```json
    "repositories": [
        {
            "type": "vcs",
            "url": "github link"
        }
    ]
    ```

2. Install the package via Composer:

    ```bash
    composer require yonidebleeker/webinsights
    ```

3. Execute the package installation command:

    ```bash
    php artisan webinsights::install
    ```

4. Ensure that Tailwind CSS is installed in your project. Append the following line to the `tailwind.config.js` file at the end of the `content` object:

    ```javascript
    "./vendor/yonidebleeker/webinsights/resources/views/*.blade.php"
    ```

    Additionally, copy the following code into the `tailwind.config.js` if you want to customize the colors you can change them:

    ```javascript
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
    ```

5. Create a route named `webinsights.goback` to provide a return point when the user wants to click on the back button:

    ```php
    Route::get('/url', function () {
        // redirect here 
    })->name('webinsights.goback');
    ```

## Usage

1. In your `app.php`, within the `->withMiddleware(function (Middleware $middleware) {` section, add the following:

    ```php
    $middleware->alias([
        'cookie' => AssignCookie::class,
    ]);
    ```

    Don't forget to import the middleware!

    ```php
    use Yonidebleeker\Webinsights\Http\Middleware\AssignCookie;
    ```

2. To use this package, group your routes and apply the middleware:

    ```php
    Route::middleware(['cookie'])->group(function () {
        // Your routes here
    });
    ```

3. Navigate to `domain.com/webinsights` to access and utilize the package dashboard within your Laravel application!

## Credits

- [Yoni De Bleeker](https://github.com)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
