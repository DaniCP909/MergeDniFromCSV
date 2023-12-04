<?php

namespace Dcorr\MergeDniFromCsv;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputStream;


class Helloworldcommand extends Command
{
    //escribir esto de manera erronea da un error;
    protected static $defaultName = 'hw:command';

    protected function configure()
    {
        $this->setDescription('My custom command');
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'A quien saludo?')
            ->addArgument('lastName', InputArgument::OPTIONAL, 'Apellido')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $text = 'Bienvenido ' . $input->getArgument('name');

        $lastName = $input->getArgument('lastName');

        if($lastName){
            $text .= ' ' . $lastName;
        }

        $output->writeln($text . '!');

        return Command::SUCCESS;
    }
}