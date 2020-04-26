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
    const MICRO_WAIT =  25000;  // 1.000.000 = 1.00 second
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

        for ($y = 0; $y <= $this->screenManager->getScreenHeight(); $y++) {
            for ($x = 0; $x <= $this->screenManager->getScreenWidth(); $x++) {
                $cursor->moveToPosition($x, $y);
                $output->write($y);
                usleep(self::MICRO_WAIT);
            }
        }

        return Command::SUCCESS;
    }
}
