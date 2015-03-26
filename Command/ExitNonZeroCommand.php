<?php
namespace EXS\ErrorBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExitNonZeroCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('_test:command:exit')
            ->setDescription('Test non 0 exit status thrown via command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Should be executed
        $output->writeln('Hello World');
        // Terrible exit statement
        exit(2);
    }
}
