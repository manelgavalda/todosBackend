# todosBackend
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/manelgavalda/todosBackend/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/manelgavalda/todosBackend/?branch=master)
[![Build Status](https://travis-ci.org/manelgavalda/todosBackend.svg?branch=master)](https://travis-ci.org/manelgavalda/todosBackend)
[![StyleCI](https://styleci.io/repos/71568885/shield?branch=master)](https://styleci.io/repos/71568885)
[![Code Coverage](https://scrutinizer-ci.com/g/manelgavalda/todosBackend/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/manelgavalda/todosBackend/?branch=master)


This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Install

Clone via github:

``` bash
$ git clone git@github.com:manelgavalda/todosBackend.git
```

Run composer install and npm install(or yarn):
``` bash
$ composer install
$ yarn
```

Copy .env.example to .env, and edit with your configuration:
``` bash
$ cp .env.example .env
```

Generate new artisan key:
``` bash
$ php artisan key:generate
```

## Database

Run migrations (with --seed if you want to fill the database):
``` bash
$ php artisan migrate:refresh --seed
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email manelgavalda@iesebre.com instead of using the issue tracker.

## Credits

- [Manel Gavaldà Andreu][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/manelgavalda/todos-backend.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/manelgavalda/todos-backend/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/manelgavalda/todos-backend.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/manelgavalda/todos-backend.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/manelgavalda/todos-backend.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/manelgavalda/todos-backend
[link-travis]: https://travis-ci.org/manelgavalda/todos-backend
[link-scrutinizer]: https://scrutinizer-ci.com/g/manelgavalda/todos-backend/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/manelgavalda/todos-backend
[link-downloads]: https://packagist.org/packages/manelgavalda/todos-backend
[link-author]: https://github.com/manelgavalda
[link-contributors]: ../../contributors