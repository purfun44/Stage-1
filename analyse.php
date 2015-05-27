<?php
include'connexion.php';
include'changerFormatDate.php';
?>
<HTML>
	<HEAD>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link type="text/css" rel="stylesheet" href="./css/style.css"/>
		<TITLE>Analyse de l'expérience</TITLE>
	</HEAD>
	<BODY>
		<TABLE>
			<TR>
				<TD>
					<?php
					date_default_timezone_set('UTC');
					$requete="SELECT DateDemande_accompagnement,conseiller_civilite,conseiller_nom,conseiller_prenom,accompagnateur_civilite,accompagnateur_nom,accompagnateur_prenom FROM vaecandidat WHERE code_candidat='".$_GET['code']."'";
					$res=mysql_query($requete,$connexion);
					while($row=mysql_fetch_assoc($res)){
						echo "Date d'analyse de l'expérience : ".changeDateFR($row['DateDemande_accompagnement']);
						$dateA=explode("-",$row['DateDemande_accompagnement']);
						$da=$dateA[0].$dateA[1].$dateA[2];
						if($da<date("Ymd")){
							echo "<BR>L'analyse de l'expérience s'est déroulée :<BR>Pour le DAVA avec : ".$row['conseiller_civilite']." ".$row['conseiller_nom']." ".$row['conseiller_prenom'];}
						else{
							echo "<BR>L'analyse de l'expérience aura lieu :<BR>Pour le DAVA avec : ".$row['conseiller_civilite']." ".$row['conseiller_nom']." ".$row['conseiller_prenom'];}
						if($row['accompagnateur_civilite']=="Monsieur"){
							echo "<BR>Et pour l'enseignant avec : ".$row['accompagnateur_civilite']." ".$row['accompagnateur_nom']." ".$row['accompagnateur_prenom'];}
						else if($row['accompagnateur_civilite']=="Madame"){
							echo "<BR>Et pour l'enseignante avec : ".$row['accompagnateur_civilite']." ".$row['accompagnateur_nom']." ".$row['accompagnateur_prenom'];}
						}
					?>
				</TD>
			</TR>
		</TABLE>
		<BR><BR><INPUT type="button" name="retour" value="Retour" onclick="history.go(-1)">
		<BR><INPUT type="button" name="accueil" value="Accueil" onclick="document.location.replace('index.php')">
	</BODY>
</HTML>
