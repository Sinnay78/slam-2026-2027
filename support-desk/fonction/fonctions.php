<?php
function connexion(): ?mysqli {
    $connexion = mysqli_connect("localhost", "root", "", "supportdesk");
    if (!$connexion) {
        return null;
    }
    return $connexion;
    
    if($connexion === false) {
        die("Erreur de connexion à la base de données : " . mysqli_connect_error());
    Return null;
};
mysqli_set_charset($connexion, "utf8mb4");
 
return $connexion;

};

function deconnexion(?mysqli $connexion): void
 
{
 
    // On ferme uniquement si une connexion existe réellement.
 
    if ($connexion !== null) {
        mysqli_close($connexion);
 
    }
 
};

function recupererUtilisateurs(mysqli $connexion): array
{
    $sql = "SELECT id, nom, email FROM utilisateur ORDER BY nom";
    $resultat = mysqli_query($connexion, $sql);
    if ($resultat === false) {
        return [];
    }
    return mysqli_fetch_all($resultat, MYSQLI_ASSOC);
}

function recupererCategories(mysqli $connexion): array
{
    $sql = "SELECT id, libelle FROM categorie ORDER BY libelle";
    $resultat = mysqli_query($connexion, $sql);
    if ($resultat === false) {
        return [];
    }
    return mysqli_fetch_all($resultat, MYSQLI_ASSOC);
}

// La requête SQL contient des ? à la place des valeurs.    ​

// Ces ? seront remplacés par les valeurs réelles dans l'étape BIND.​
function ajouterIncident(mysqli $con,string $titre,string $description,string $priorite,int $utilisateur_id,int $categorie_id)
{
    $sql = "INSERT INTO incident (titre, description, priorite, utilisateur_id, categorie_id)
 
        VALUES (?, ?, ?, ?, ?)";
 
 
// 1. PREPARE : préparer la structure de la commande SQL.
 
$stmt = mysqli_prepare($con, $sql);
 
 
// 2. BIND : associer chaque valeur à un ?.
 
// s = string ; i = integer
 
mysqli_stmt_bind_param(
 
    $stmt, "sssii",
 
    $titre, $description, $priorite, $utilisateurId, $categorieId
 
);
 
 
// 3. EXECUTE : exécuter la requête avec les valeurs liées.
 
return mysqli_stmt_execute($stmt);
}