<?

namespace Acme;

use Acme\DatabaseAdapter;
use Acme\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RenderTask extends Command {
    
    public function configure()
    {
        $this->setName('render:table')
            ->setDescription('render you table data');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->showTasks($output);
    }
}
