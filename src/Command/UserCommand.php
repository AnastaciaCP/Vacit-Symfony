<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\ArrayInput;

use PhpOffice\PhpSpreadsheet\Reader\xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate; 

use App\Service\UserService;

class UserCommand extends Command
{
    private $us;

    public function __construct(UserService $us)
    {
        parent::__construct();
        $this->us = $us;
    }

    protected function configure() {
        
        $this
            ->setName('app:import-spreadsheet')
            ->setDescription('Import employer through spreadsheet')
            ->setHelp('This command allows you to add an employer wih a spreadsheet')
            ->addArgument('file', InputArgument::REQUIRED, 'Spreadsheet')

            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $inputFileName = $input->getArgument('file');
        $spreadsheet = IOFactory::load($inputFileName);

        $worksheet = $spreadsheet->getActiveSheet();

        $highestRow = $worksheet->getHighestRow();    // e.g. 10
        $highestCol = $worksheet->getHighestColumn();    // e.g. 'J'
        $highestColumnIndex = Coordinate::columnIndexFromString($highestCol);   // e.g. 5
        
        //the first row of the spreadsheet contains the indexes
        $index = array();
        for($i = 1; $i <= $highestColumnIndex; $i++) {
          $index[$i] = $worksheet->getCellByColumnAndRow($i, 1)
                                 ->getValue();
        }
        for($i = 2; $i <= $highestRow; $i++) {
          $params = array();
          for($ii = 1; $ii <= $highestColumnIndex; $ii++) {
            $value = $worksheet->getCellByColumnAndRow($ii, $i)
                                 ->getValue();
            $params[$index[$ii]] = $value;
            
          }

        $output->writeln($params);  
        $output->writeln('===========');                 
        
        $podium = $this->us->createEmployer($params);
        }
        
    }
}



?>