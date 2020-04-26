<?php

namespace App\Command;

use App\Model\Coordinate;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Cursor;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Terminal;

class TestCommand extends Command
{
    protected static $defaultName = 'app:test';

    protected function configure()
    {
      $this
          ->setDescription('Testing command outputs.')
          ->setHelp('This command allows you to know how many cols & rows are in your current terminal window.')
      ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $terminal = new Terminal();
        $terminalCoordinates = new Coordinate($terminal->getWidth(), $terminal->getHeight());
        $cursor = new Cursor($output);
        $cursor->clearScreen();

        $cursor->moveToPosition(1, 0);
        $output->writeLn('Current Teminal size '. $terminalCoordinates);
        $cursor->moveToPosition(1, $terminalCoordinates->getY() - 2);
        $cursorCoordinates = Coordinate::buildFromArray($cursor->getCurrentPosition());
        $output->writeLn('Current Cursor coordinates '. $cursorCoordinates);

        return Command::SUCCESS; // or return Command::FAILURE if it fails;
    }
}
