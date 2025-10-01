<?php

/**
 * @copyright 2023 Anton Smirnov
 * @license MIT https://spdx.org/licenses/MIT.html
 */

declare(strict_types=1);

namespace Arokettu\ConsoleMenu;

use PhpSchool\CliMenu\Builder\CliMenuBuilder;
use PhpSchool\CliMenu\CliMenu;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\OutputInterface;

final class ConsoleMenuCommand extends Command
{
    public const STYLE_PLAIN   = 1;
    public const STYLE_GROUPED = 2;
    /**
     * @internal
     */
    public const STYLE_SUBMENU = 3;

    protected static $defaultName = 'menu';

    private $style;
    private $exit = 0;
    /**
     * @var CliMenu
     */
    private $menu = null;

    public function __construct(?string $name = null, int $style = self::STYLE_GROUPED)
    {
        parent::__construct($name);
        $this->style = $style;
    }

    public function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->setDescription('Console Menu');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $app = $this->getApplication();

        $commands = $app->all();

        uksort($commands, function ($k1, $k2) {
            switch ($this->style) {
                case self::STYLE_PLAIN:
                    return strcmp($k1, $k2);

                case self::STYLE_GROUPED:
                    $isRoot1 = strpos($k1, ':') === false;
                    $isRoot2 = strpos($k2, ':') === false;

                    if ($isRoot1 xor $isRoot2) {
                        return $isRoot2 <=> $isRoot1;
                    } else {
                        return strcmp($k1, $k2);
                    }

                default:
                    throw new \LogicException('Invalid menu style');
            }
        });

        $menuBuilder = new CliMenuBuilder();
        $menuBuilder->setTitle($app->getLongVersion());

        $this->buildMenu($menuBuilder, $commands, $output);

        $menuBuilder->addLineBreak('=');

        $this->menu = $menuBuilder->build();

        $this->menu->open();

        return $this->exit;
    }

    private function buildMenu(CliMenuBuilder $menuBuilder, array $commands, OutputInterface $output): void
    {
        if ($this->style === self::STYLE_SUBMENU) {
            // todo
        } else {
            $this->buildPlainMenu($menuBuilder, $commands, $output);
        }
    }

    private function buildPlainMenu(CliMenuBuilder $menuBuilder, array $commands, OutputInterface $output): void
    {
        $root = '';
        foreach ($commands as $name => $command) {
            if ($command === $this) {
                continue;
            }

            if ($this->style === self::STYLE_GROUPED) {
                $colon = strpos($name, ':');

                if ($colon) {
                    $newRoot = substr($name, 0, $colon);
                } else {
                    $newRoot = '';
                }

                if ($newRoot !== $root) {
                    $menuBuilder->addLineBreak('-');
                    $root = $newRoot;
                }
            }

            $menuBuilder->addItem($name, function () use ($command, $output): void {
                $this->runCommand($command, $output);
            });
        }
    }

    private function runCommand(Command $command, OutputInterface $output): void
    {
        if ($command->getSynopsis() === $command->getName()) {
            $cli = '';
        } else {
            $result = $this->menu->askText()
                ->setPromptText($command->getSynopsis())
                // This closure is later bound
                // phpcs:ignore SlevomatCodingStandard.Functions.StaticClosure.ClosureNotStatic
                ->setValidator(function () {
                    return true;
                }) // allow empty
                ->ask();
            $cli = $result->fetch();
        }

        $input = new StringInput($command->getName() . ' ' . $cli);

        $this->exit = $this->getApplication()->run($input, $output);
    }
}
