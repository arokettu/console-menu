<?php

declare(strict_types=1);

namespace Dummy\Dummy;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DummyCommand extends Command
{
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln($this->getName() . ' was called');
        return 0;
    }
}
