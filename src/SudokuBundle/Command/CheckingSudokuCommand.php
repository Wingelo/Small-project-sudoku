<?php

namespace SudokuBundle\Command;

use SudokuBundle\SudokuBundle;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\ProgressBar;


use SudokuBundle\Entity\Grille;

class CheckingSudokuCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('sudoku:checking')
            ->setDescription('Checking is Sudoku is correct');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $em->getConnection()->getConfiguration()->setSQLLogger(null);

        $listSudoku = $em->getRepository('SudokuBundle:Grille')->findAll();



        $size = count($listSudoku);
        $bashSize = 1;
        $i = 0;

        $progress = new ProgressBar($output, $size);
        $progress->start();



        foreach($listSudoku as $sudoku){


            $sudokuresolved = array(
                1=>explode(',',$sudoku->getLine1()),
                2=>explode(',',$sudoku->getLine2()),
                3=>explode(',',$sudoku->getLine3()),
                4=>explode(',',$sudoku->getLine4()),
                5=>explode(',',$sudoku->getLine5()),
                6=>explode(',',$sudoku->getLine6()),
                7=>explode(',',$sudoku->getLine7()),
                8=>explode(',',$sudoku->getLine8()),
                9=>explode(',',$sudoku->getLine9()),
            );

            $squaretrue = $this->falsequare($sudokuresolved);
            if($squaretrue == true){
                $win = $em->getRepository('SudokuBundle:Grille')->getAllWin($sudoku->getId());

            }
            $em->flush();
            if(($i % $bashSize) === 0){
                $em->clear();
                $progress->advance($bashSize);
            }
            $i++;
        }

    }


    protected function falsequare($sudoku)
    {
        //SQUARE
        // $i pour le while square
        $i = 0;
        //compteur de ligne sudoku pour le square
        $lss = 0 ;
        //compteur pour array_slice pour le square
        $sl = 0;
        //Si falsesquare a un numéro double donc il est faux
        $falsesquare = false;
        //Si le carrée est unique
        $uniquesquare = false;


        //HORIZONTAL
        //$o pour le while hozitontal
        $o = 0;
        //compteur de ligne sudoku pour l'horizontal
        $lsh = 0;
        //Si false horizontal a un numéro double il est faux
        $falsehorizontal = false;

        $uniquehorizontal = false;



        while($i <= 8 && $falsesquare == false )
        {
            $arraysquare = array_merge(array_slice($sudoku[1+$lss],0+$sl, 3),array_slice($sudoku[2+$lss],0 + $sl,3),array_slice($sudoku[3+$lss],0 + $sl,3));

            $sl += 3;
            $i++;

            if(count($arraysquare) !== count(array_unique($arraysquare))){
                $falsesquare = true;
            }
            else
            {


                if($sl == 9){
                    $sl = 0;
                    $lss +=3;
                }
                if($lss == 9){
                    $uniquesquare = true;

                }
            }

        }
        while($o <= 8 && $uniquesquare == true && $falsehorizontal == false)
        {
            $horizontal = array_merge(array_slice($sudoku[1],$o,1),array_slice($sudoku[2],$o,1),array_slice($sudoku[3],$o,1),array_slice($sudoku[4],$o,1),array_slice($sudoku[5],$o,1),array_slice($sudoku[6],$o,1),array_slice($sudoku[7],$o,1),array_slice($sudoku[8],$o,1),array_slice($sudoku[9],$o,1));

            $o++;

            if(count($horizontal ) !== count(array_unique($horizontal))){
                $falsehorizontal = true;
            }
            else
            {
                if($o == 8){
                    $uniquehorizontal = true;
                }
            }
        }
        if($uniquehorizontal == true && $uniquesquare == true){
            return true;
        }
    }



}
