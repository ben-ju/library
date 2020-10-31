<?php

namespace App\Command;

use App\Entity\Author;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UnpaidPenalty extends Command
{
    protected static $defaultName = 'app:author';

    protected function configure()
    {
        $this->setDescription('Make author command')
            ->setHelp('yes')
            ->addArgument('author');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Make author command \n =================================");
        $io = new SymfonyStyle($input, $output);

        $createAuthor = $io->ask('Do you want to create a new Author [no]') === 'yes';

        if (!$createAuthor) {
            $io->writeln('Bye bye !');
            return Command::SUCCESS;
        }

        $author = new Author();


        $author->setFirstname($io->ask('First name of your author'));
        $author->setLastname($io->ask('Last name of your author'));

        do {
            $date = $io->ask('Birth date of your author [format : YYYY-mm-dd]');

        } while (!$this->isDateFormat($date));

        $author->setBirthDate(new \DateTime($date));

        do {
            $date = $io->ask('Death date of your author [format : YYYY-mm-dd] can be nullable');
            $io->writeln($date);
        } while (!$this->isDateFormat($date) || $date === null);

        if ($date !== '') {
            $author->setDeathDate(new \DateTime($date));
        }



        return Command::SUCCESS;

    }

    public function isDateFormat($date): bool
    {
        return \DateTime::createFromFormat('Y-m-d', $date) !== false;
    }

}