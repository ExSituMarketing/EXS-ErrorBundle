<?php
namespace EXS\ErrorBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ErrorNoticeCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('_test:command:notice')
            ->setDescription('Test PHP notice thrown via command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        trigger_error('sample PHP Notice', E_USER_NOTICE);
        // Should never be executed
        $output->writeln('Hello World');
    }
}
