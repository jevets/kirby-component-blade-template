## Blade Template for Kirby CMS

Bring [Laravel][laravel]'s [Blade Templates][blade] to [Kirby CMS][getkirby].

This component is in alpha stage.

**See [this pre-packaged Kirby plugin][blade-plugin] for a quick drop-in plugin solution.**

This library extends Kirby's native `Kirby\Component\Template` class with one that supports Blade Templates. Use this in your own composer-based project, or use [my packaged Kirby plugin][blade-plugin].

## Installation

Install this with composer:

```sh
composer require jevets/kirby-component-blade-template
```

## Configuration

### Views

By default, the library will look for views in the `site/blade` directory. 

*Note: I recommend against using `site/templates` for your Blade views, in case you ever decide to switch template systems in the future. Or maybe you have another application that also uses these blade views...*

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

- See [Blade's documentation][blade] for more info on Blade usage.
- This package uses [PhiloNL's standalone Blade component][philonl], so please check any version-specifc Blade compatability against PhiloNL's component.
- Snippets will still work as expected, however, **native Kirby templates will not**. (See [Note #1](#other-notes) below).

## Road Map

- [ ] Release a packaged, drop-in plugin (will be published [at this repo][blade-plugin])
- [ ] Add support for running both native Kirby templates and Blade templates at the same time. (I'd like to allow as many template engines as needed to run in parallel, but... see [Note #1](#other-notes) below).

## Other Notes

1. Kirby only allows for one `template` component in its registry. See Kirby's [docs on components][kirby-components] and [docs on the extension registry][kirby-registry] for more info. Until either Kirby allows more than one or I find another solution, we're limited to only one template engine.

## Contributing

- Pull requests are welcome
- Please use this project's GitHub issue tracker for any issues
- If you're having trouble with the plugin, please use its GitHub issue tracker.

## Changelog

### 2016-08-03

- Initial public release

[blade-plugin]: https://github.com/jevets/kirby-plugin-blade-template
[laravel]: https://laravel.com/
[blade]: https://laravel.com/docs/5.2/blade
[getkirby]: http://getkirby.com
[kirby-dot-env]: https://github.com/jevets/kirby-phpdotenv
[philonl]: https://github.com/PhiloNL/Laravel-Blade
[kirby-registry]: https://getkirby.com/docs/developer-guide/plugins/registry
[kirby-components]: https://getkirby.com/docs/developer-guide/plugins/components