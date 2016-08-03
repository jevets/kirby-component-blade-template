## Blade Template for Kirby CMS

Bring [Laravel][laravel]'s [Blade Templates][blade] to [Kirby CMS][getkirby].

See [this pre-packaged Kirby plugin][blade-plugin] for a quick drop-in plugin solution.

This library extends Kirby's native `Component\Template` class with one that supports Blade Templates. Use this in your own project, or use [my packaged Kirby plugin][blade-plugin].

## Installation

Install this with composer:

```sh
composer require jevets/kirby-component-blade-template
```

## Configuration

### Views

By default, the library will look for views in the `site/resources/views` directory. This is a Laravel convention and also makes it easier if you're working with Laravel Elixir.

### Cache

By default, the library will attempt to cache views in Kirby's main `site/cache` directory.

**You can easily change these in your kirby config:**

```php
c::set('blade_views_path', 'path/to/templates');
c::set('blade_cache_path', 'path/to/cache');
```

See also: _My [PHPDotEnv package for Kirby CMS][kirby-dot-env]_

## Usage

Example:

```php
// views/layouts/app.blade.php
<!DOCTYPE html>
<html>
<body>
    @yield('content')
</body>
</html>
```

```php
// views/home.blade.php
@extends('layouts.app')

@section('content')
    <h1>{{ $page->title() }}</h1>
    {!! $page->text()->kirbytext() !!}
@stop
```

**Usage notes**

- See [Blade's documentation][blade] for more usage information.
- This package uses [PhiloNL's standalone Blade component][philonl], so check specifc Blade version compatability with PhiloNL's component.

## Changelog

### 2016-08-03

- Initial public release

## Contributing

- Pull requests are welcome
- Please use this project's GitHub issue tracker for any issues
- If you're having trouble with the plugin, please use its GitHub issue tracker.

[blade-plugin]: https://github.com/jevets/kirby-plugin-blade-template
[laravel]: https://laravel.com/
[blade]: https://laravel.com/docs/5.2/blade
[getkirby]: http://getkirby.com
[kirby-dot-env]: https://github.com/jevets/kirby-phpdotenv
[philonl]: https://github.com/PhiloNL/Laravel-Blade