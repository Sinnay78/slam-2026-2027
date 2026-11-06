<form class="formulaire formulaire-recherche"
      action="recherche.php"
      method="get">
    <div class="champ">
        <label for="mot">Mot-clé</label>
        <input type="search" id="mot" name="mot">
    </div>
    <button class="bouton" type="submit">
        Rechercher
    </button>
</form>

<?php

function rechercherIncidents(mysqli $con, string $mot): array
 
{
 
    $sql = "SELECT
 
                i.id, i.titre, i.description, i.priorite,
 
                i.bloquant, i.date_creation,
 
                u.nom AS utilisateur,
 
                c.libelle AS categorie
 
            FROM incident i
 
            INNER JOIN utilisateur u ON u.id = i.utilisateur_id
 
            INNER JOIN categorie c ON c.id = i.categorie_id
 
            WHERE i.titre LIKE ? OR i.description LIKE ?
 
            ORDER BY i.date_creation DESC, i.id DESC";
 
 
    $stmt = mysqli_prepare($con, $sql);
 
 
    if ($stmt === false) {
 
        return [];
 
    }
 
 
    $recherche = "%" . $mot . "%";
 
    mysqli_stmt_bind_param($stmt, "ss", $recherche, $recherche);
 
    mysqli_stmt_execute($stmt);
 
 
    $resultat = mysqli_stmt_get_result($stmt);
 
    return mysqli_fetch_all($resultat, MYSQLI_ASSOC);
 
}

?>