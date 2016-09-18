<?php
/**
 * Created by PhpStorm.
 * User: Alessandro
 * Date: 24/08/2016
 * Time: 11:51
 */
declare (strict_types=1);
namespace game\hangman;

use game\Game;

/**
 * Class hangman
 */
class Hangman extends Game {
    protected $misses;
    protected $usedLetters;
    protected $secretWord;
    protected $currentWord;
    protected $existsFlag;
    protected $state;

    public function   __construct(string $name,int $misses)
    {
        if ($misses > 25 || $misses < 1){
            throw new \Exception("$name, o limite de tentativas deve ser inferior a 26 e não pode ser negativo");
        }
        $this->misses=$misses;
        $this->usedLetters=array();
        $allWords= ['paralelepipedo','lixo','supermercado','pesca'];
        $this->secretWord=$allWords[rand(0,count($allWords)-1)];
        $this->currentWord= $this->secretWord;
        foreach ($this->currentWord  as &$char ){
            $char='-';
        }
        parent::__construct($name);
    }

    private function gameState (){
        if ($this->score < 0.03 ){
            return -2;
        }
        if ($this->existsFlag ==0 && $this->misses == 0 ){
            return -2;
        }
        if ($this->existsFlag ==0 && $this->misses > 0 ){
            return -1;
        }
        if ($this->secretWord==$this->currentWord){
            return 2;
        }
        return 1;
    }
    
    /**
     *
     * @param string $letter
     * @return int 0=if already guessed , 1=if  letter exists,  2=gameWon,-1= if letter doesn't exists , -2=GameOver; 
     */
    public function play(string $letter=""):int
    {
        $this->state=$this->gameState();
        if ($this->state == -2 || $this->state == 2){
            return $this->state;
        }
        $this->existsFlag=0;
        $letter=strtolower($letter);
        if (in_array($letter,$this->usedLetters)){
            return 0;
        }
        array_push($this->usedLetters,$letter);
        $splitword = str_split($this->secretWord);
        foreach ($splitword as $key=>$char){
            if ( $char ==$letter){
                $this->currentWord[$key]=$letter;
                $this->existsFlag++;
            }
        }
        $this->state=$this->gameState();
        if ($this->state = -1 ) {
            $this->score = $this->score - (1000/$this->misses);
        }
        return $this->state;
        
    }

    public function getState()
    {
        return $this->state;
    }
    
    public function getCurrentWord()
    {
        return $this->currentWord;
    }
}