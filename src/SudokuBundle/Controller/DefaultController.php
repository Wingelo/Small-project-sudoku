<?php

namespace SudokuBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        //Pour Resolved2 prend les 3 gagnants avec le mot "Win".
        $listSudoku = $em->getRepository('SudokuBundle:Grille')->findWinner();
        //Pour Resolved prend les 3 gagnants avec le mot "Win" (Commande Symfony avec sudoku:checking).
        $listSudokuCommand = $em->getRepository('SudokuBundle:Grille')->findCommandWinner();


        return $this->render('SudokuBundle:Default:index.html.twig', array(
            'listsudoku' => $listSudoku,
            'listsudokucommand' => $listSudokuCommand,
        ));
    }

    /**
     * @Route ("/solvedsudoku", name="solved_sudoku")
     * @Method("GET")
     */
     public function SolvedSudokuAction()
     {
         $em = $this->getDoctrine()->getManager();

         $listSudoku = $em->getRepository('SudokuBundle:Grille')->findAll();

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

             $squareTrue = $this->get('checking.sudoku')->falseSquare($sudokuResolved);

             if ($squareTrue == true) {
                 //Rajoute Win à Resolved si le sudoku n'a pas d'erreur
                 $win = $em->getRepository('SudokuBundle:Grille')->getAllWinButton($sudoku->getId());
             }
         }

         return $this->redirectToRoute('sudoku_homepage');
     }
}
