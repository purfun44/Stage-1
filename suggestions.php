<?php
include'changerFormatDate.php';
if(isset($_POST['nom_candidat'])&&$_POST['nom_candidat']!=""){
	list($nom,$prenom)=explode(" ",$_POST['nom_candidat']);}
$recherche_nom_candidat=array();
$recherche_prenom_candidat=array();
$recherche_type_diplome_demande=array();
$recherche_nom_diplome_demande=array();
$recherche_code_candidat=array();
if(isset($_POST['date_reunion_info'])&&$_POST['date_reunion_info']!=""&&isset($_POST['date_reunion_info2'])&&$_POST['date_reunion_info2']!=""){
	$intitule='date_reunion_info';
	$date1=formatBase($_POST['date_reunion_info']);
	$date2=formatBase($_POST['date_reunion_info2']);
	}
else if(isset($_POST['DateDemande_accompagnement'])&&$_POST['DateDemande_accompagnement']!=""&&isset($_POST['DateDemande_accompagnement2'])&&$_POST['DateDemande_accompagnement2']!=""){
	$intitule='DateDemande_accompagnement';
	$date1=formatBase($_POST['DateDemande_accompagnement']);
	$date2=formatBase($_POST['DateDemande_accompagnement2']);
	}
else if(isset($_POST['livret2_rendu_le'])&&$_POST['livret2_rendu_le']!=""&&isset($_POST['livret2_rendu_le2'])&&$_POST['livret2_rendu_le2']!=""){
	$intitule='livret2_rendu_le';
	$date1=formatBase($_POST['livret2_rendu_le']);
	$date2=formatBase($_POST['livret2_rendu_le2']);
	}
else if(isset($_POST['date_jury'])&&$_POST['date_jury']!=""&&isset($_POST['date_jury2'])&&$_POST['date_jury2']!=""){
	$intitule='date_jury';
	$date1=formatBase($_POST['date_jury']);
	$date2=formatBase($_POST['date_jury2']);
	}
//Affichage des suggestions en fonction des données récupérées
if(isset($date1)){//Si on a un intervalle de dates
	if(isset($idr)&&$idr!=-1&&$idr!=0){//Si on a un type de diplome:
		if(isset($_POST['nom_diplome_demande'])&&$_POST['nom_diplome_demande']!=-1&&$_POST['nom_diplome_demande']!=-2){//Si on a un nom de diplome:		
			if(isset($_POST['nom_candidat'])&&$_POST['nom_candidat']!=""){//Si on a un nom de candidat:
				if(isset($_POST['nom_JF'])&&$_POST['nom_JF']!=""){//Si on a un nom de jeune fille:
					$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE ".$intitule." BETWEEN '".$date1."' AND '".$date2."' AND type_diplome_demande LIKE '".$type_diplome_demande[$_POST['type_diplome_demande']]."' AND nom_diplome_demande LIKE '".$nom_diplome_demande[$_POST['nom_diplome_demande']]."' AND nom_candidat LIKE '".$nom."' AND prenom_candidat LIKE '".$prenom."%' AND nom_JF LIKE '".$_POST['nom_JF']."' ORDER BY nom_candidat";
					$resultat=mysql_query($sql4,$connexion);
					while($recherche=mysql_fetch_assoc($resultat)){
						array_push($recherche_nom_candidat,$recherche['nom_candidat']);
						array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
						array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
						array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
						array_push($recherche_code_candidat,$recherche['code_candidat']);
						}
					for($j=0;$j<count($recherche_nom_candidat);$j++){
						echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
						}
					}
				else{
					$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE ".$intitule." BETWEEN '".$date1."' AND '".$date2."' AND type_diplome_demande LIKE '".$type_diplome_demande[$_POST['type_diplome_demande']]."' AND nom_diplome_demande LIKE '".$nom_diplome_demande[$_POST['nom_diplome_demande']]."' AND nom_candidat LIKE '".$nom."' AND prenom_candidat LIKE '".$prenom."%' ORDER BY nom_candidat";
					$resultat=mysql_query($sql4,$connexion);
					while($recherche=mysql_fetch_assoc($resultat)){
						array_push($recherche_nom_candidat,$recherche['nom_candidat']);
						array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
						array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
						array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
						array_push($recherche_code_candidat,$recherche['code_candidat']);
						}
					for($j=0;$j<count($recherche_nom_candidat);$j++){
						echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
						}
					}
				}
			else if(isset($_POST['nom_JF'])&&$_POST['nom_JF']!=""){//Si on a un nom de jeune fille:
				$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE ".$intitule." BETWEEN '".$date1."' AND '".$date2."' AND type_diplome_demande LIKE '".$type_diplome_demande[$_POST['type_diplome_demande']]."' AND nom_diplome_demande LIKE '".$nom_diplome_demande[$_POST['nom_diplome_demande']]."' AND nom_JF LIKE '".$_POST['nom_JF']."' ORDER BY nom_candidat";
				$resultat=mysql_query($sql4,$connexion);
				while($recherche=mysql_fetch_assoc($resultat)){
					array_push($recherche_nom_candidat,$recherche['nom_candidat']);
					array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
					array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
					array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
					array_push($recherche_code_candidat,$recherche['code_candidat']);
					}
				for($j=0;$j<count($recherche_nom_candidat);$j++){
					echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
					}
				}
			else{
				$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE ".$intitule." BETWEEN '".$date1."' AND '".$date2."' AND type_diplome_demande LIKE '".$type_diplome_demande[$_POST['type_diplome_demande']]."' AND nom_diplome_demande LIKE '".$nom_diplome_demande[$_POST['nom_diplome_demande']]."' ORDER BY nom_candidat";
				$resultat=mysql_query($sql4,$connexion);
				while($recherche=mysql_fetch_assoc($resultat)){
					array_push($recherche_nom_candidat,$recherche['nom_candidat']);
					array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
					array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
					array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
					array_push($recherche_code_candidat,$recherche['code_candidat']);
					}
				for($j=0;$j<count($recherche_nom_candidat);$j++){
					echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
					}
				}
			}
		else if(isset($_POST['nom_candidat'])&&$_POST['nom_candidat']!=""){//Si on a un nom de candidat:
			if(isset($_POST['nom_JF'])&&$_POST['nom_JF']!=""){//Si on a un nom de jeune fille:
				$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE ".$intitule." BETWEEN '".$date1."' AND '".$date2."' AND type_diplome_demande LIKE '".$type_diplome_demande[$_POST['type_diplome_demande']]."' AND nom_candidat LIKE '".$nom."' AND prenom_candidat LIKE '".$prenom."%' AND nom_JF LIKE '".$_POST['nom_JF']."' ORDER BY nom_candidat";
				$resultat=mysql_query($sql4,$connexion);
				while($recherche=mysql_fetch_assoc($resultat)){
					array_push($recherche_nom_candidat,$recherche['nom_candidat']);
					array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
					array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
					array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
					array_push($recherche_code_candidat,$recherche['code_candidat']);
					}
				for($j=0;$j<count($recherche_nom_candidat);$j++){
					echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
					}
				}
			else{
				$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE ".$intitule." BETWEEN '".$date1."' AND '".$date2."' AND type_diplome_demande LIKE '".$type_diplome_demande[$_POST['type_diplome_demande']]."' AND nom_candidat LIKE '".$nom."' AND prenom_candidat LIKE '".$prenom."%' ORDER BY nom_candidat";
				$resultat=mysql_query($sql4,$connexion);
				while($recherche=mysql_fetch_assoc($resultat)){
					array_push($recherche_nom_candidat,$recherche['nom_candidat']);
					array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
					array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
					array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
					array_push($recherche_code_candidat,$recherche['code_candidat']);
					}
				for($j=0;$j<count($recherche_nom_candidat);$j++){
					echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
					}
				}
			}
		else if(isset($_POST['nom_JF'])&&$_POST['nom_JF']!=""){//Si on a un nom de jeune fille:
			$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE ".$intitule." BETWEEN '".$date1."' AND '".$date2."' AND type_diplome_demande LIKE '".$type_diplome_demande[$_POST['type_diplome_demande']]."' AND nom_JF LIKE '".$_POST['nom_JF']."' ORDER BY nom_candidat";
			$resultat=mysql_query($sql4,$connexion);
			while($recherche=mysql_fetch_assoc($resultat)){
				array_push($recherche_nom_candidat,$recherche['nom_candidat']);
				array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
				array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
				array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
				array_push($recherche_code_candidat,$recherche['code_candidat']);
				}
			for($j=0;$j<count($recherche_nom_candidat);$j++){
				echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
				}
			}
		else{
			$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE ".$intitule." BETWEEN '".$date1."' AND '".$date2."' AND type_diplome_demande LIKE '".$type_diplome_demande[$_POST['type_diplome_demande']]."' ORDER BY nom_candidat";
			$resultat=mysql_query($sql4,$connexion);
			while($recherche=mysql_fetch_assoc($resultat)){
				array_push($recherche_nom_candidat,$recherche['nom_candidat']);
				array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
				array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
				array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
				array_push($recherche_code_candidat,$recherche['code_candidat']);
				}
			for($j=0;$j<count($recherche_nom_candidat);$j++){
				echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
				}
			}
		}
	else if(isset($_POST['nom_diplome_demande'])&&$_POST['nom_diplome_demande']!=-1&&$_POST['nom_diplome_demande']!=0){//Si on a un nom de diplome:		
		if(isset($_POST['nom_candidat'])&&$_POST['nom_candidat']!=""){//Si on a un nom de candidat:
			if(isset($_POST['nom_JF'])&&$_POST['nom_JF']!=""){//Si on a un nom de jeune fille:
				$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE ".$intitule." BETWEEN '".$date1."' AND '".$date2."' AND nom_diplome_demande LIKE '".$nom_diplome_demande[$_POST['nom_diplome_demande']]."' AND nom_candidat LIKE '".$nom."' AND prenom_candidat LIKE '".$prenom."%' AND nom_JF LIKE '".$_POST['nom_JF']."' ORDER BY nom_candidat";
				$resultat=mysql_query($sql4,$connexion);
				while($recherche=mysql_fetch_assoc($resultat)){
					array_push($recherche_nom_candidat,$recherche['nom_candidat']);
					array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
					array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
					array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
					array_push($recherche_code_candidat,$recherche['code_candidat']);
					}
				for($j=0;$j<count($recherche_nom_candidat);$j++){
					echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
					}
				}
			else{
				$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE ".$intitule." BETWEEN '".$date1."' AND '".$date2."' AND nom_diplome_demande LIKE '".$nom_diplome_demande[$_POST['nom_diplome_demande']]."' AND nom_candidat LIKE '".$nom."' AND prenom_candidat LIKE '".$prenom."%' ORDER BY nom_candidat";
				$resultat=mysql_query($sql4,$connexion);
				while($recherche=mysql_fetch_assoc($resultat)){
					array_push($recherche_nom_candidat,$recherche['nom_candidat']);
					array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
					array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
					array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
					array_push($recherche_code_candidat,$recherche['code_candidat']);
					}
				for($j=0;$j<count($recherche_nom_candidat);$j++){
					echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
					}
				}
			}
		else if(isset($_POST['nom_JF'])&&$_POST['nom_JF']!=""){//Si on a un nom de jeune fille:
			$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE ".$intitule." BETWEEN '".$date1."' AND '".$date2."' AND nom_diplome_demande LIKE '".$nom_diplome_demande[$_POST['nom_diplome_demande']]."' AND nom_JF LIKE '".$_POST['nom_JF']."' ORDER BY nom_candidat";
			$resultat=mysql_query($sql4,$connexion);
			while($recherche=mysql_fetch_assoc($resultat)){
				array_push($recherche_nom_candidat,$recherche['nom_candidat']);
				array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
				array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
				array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
				array_push($recherche_code_candidat,$recherche['code_candidat']);
				}
			for($j=0;$j<count($recherche_nom_candidat);$j++){
				echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
				}
			}
		else{
			$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE ".$intitule." BETWEEN '".$date1."' AND '".$date2."' AND nom_diplome_demande LIKE '".$nom_diplome_demande[$_POST['nom_diplome_demande']]."' ORDER BY nom_candidat";
			$resultat=mysql_query($sql4,$connexion);
			while($recherche=mysql_fetch_assoc($resultat)){
				array_push($recherche_nom_candidat,$recherche['nom_candidat']);
				array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
				array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
				array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
				array_push($recherche_code_candidat,$recherche['code_candidat']);
				}
			for($j=0;$j<count($recherche_nom_candidat);$j++){
				echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
				}
			}
		}
	else if(isset($_POST['nom_candidat'])&&$_POST['nom_candidat']!=""){//Si on a un nom de candidat:
			if(isset($_POST['nom_JF'])&&$_POST['nom_JF']!=""){//Si on a un nom de jeune fille:
				$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE ".$intitule." BETWEEN '".$date1."' AND '".$date2."' AND nom_candidat LIKE '".$nom."' AND prenom_candidat LIKE '".$prenom."%' AND nom_JF LIKE '".$_POST['nom_JF']."' ORDER BY nom_candidat";
				$resultat=mysql_query($sql4,$connexion);
				while($recherche=mysql_fetch_assoc($resultat)){
					array_push($recherche_nom_candidat,$recherche['nom_candidat']);
					array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
					array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
					array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
					array_push($recherche_code_candidat,$recherche['code_candidat']);
					}
				for($j=0;$j<count($recherche_nom_candidat);$j++){
					echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
					}
				}
			else{
				$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE ".$intitule." BETWEEN '".$date1."' AND '".$date2."' AND nom_candidat LIKE '".$nom."' AND prenom_candidat LIKE '".$prenom."%' ORDER BY nom_candidat";
				$resultat=mysql_query($sql4,$connexion);
				while($recherche=mysql_fetch_assoc($resultat)){
					array_push($recherche_nom_candidat,$recherche['nom_candidat']);
					array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
					array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
					array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
					array_push($recherche_code_candidat,$recherche['code_candidat']);
					}
				for($j=0;$j<count($recherche_nom_candidat);$j++){
					echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
					}
				}
			}	
	else if(isset($_POST['nom_JF'])&&$_POST['nom_JF']!=""){//Si on a un nom de jeune fille:
		$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE ".$intitule." BETWEEN '".$date1."' AND '".$date2."' AND nom_JF LIKE '".$_POST['nom_JF']."' ORDER BY nom_candidat";
		$resultat=mysql_query($sql4,$connexion);
		while($recherche=mysql_fetch_assoc($resultat)){
			array_push($recherche_nom_candidat,$recherche['nom_candidat']);
			array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
			array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
			array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
			array_push($recherche_code_candidat,$recherche['code_candidat']);
			}
		for($j=0;$j<count($recherche_nom_candidat);$j++){
			echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
			}
		}
	else{
		$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE ".$intitule." BETWEEN '".$date1."' AND '".$date2."' ORDER BY nom_candidat";
		$resultat=mysql_query($sql4,$connexion);
		while($recherche=mysql_fetch_assoc($resultat)){
			array_push($recherche_nom_candidat,$recherche['nom_candidat']);
			array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
			array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
			array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
			array_push($recherche_code_candidat,$recherche['code_candidat']);
			}
		for($j=0;$j<count($recherche_nom_candidat);$j++){
			echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
			}
		}
	}
else if(isset($idr)&&$idr!=-1&&$idr!=0){//Si on a un type de diplome:
	if(isset($_POST['nom_diplome_demande'])&&$_POST['nom_diplome_demande']!=-1&&$_POST['nom_diplome_demande']!=-2){//Si on a un nom de diplome:		
		if(isset($_POST['nom_candidat'])&&$_POST['nom_candidat']!=""){//Si on a un nom de candidat:
			if(isset($_POST['nom_JF'])&&$_POST['nom_JF']!=""){//Si on a un nom de jeune fille:
				$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE type_diplome_demande LIKE '".$type_diplome_demande[$_POST['type_diplome_demande']]."' AND nom_diplome_demande LIKE '".$nom_diplome_demande[$_POST['nom_diplome_demande']]."' AND nom_candidat LIKE '".$nom."' AND prenom_candidat LIKE '".$prenom."%' AND nom_JF LIKE '".$_POST['nom_JF']."' ORDER BY nom_candidat";
				$resultat=mysql_query($sql4,$connexion);
				while($recherche=mysql_fetch_assoc($resultat)){
					array_push($recherche_nom_candidat,$recherche['nom_candidat']);
					array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
					array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
					array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
					array_push($recherche_code_candidat,$recherche['code_candidat']);
					}
				for($j=0;$j<count($recherche_nom_candidat);$j++){
					echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
					}
				}
			else{
				$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE type_diplome_demande LIKE '".$type_diplome_demande[$_POST['type_diplome_demande']]."' AND nom_diplome_demande LIKE '".$nom_diplome_demande[$_POST['nom_diplome_demande']]."' AND nom_candidat LIKE '".$nom."' AND prenom_candidat LIKE '".$prenom."%' ORDER BY nom_candidat";
				$resultat=mysql_query($sql4,$connexion);
				while($recherche=mysql_fetch_assoc($resultat)){
					array_push($recherche_nom_candidat,$recherche['nom_candidat']);
					array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
					array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
					array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
					array_push($recherche_code_candidat,$recherche['code_candidat']);
					}
				for($j=0;$j<count($recherche_nom_candidat);$j++){
					echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
					}
				}
			}
		else if(isset($_POST['nom_JF'])&&$_POST['nom_JF']!=""){//Si on a un nom de jeune fille:
			$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE type_diplome_demande LIKE '".$type_diplome_demande[$_POST['type_diplome_demande']]."' AND nom_diplome_demande LIKE '".$nom_diplome_demande[$_POST['nom_diplome_demande']]."' AND nom_JF LIKE '".$_POST['nom_JF']."' ORDER BY nom_candidat";
			$resultat=mysql_query($sql4,$connexion);
			while($recherche=mysql_fetch_assoc($resultat)){
				array_push($recherche_nom_candidat,$recherche['nom_candidat']);
				array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
				array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
				array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
				array_push($recherche_code_candidat,$recherche['code_candidat']);
				}
			for($j=0;$j<count($recherche_nom_candidat);$j++){
				echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
				}
			}
		else{
			$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE type_diplome_demande LIKE '".$type_diplome_demande[$_POST['type_diplome_demande']]."' AND nom_diplome_demande LIKE '".$nom_diplome_demande[$_POST['nom_diplome_demande']]."' ORDER BY nom_candidat";
			$resultat=mysql_query($sql4,$connexion);
			while($recherche=mysql_fetch_assoc($resultat)){
				array_push($recherche_nom_candidat,$recherche['nom_candidat']);
				array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
				array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
				array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
				array_push($recherche_code_candidat,$recherche['code_candidat']);
				}
			for($j=0;$j<count($recherche_nom_candidat);$j++){
				echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
				}
			}
		}
	else if(isset($_POST['nom_candidat'])&&$_POST['nom_candidat']!=""){//Si on a un nom de candidat:
		if(isset($_POST['nom_JF'])&&$_POST['nom_JF']!=""){//Si on a un nom de jeune fille:
			$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE type_diplome_demande LIKE '".$type_diplome_demande[$_POST['type_diplome_demande']]."' AND nom_candidat LIKE '".$nom."' AND prenom_candidat LIKE '".$prenom."%' AND nom_JF LIKE '".$_POST['nom_JF']."' ORDER BY nom_candidat";
			$resultat=mysql_query($sql4,$connexion);
			while($recherche=mysql_fetch_assoc($resultat)){
				array_push($recherche_nom_candidat,$recherche['nom_candidat']);
				array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
				array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
				array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
				array_push($recherche_code_candidat,$recherche['code_candidat']);
				}
			for($j=0;$j<count($recherche_nom_candidat);$j++){
				echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
				}
			}
		else{
			$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE type_diplome_demande LIKE '".$type_diplome_demande[$_POST['type_diplome_demande']]."' AND nom_candidat LIKE '".$nom."' AND prenom_candidat LIKE '".$prenom."%' ORDER BY nom_candidat";
			$resultat=mysql_query($sql4,$connexion);
			while($recherche=mysql_fetch_assoc($resultat)){
				array_push($recherche_nom_candidat,$recherche['nom_candidat']);
				array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
				array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
				array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
				array_push($recherche_code_candidat,$recherche['code_candidat']);
				}
			for($j=0;$j<count($recherche_nom_candidat);$j++){
				echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
				}
			}
		}
	else if(isset($_POST['nom_JF'])&&$_POST['nom_JF']!=""){//Si on a un nom de jeune fille:
		$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE type_diplome_demande LIKE '".$type_diplome_demande[$_POST['type_diplome_demande']]."' AND nom_JF LIKE '".$_POST['nom_JF']."' ORDER BY nom_candidat";
		$resultat=mysql_query($sql4,$connexion);
		while($recherche=mysql_fetch_assoc($resultat)){
			array_push($recherche_nom_candidat,$recherche['nom_candidat']);
			array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
			array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
			array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
			array_push($recherche_code_candidat,$recherche['code_candidat']);
			}
		for($j=0;$j<count($recherche_nom_candidat);$j++){
			echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
			}
		}
	else{
		$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE type_diplome_demande LIKE '".$type_diplome_demande[$_POST['type_diplome_demande']]."' ORDER BY nom_candidat";
		$resultat=mysql_query($sql4,$connexion);
		while($recherche=mysql_fetch_assoc($resultat)){
			array_push($recherche_nom_candidat,$recherche['nom_candidat']);
			array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
			array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
			array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
			array_push($recherche_code_candidat,$recherche['code_candidat']);
			}
		for($j=0;$j<count($recherche_nom_candidat);$j++){
			echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
			}
		}
	}
else if(isset($_POST['nom_diplome_demande'])&&$_POST['nom_diplome_demande']!=-1&&$_POST['nom_diplome_demande']!=0){//Si on a un nom de diplome:		
	if(isset($_POST['nom_candidat'])&&$_POST['nom_candidat']!=""){//Si on a un nom de candidat:
		if(isset($_POST['nom_JF'])&&$_POST['nom_JF']!=""){//Si on a un nom de jeune fille:
			$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE nom_diplome_demande LIKE '".$nom_diplome_demande[$_POST['nom_diplome_demande']]."' AND nom_candidat LIKE '".$nom."' AND prenom_candidat LIKE '".$prenom."%' AND nom_JF LIKE '".$_POST['nom_JF']."' ORDER BY nom_candidat";
			$resultat=mysql_query($sql4,$connexion);
			while($recherche=mysql_fetch_assoc($resultat)){
				array_push($recherche_nom_candidat,$recherche['nom_candidat']);
				array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
				array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
				array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
				array_push($recherche_code_candidat,$recherche['code_candidat']);
				}
			for($j=0;$j<count($recherche_nom_candidat);$j++){
				echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
				}
			}
		else{
			$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE nom_diplome_demande LIKE '".$nom_diplome_demande[$_POST['nom_diplome_demande']]."' AND nom_candidat LIKE '".$nom."' AND prenom_candidat LIKE '".$prenom."%' ORDER BY nom_candidat";
			$resultat=mysql_query($sql4,$connexion);
			while($recherche=mysql_fetch_assoc($resultat)){
				array_push($recherche_nom_candidat,$recherche['nom_candidat']);
				array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
				array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
				array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
				array_push($recherche_code_candidat,$recherche['code_candidat']);
				}
			for($j=0;$j<count($recherche_nom_candidat);$j++){
				echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
				}
			}
		}
	else if(isset($_POST['nom_JF'])&&$_POST['nom_JF']!=""){//Si on a un nom de jeune fille:
		$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE nom_diplome_demande LIKE '".$nom_diplome_demande[$_POST['nom_diplome_demande']]."' AND nom_JF LIKE '".$_POST['nom_JF']."' ORDER BY nom_candidat";
		$resultat=mysql_query($sql4,$connexion);
		while($recherche=mysql_fetch_assoc($resultat)){
			array_push($recherche_nom_candidat,$recherche['nom_candidat']);
			array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
			array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
			array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
			array_push($recherche_code_candidat,$recherche['code_candidat']);
			}
		for($j=0;$j<count($recherche_nom_candidat);$j++){
			echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
			}
		}
	else{
		$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE nom_diplome_demande LIKE '".$nom_diplome_demande[$_POST['nom_diplome_demande']]."' ORDER BY nom_candidat";
		$resultat=mysql_query($sql4,$connexion);
		while($recherche=mysql_fetch_assoc($resultat)){
			array_push($recherche_nom_candidat,$recherche['nom_candidat']);
			array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
			array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
			array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
			array_push($recherche_code_candidat,$recherche['code_candidat']);
			}
		for($j=0;$j<count($recherche_nom_candidat);$j++){
			echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
			}
		}
	}
else if(isset($_POST['nom_candidat'])&&$_POST['nom_candidat']!=""){//Si on a un nom de candidat:
		if(isset($_POST['nom_JF'])&&$_POST['nom_JF']!=""){//Si on a un nom de jeune fille:
			$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE nom_candidat LIKE '".$nom."' AND prenom_candidat LIKE '".$prenom."%' AND nom_JF LIKE '".$_POST['nom_JF']."' ORDER BY nom_candidat";
			$resultat=mysql_query($sql4,$connexion);
			while($recherche=mysql_fetch_assoc($resultat)){
				array_push($recherche_nom_candidat,$recherche['nom_candidat']);
				array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
				array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
				array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
				array_push($recherche_code_candidat,$recherche['code_candidat']);
				}
			for($j=0;$j<count($recherche_nom_candidat);$j++){
				echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
				}
			}
		else{
			$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE nom_candidat LIKE '".$nom."' AND prenom_candidat LIKE '".$prenom."%' ORDER BY nom_candidat";
			$resultat=mysql_query($sql4,$connexion);
			while($recherche=mysql_fetch_assoc($resultat)){
				array_push($recherche_nom_candidat,$recherche['nom_candidat']);
				array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
				array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
				array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
				array_push($recherche_code_candidat,$recherche['code_candidat']);
				}
			for($j=0;$j<count($recherche_nom_candidat);$j++){
				echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
				}
			}
		}	
else if(isset($_POST['nom_JF'])&&$_POST['nom_JF']!=""){//Si on a un nom de jeune fille:
	$sql4="SELECT nom_candidat,prenom_candidat,type_diplome_demande,nom_diplome_demande,code_candidat FROM vaecandidat WHERE nom_JF LIKE '".$_POST['nom_JF']."' ORDER BY nom_candidat";
	$resultat=mysql_query($sql4,$connexion);
	while($recherche=mysql_fetch_assoc($resultat)){
		array_push($recherche_nom_candidat,$recherche['nom_candidat']);
		array_push($recherche_prenom_candidat,$recherche['prenom_candidat']);
		array_push($recherche_type_diplome_demande,$recherche['type_diplome_demande']);
		array_push($recherche_nom_diplome_demande,$recherche['nom_diplome_demande']);
		array_push($recherche_code_candidat,$recherche['code_candidat']);
		}
	for($j=0;$j<count($recherche_nom_candidat);$j++){
		echo '<a href="./fiche_candidat.php?code='.$recherche_code_candidat[$j].'">'.utf8_encode($recherche_nom_candidat[$j].'&nbsp&nbsp'.$recherche_prenom_candidat[$j].'&nbsp&nbsp'.$recherche_type_diplome_demande[$j].'&nbsp&nbsp'.$recherche_nom_diplome_demande[$j].'&nbsp&nbsp'."Code : ".$recherche_code_candidat[$j].'<BR>')."</a>";
		}
	}
?>
