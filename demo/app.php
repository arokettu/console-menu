<?php

/**
 * @copyright 2020 Anton Smirnov
 * @license MIT https://spdx.org/licenses/MIT.html
 */

declare(strict_types=1);

use Arokettu\ConsoleMenu\ConsoleMenuCommand;
use Dummy\Dummy\DummyCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\CommandLoader\FactoryCommandLoader;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/dummy_command.php';

$app = new Application();

$app->setCommandLoader(new FactoryCommandLoader([
    'menu' => static function () {
        return new ConsoleMenuCommand('menu');
    },
    'demo:command:c1' => static function () {
        return new DummyCommand('demo:command:c1');
    },
    'demo:command:c2' => static function () {
        return new DummyCommand('demo:command:c2');
    },
    'test:test' => static function () {
        return new DummyCommand('test:test');
    },
    'root' => static function () {
        return new DummyCommand('root');
    },
    'cmd:cmd' => static function () {
        return new DummyCommand('cmd:cmd');
    },
    'cmd:cmd:cmd' => static function () {
        return new DummyCommand('cmd:cmd:cmd');
    },
]));

$app->run();
