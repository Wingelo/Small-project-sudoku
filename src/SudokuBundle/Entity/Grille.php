<?php

namespace SudokuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Grille
 *
 * @ORM\Table(name="grille")
 * @ORM\Entity(repositoryClass="SudokuBundle\Repository\GrilleRepository")
 */
class Grille
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="User", type="string", length=255, nullable=true)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="Line1", type="string", length=25,  nullable=true)
     */
    private $line1;

    /**
     * @var string
     *
     * @ORM\Column(name="Line2", type="string", length=25, nullable=true)
     */
    private $line2;

    /**
     * @var string
     *
     * @ORM\Column(name="Line3", type="string", length=25,  nullable=true)
     */
    private $line3;

    /**
     * @var string
     *
     * @ORM\Column(name="Line4", type="string", length=25,  nullable=true)
     */
    private $line4;

    /**
     * @var string
     *
     * @ORM\Column(name="Line5", type="string", length=255,  nullable=true)
     */
    private $line5;

    /**
     * @var string
     *
     * @ORM\Column(name="Line6", type="string", length=25,  nullable=true)
     */
    private $line6;

    /**
     * @var string
     *
     * @ORM\Column(name="Line7", type="string", length=25,  nullable=true)
     */
    private $line7;

    /**
     * @var string
     *
     * @ORM\Column(name="Line8", type="string", length=25,  nullable=true)
     */
    private $line8;

    /**
     * @var string
     *
     * @ORM\Column(name="Line9", type="string", length=25, nullable=true)
     */
    private $line9;

    /**
     * @var string
     *
     * @ORM\Column(name="Resolved", type="string", length=25, nullable=true)
     */
    private $resolved;

    /**
     * @var string
     *
     * @ORM\Column(name="Resolved2", type="string", length=25, nullable=true)
     */
    private $resolved2;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param string $user
     *
     * @return Grille
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set line1
     *
     * @param string $line1
     *
     * @return Grille
     */
    public function setLine1($line1)
    {
        $this->line1 = $line1;

        return $this;
    }

    /**
     * Get line1
     *
     * @return string
     */
    public function getLine1()
    {
        return $this->line1;
    }

    /**
     * Set line2
     *
     * @param string $line2
     *
     * @return Grille
     */
    public function setLine2($line2)
    {
        $this->line2 = $line2;

        return $this;
    }

    /**
     * Get line2
     *
     * @return string
     */
    public function getLine2()
    {
        return $this->line2;
    }

    /**
     * Set line3
     *
     * @param string $line3
     *
     * @return Grille
     */
    public function setLine3($line3)
    {
        $this->line3 = $line3;

        return $this;
    }

    /**
     * Get line3
     *
     * @return string
     */
    public function getLine3()
    {
        return $this->line3;
    }

    /**
     * Set line4
     *
     * @param string $line4
     *
     * @return Grille
     */
    public function setLine4($line4)
    {
        $this->line4 = $line4;

        return $this;
    }

    /**
     * Get line4
     *
     * @return string
     */
    public function getLine4()
    {
        return $this->line4;
    }

    /**
     * Set line5
     *
     * @param string $line5
     *
     * @return Grille
     */
    public function setLine5($line5)
    {
        $this->line5 = $line5;

        return $this;
    }

    /**
     * Get line5
     *
     * @return string
     */
    public function getLine5()
    {
        return $this->line5;
    }

    /**
     * Set line6
     *
     * @param string $line6
     *
     * @return Grille
     */
    public function setLine6($line6)
    {
        $this->line6 = $line6;

        return $this;
    }

    /**
     * Get line6
     *
     * @return string
     */
    public function getLine6()
    {
        return $this->line6;
    }

    /**
     * Set line7
     *
     * @param string $line7
     *
     * @return Grille
     */
    public function setLine7($line7)
    {
        $this->line7 = $line7;

        return $this;
    }

    /**
     * Get line7
     *
     * @return string
     */
    public function getLine7()
    {
        return $this->line7;
    }

    /**
     * Set line8
     *
     * @param string $line8
     *
     * @return Grille
     */
    public function setLine8($line8)
    {
        $this->line8 = $line8;

        return $this;
    }

    /**
     * Get line8
     *
     * @return string
     */
    public function getLine8()
    {
        return $this->line8;
    }

    /**
     * Set line9
     *
     * @param string $line9
     *
     * @return Grille
     */
    public function setLine9($line9)
    {
        $this->line9 = $line9;

        return $this;
    }

    /**
     * Get line9
     *
     * @return string
     */
    public function getLine9()
    {
        return $this->line9;
    }

    /**
     * Set resolved
     *
     * @param string $resolved
     *
     * @return Grille
     */
    public function setResolved($resolved)
    {
        $this->resolved = $resolved;

        return $this;
    }

    /**
     * Get resolved
     *
     * @return string
     */
    public function getResolved()
    {
        return $this->resolved;
    }

    /**
     * Set resolved2
     *
     * @param string $resolved2
     *
     * @return Grille
     */
    public function setResolved2($resolved2)
    {
        $this->resolved2 = $resolved2;

        return $this;
    }

    /**
     * Get resolved2
     *
     * @return string
     */
    public function getResolved2()
    {
        return $this->resolved2;
    }
}
