<?php

namespace App\Command;

use App\Manager\ScreenManager;
use App\Model\Coordinate;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Cursor;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Terminal;

class MatrixCommand extends Command
{
    const MICRO_WAIT = 1250000; // 1.000.000 = 1.00 second
                                //   500.000 = 0.50 second
                                //   250.000 = 0.25 second

    protected static $defaultName = 'app:matrix';
    private ScreenManager $screenManager;

    /**
     * Methods
     */

    protected function configure()
    {
        $this
            ->setDescription('Starts a Matrix video effect in current terminal window.')
            ->setHelp(
                'This command starts a Matrix video effect in the current terminal window that can act as a console screen saver.'
            );
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);
        $terminal = new Terminal();
        $terminalCoordinates = new Coordinate($terminal->getWidth(), $terminal->getHeight());
        $this->screenManager = new ScreenManager($terminalCoordinates);
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $cursor = new Cursor($output);
        $cursor->clearScreen();

        $cursor->moveToPosition($this->screenManager->getHalfScreenSizeWidth(), 0);
        $output->writeLn('Current Teminal size '.$this->screenManager->getSize());
        usleep(self::MICRO_WAIT);

        $cursor->moveToPosition(1, $this->screenManager->getHalfScreenSizeHeight());
        $cursorCoordinates = Coordinate::buildFromArray($cursor->getCurrentPosition());
        $output->writeLn('Current Cursor coordinates '.$cursorCoordinates);

        return Command::SUCCESS; // or return Command::FAILURE;
    }
}
