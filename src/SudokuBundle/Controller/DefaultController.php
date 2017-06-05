<?php

namespace SudokuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SudokuBundle:Default:index.html.twig');
    }
}
