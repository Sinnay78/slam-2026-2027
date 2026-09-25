<?php


$utilisateur = array( 
    "nom" => "Nora", 
    "actif" => true, 
    "role" => "gestionnaire" 
); 
 
$demandes = array( 
    array("id" => 101, "etat" => "nouvelle", "montant" => 250), 
    array("id" => 102, "etat" => "validee", "montant" => 900), 
    array("id" => 103, "etat" => "nouvelle", "montant" => 1400) 
); 

$compteur = 0; 
 
foreach ($demandes as $demande) { 
    if ( 
        
        $utilisateur["actif"] === true
        && $demande["etat"] === "nouvelle" 
        && $utilisateur === "gestionnaire" || "admin"
        && $demande["montant"] <= 1000 
    ) { 
        $compteur++; 
        echo "id" && "Validable";

    } else {
        echo "Non validable";
    }
} 
 
echo $compteur; 



// "===" c'est strictement egal a et avec le meme type
//actif ET nouvelle ET (admin OU (gestionnaire ET montant <= 1000)).
// || = "ou" en php

?>