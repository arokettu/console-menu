<?php

/**
 * @copyright 2020 Anton Smirnov
 * @license MIT https://spdx.org/licenses/MIT.html
 */

declare(strict_types=1);

namespace Dummy\Dummy;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class DummyCommand extends Command
{
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln($this->getName() . ' was called');
        return 0;
    }
}
