<?php

declare(strict_types=1);

use Arokettu\ConsoleMenu\ConsoleMenuCommand;
use Dummy\Dummy\DummyCommand;
use Symfony\Component\Console\Application;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/dummy_command.php';

$app = new Application();

$app->add(new ConsoleMenuCommand('menu'));
$app->add(new DummyCommand('demo:command:c1'));
$app->add(new DummyCommand('demo:command:c2'));
$app->add(new DummyCommand('test:test'));
$app->add(new DummyCommand('root'));
$app->add(new DummyCommand('cmd:cmd'));
$app->add(new DummyCommand('cmd:cmd:cmd'));

$app->run();
