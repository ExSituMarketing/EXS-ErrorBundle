<?php
namespace EXS\ErrorBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExceptionCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('_test:command:exception')
            ->setDescription('Test Exception thrown via command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        throw new \Exception('Dummy exception');
        // Should never be executed
        $output->writeln('Hello World');
    }
}
