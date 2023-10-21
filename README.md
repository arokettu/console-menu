# Console Menu

[![Packagist](https://img.shields.io/packagist/v/arokettu/console-menu.svg?style=flat-square)](https://packagist.org/packages/arokettu/console-menu)
[![Packagist](https://img.shields.io/packagist/l/arokettu/console-menu.svg?style=flat-square)](https://opensource.org/licenses/MIT)

Command list menu for [Symfony Console]

![Screenshot](/docs/images/menu.png)

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

Also on Read the Docs: <https://arokettu-console-menu.readthedocs.io/>

## Support

Please file issues on our main repo at GitLab: <https://gitlab.com/sandfox/console-menu/-/issues>

Feel free to ask any questions in our room on Gitter: <https://gitter.im/arokettu/community>

## License

The library is available as open source under the terms of the [MIT License].

[Symfony Console]:  https://symfony.com/doc/current/components/console.html
[MIT License]:      https://opensource.org/licenses/MIT
