<?php
include'connexion.php';
if(isset($_GET['q'])){
    $q=htmlentities($_GET['q']);
    $requete="SELECT nom_JF FROM vaecandidat WHERE nom_JF LIKE '%".$q."%' ORDER BY nom_JF";
	$resultat=mysql_query($requete);
    while($donnees=mysql_fetch_assoc($resultat)){
        echo utf8_encode($donnees['nom_JF']."\n");
		}
	}
?>
