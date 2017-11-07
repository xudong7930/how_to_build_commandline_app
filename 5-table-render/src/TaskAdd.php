<?

namespace Acme;

use Acme\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TaskAdd extends Command {
    public function configure()
    {
        $this->setName('render:add')
            ->setDescription('add task to sqlite table.')
            ->addArgument('title', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $title = $input->getArgument('title');
        $this->database->query("insert into tasks(title) values(:title)", [$title]);

        $output->writeln("<info>Task Added</info>");
        $this->showTasks($output);
    }
}
