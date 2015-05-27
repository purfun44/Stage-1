<?php
//Fonction permettant de mettre la date au format français
function changeDateFR($dateFr){
	$date=$dateFr{8}.$dateFr{9}."-".$dateFr{5}.$dateFr{6}."-".$dateFr{0}.$dateFr{1}.$dateFr{2}.$dateFr{3};
	return $date;
	}
//Fonction permettant de mettre la date au format de la base de données
function formatBase($dateFr){
	$date=$dateFr{6}.$dateFr{7}.$dateFr{8}.$dateFr{9}."-".$dateFr{3}.$dateFr{4}."-".$dateFr{0}.$dateFr{1};
	return $date;
	}
?>
