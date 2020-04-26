<?php

namespace App\Command;

use App\Model\Coordinate;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Cursor;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Terminal;

class MatrixCommand extends Command
{
    const MICRO_WAIT = 250.000; // 1.000.000 = 1 second
                                //   500.000 = 0.5 second
                                //   250.000 = 0.25 second

    protected static $defaultName = 'app:matrix';

    protected function configure()
    {
      $this
          ->setDescription('Starts a Matrix video effect in current terminal window.')
          ->setHelp('This command starts a Matrix video effect in the current terminal window that can act as a console screen saver.')
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
        usleep(self::MICRO_WAIT);

        $cursor->moveToPosition(1, 20);
        $cursorCoordinates = Coordinate::buildFromArray($cursor->getCurrentPosition());
        $output->writeLn('Current Cursor coordinates '. $cursorCoordinates);

        return Command::SUCCESS; // or return Command::FAILURE;
    }
}
