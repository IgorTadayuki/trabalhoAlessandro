<?php
/**
 * Created by PhpStorm.
 * User: Alessandro
 * Date: 24/08/2016
 * Time: 11:49
 */
declare (strict_types=1);
namespace game;




abstract class Game
{
    protected $score;
    protected $name;

    /**
     * game constructor, set the player's name.
     * @param string $name
     */
    public function __construct(string $name){
        $this->score=1000;
        $this->setName($name);
    }
    /**
     * Return the user score on this game.
     *
     * Simply return the score's value
     * to the caller
     *
     * @return int
     */
    public function getScore():int
    {
        return $this->score;
    }
    /**
     * Set the player's name in the $name member
     *
     * @param string $name Player's name
     */
    private function  setName(string $name){
        $this->name=$name;
    }
    /**
     * Return the player's name
     * @return string
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * Every child class must implement the play method.
     *
     */
    abstract function play();
}