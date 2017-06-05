<?php

namespace SudokuBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;

use SudokuBundle\Entity\Grille;
/**
 * Created by PhpStorm.
 * User: wingel
 * Date: 03/06/17
 * Time: 21:38
 */

class ImportCsvCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('import:sudoku:csv')
            ->setDescription('Import Sudoku from CSV File');
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->import($input,$output);
    }
    protected function import(InputInterface $input, OutputInterface $output)
    {
        $data = $this->get($input, $output);

        $em = $this->getContainer()->get('doctrine')->getManager();

        $em->getConnection()->getConfiguration()->setSQLLogger(null);

        $size = count($data);
        $bashSize = 25;
        $i = 0;

        $progress = new ProgressBar($output, $size);
        $progress->start();

        foreach($data as $row){
            $grille = $em->getRepository('SudokuBundle:Grille')
                    ->findOneByUser($row);

            if(!is_object($grille)){
                $grille = new Grille();
                $grille->setUser($row[0]);
                $grille->setLine1(implode(",", array_slice($row, 1,9)));
                $grille->setLine2(implode(",", array_slice($row, 10,9)));
                $grille->setLine3(implode(",", array_slice($row, 19,9)));
                $grille->setLine4(implode(",", array_slice($row, 28,9)));
                $grille->setLine5(implode(",", array_slice($row, 37,9)));
                $grille->setLine6(implode(",", array_slice($row, 46,9)));
                $grille->setLine7(implode(",", array_slice($row, 55,9)));
                $grille->setLine8(implode(",", array_slice($row, 64,9)));
                $grille->setLine9(implode(",", array_slice($row, 73,9)));



            }

            $em->persist($grille);

            if(($i % $bashSize) === 0){
                $em->flush();
                $em->clear();

                $progress->advance($bashSize);
            }
            $i++;
        }

        $em->flush();
        $em->clear();

        $progress->finish();

    }




    protected function get(InputInterface $input, OutputInterface $output){
        $fileName = 'data/input.csv';

        $converter = $this->getContainer()->get('import.csvtoarray');
        $data = $converter->convert($fileName, ';');

        return $data;
    }
}