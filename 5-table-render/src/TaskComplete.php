<?

namespace Acme;

use Acme\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TaskComplete extends Command {
    protected function configure()
    {
        $this->setName('render:complete')
            ->setDescription('complete task')
            ->addArgument('task', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $task = $input->getArgument('task');
        $this->database->query("delete from tasks where id=:task", [$task]);
        $output->writeln("<info>Task $task complete</info>");
        $this->showTasks($output);
    }
    
}
