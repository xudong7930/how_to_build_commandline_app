<?
namespace Acme;

use GuzzleHttp\ClientInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ZipArchive; // PHP内置类

class NewCommand extends Command {
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('new')
            ->setDescription('create a new laravel application')
            ->addArgument('name', InputArgument::REQUIRED, 'application folder name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // 判断文件夹是否存在
        $directory = getcwd().'/'.$input->getArgument('name');
        $this->assertApplicationFolderNotExist($directory, $output);

        // 下载最新的版本
        $output->writeln('<info>Creating Application...</info>');
        $this->download($zipFile = $this->makeFileName())
            ->extract($zipFile, $directory)
            ->cleanup($zipFile);
        
        $output->writeln('<info>Application ready, building something amazing!</info>');
    }

    private function assertApplicationFolderNotExist($folderPath, OutputInterface $output)
    {
        if (is_dir($folderPath)) {
            $output->writeln('<error>Application already exists!</error>');
            exit(1);
        }
    }

    public function download($zipFile)
    {
        $response = $this->client
            ->get('http://cabinet.laravel.com/latest.zip')
            ->getBody();
        file_put_contents($zipFile, $response);
        return $this;
    }

    private function extract($zipFile, $directory)
    {
        $archive = new ZipArchive;
        $archive->open($zipFile);
        $archive->extractTo($directory);
        $archive->close();

        return $this;        
    }

    private function cleanup($zipFile)
    {
        @chmod($zipFile, 0777);
        @unlink($zipFile);
        return $this;
    }

    private function makeFileName()
    {
        return getcwd().'/laravel_'.md5(time()).'.zip';
    }
}
