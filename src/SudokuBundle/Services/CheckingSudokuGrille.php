<?php
/**
 * Created by PhpStorm.
 * User: wingel
 * Date: 06/06/17
 * Time: 15:55
 */

namespace SudokuBundle\Services;


class CheckingSudokuGrille
{
    public function falseSquare($sudoku)
    {
        //SQUARE
        // $i pour le while square
        $i = 0;
        //compteur de ligne sudoku pour le square
        $lss = 0;
        //compteur pour array_slice pour le square
        $sl = 0;
        //Si falsesquare a un numéro double donc il est faux
        $falseSquare = false;
        //Si le carrée est unique
        $uniqueSquare = false;


        //VERTICAL
        //$o pour le while vertical
        $o = 0;
        //Si falseVertical a un numéro double il est faux
        $falseVertical = false;
        //Si la ligne vertical est unique (aucun chiffre en double)
        $uniqueVertical = false;


        while ($i <= 8 && $falseSquare == false) {
            $arraySquare = array_merge(array_slice($sudoku[1 + $lss], 0 + $sl, 3), array_slice($sudoku[2 + $lss], 0 + $sl, 3), array_slice($sudoku[3 + $lss], 0 + $sl, 3));

            $sl += 3;
            $i++;

            if (count($arraySquare) !== count(array_unique($arraySquare))) {
                $falseSquare = true;
            } else {


                if ($sl == 9) {
                    $sl = 0;
                    $lss += 3;
                }
                if ($lss == 9) {
                    $uniqueSquare = true;

                }
            }

        }
        while ($o <= 8 && $uniqueSquare == true && $falseVertical == false) {
            $horizontal = array_merge(array_slice($sudoku[1], $o, 1), array_slice($sudoku[2], $o, 1), array_slice($sudoku[3], $o, 1), array_slice($sudoku[4], $o, 1), array_slice($sudoku[5], $o, 1), array_slice($sudoku[6], $o, 1), array_slice($sudoku[7], $o, 1), array_slice($sudoku[8], $o, 1), array_slice($sudoku[9], $o, 1));

            $o++;

            if (count($horizontal) !== count(array_unique($horizontal))) {
                $falseVertical = true;
            } else {
                if ($o == 8) {
                    $uniqueVertical = true;
                }
            }
        }
        if ($uniqueVertical == true && $uniqueSquare == true) {
            return true;
        }
    }
}