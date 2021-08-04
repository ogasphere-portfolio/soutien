<?php


$maVariable = "tagada";

// avant d'éxecuter PHP lit la ligne de droite à gauche
echo $maVariable;
//  PHP voit une variable il la remplace par sa valeur
// ==> echo "tagada";

$objet = new MonObjet();
$objet->name = "JB";
echo $objet->name;
// ==> echo "JB"

// je fait exprès que la valeur soit la même que le nom de la propriété
$variableCoincidence = "name";

echo $objet->$variableCoincidence;
// 1. ==> echo $objet->name
// 2. ==> echo "JB"



class MonObjet {
    public $name;
}