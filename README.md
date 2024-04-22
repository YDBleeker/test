## Installation

Add the git repository in the `composer.json` file:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "github link"
    }
]
```

You can install the package via Composer:

```bash
composer require yonidebleeker/webinsights
```

Ensure that Tailwind CSS is installed in your project. Append the following line to the `tailwind.config.js` file at the end of the `content` object:

```javascript
"./vendor/yonidebleeker/webinsights/resources/views/*.blade.php"
```

## Usage

In your `app.php`, within the `->withMiddleware(function (Middleware $middleware) {` section, add the following:

```php
$middleware->alias([
    'cookie' => AssignCookie::class,
]);
```

Do not forget to import the middleware!

```php
use Yonidebleeker\Webinsights\Http\Middleware\AssignCookie;
```

To use this package, you need to group your routes and apply the middleware.

```php
Route::middleware(['cookie'])->group(function () {
    // Your routes here
});
```

Navigate to domain.com/webinsights to access and utilize the package dashboard within your Laravel application!

## Customaziotion 

If you want to change the default color you can change them in the `tailwind.config.js`

```js
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

## Credits

- [Yoni De Bleeker](https://github.com)


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.                                                                                                                            