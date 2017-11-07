<?

namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RenderCommand extends Command {
    public function configure()
    {
        $this->setName('render:array')
            ->setDescription('render your array data');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $table = new Table($output);
        $table->setHeaders(['id', 'name', 'age'])
            ->setRows([
                [1, 'jeffery way', 30],
                [2, 'taylor owtwell', 45]
            ])
            ->render();
    }
}
