<?
namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SayHello extends Command {

    public function configure()
    {
        $this->setName('sayhello')
            ->setDescription('some description about sayhello')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'which name do you want',
                null
            )
            ->addOption('greeting', null, InputOption::VALUE_OPTIONAL, 'overide default greeitng', 'hello');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $greeting = $input->getOption('greeting');

        $message = $greeting ?: "hello";
        $message .= ", <info>{$name}</info>";
        $output->writeln($message);
    }
}
