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
        //Parameter Command
        $now = new \DateTime();
        $output->writeln('<comment>End : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');
        $output->writeln([
            'Resolved Sudoku Command',
            '=======================',
            '',

        ]);

        $winSudoku = 0;
        //End Parameter Command


        $em = $this->getContainer()->get('doctrine')->getManager();

        $em->getConnection()->getConfiguration()->setSQLLogger(null);

        $listSudoku = $em->getRepository('SudokuBundle:Grille')->findAll();


        $size = count($listSudoku);
        $bashSize = 1;
        $i = 0;

        $progress = new ProgressBar($output, $size);
        $progress->start();


        foreach ($listSudoku as $sudoku) {


            $sudokuResolved = array(
                1 => explode(',', $sudoku->getLine1()),
                2 => explode(',', $sudoku->getLine2()),
                3 => explode(',', $sudoku->getLine3()),
                4 => explode(',', $sudoku->getLine4()),
                5 => explode(',', $sudoku->getLine5()),
                6 => explode(',', $sudoku->getLine6()),
                7 => explode(',', $sudoku->getLine7()),
                8 => explode(',', $sudoku->getLine8()),
                9 => explode(',', $sudoku->getLine9()),
            );

            $squareTrue = $this->getContainer()->get('checking.sudoku')->falseSquare($sudokuResolved);

            if ($squareTrue == true) {
                //Rajoute Win à Resolved si le sudoku n'a pas d'erreur
                $win = $em->getRepository('SudokuBundle:Grille')->getAllWinCommand($sudoku->getId());
                $winSudoku++;

            }
            $em->flush();
            if (($i % $bashSize) === 0) {
                $em->clear();
                $progress->advance($bashSize);
            }
            $i++;
        }
        //Parameter Command
        $output->writeln([
            '',
            '=======================',
            'End Sudoku Resolved',
            'Number Players :'. $size,
            'Number Players Win : '.$winSudoku,

        ]);
        $now = new \DateTime();
        $output->writeln('<comment>Start : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');
        //End Parameter Command

    }





}
