<?php
include'connexion.php';
if(isset($_GET['q'])){
    $q=htmlentities($_GET['q']);
    $requete="SELECT nom_candidat,prenom_candidat FROM vaecandidat WHERE nom_candidat LIKE '%".$q."%' ORDER BY nom_candidat";
	$resultat=mysql_query($requete);
    while($donnees=mysql_fetch_assoc($resultat)){
        echo utf8_encode($donnees['nom_candidat'].' '.$donnees['prenom_candidat']."\n");
		}
	}
?>
