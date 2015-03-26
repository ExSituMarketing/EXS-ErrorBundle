<?php
namespace EXS\ErrorBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ErrorFatalCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('_test:command:fatal')
            ->setDescription('Test PHP fatal error thrown via command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        trigger_error('sample PHP Fatal', E_USER_ERROR);
        // Should never be executed
        $output->writeln('Hello World');
    }
}
