# Console Menu

[![Packagist](https://img.shields.io/packagist/v/arokettu/console-menu.svg)](https://packagist.org/packages/arokettu/console-menu)
[![Packagist](https://img.shields.io/packagist/l/arokettu/console-menu.svg)](https://opensource.org/licenses/MIT)

Command list menu for [Symfony Console]

![Screenshot](https://sandfox.dev/_images/menu.png)

## Installation

```bash
composer require 'arokettu/console-menu'
```

## Simple Usage

Just add the command to the Symfony Application:

```php
<?php

$app = new \Symfony\Component\Console\Application();

$app->add(new \Arokettu\ConsoleMenu\ConsoleMenuCommand());
```

## Documentation

Read full documentation here: <https://sandfox.dev/php/console-menu.html>

## Support

Please file issues on our main repo at GitLab: <https://gitlab.com/sandfox/console-menu/-/issues>

## License

The library is available as open source under the terms of the [MIT License].

[Symfony Console]:  https://symfony.com/doc/current/components/console.html
[MIT License]:      https://opensource.org/licenses/MIT
