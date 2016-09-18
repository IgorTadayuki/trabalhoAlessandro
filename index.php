<?php
/**
 * Created by PhpStorm.
 * User: Alessandro
 * Date: 18/08/2016
 * Time: 08:17
 */
declare (strict_types=1);
use game\hangman\Hangman;


/*echo "Type your name:";
$strName = fread(STDIN, 80);
echo "Let's play hangman $strName".PHP_EOL; */
$hang = new Hangman('Alessandro',6);

$hang->play('a');
echo $hang->getScore();
$hang->play('c');
echo $hang->getScore();


function  __autoload($class){
    $class= str_replace('\\','/',$class).'.php';
    require_once($class);
}

