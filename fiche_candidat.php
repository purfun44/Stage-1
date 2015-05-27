<?php
include'connexion.php';
include'changerFormatDate.php';
$requete="SELECT DateDemande_accompagnement,date_remise_livret1,Date_jury,livret2_rendu_le,date_reunion_info,date_recevabilite,date_non_recevabilite,date_recevabilite_cd FROM vaecandidat WHERE code_candidat='".$_GET['code']."'";
$res=mysql_query($requete,$connexion);
while($row=mysql_fetch_assoc($res)){
	$demandeAcc=$row['DateDemande_accompagnement'];
	$livret1=$row['date_remise_livret1'];
	$dateNonRecevabilite=$row['date_non_recevabilite'];
	$dateRecevabiliteCD=$row['date_recevabilite_cd'];
	$dateRecevabilite=$row['date_recevabilite'];
	$dateInfo=$row['date_reunion_info'];
	$livret2=$row['livret2_rendu_le'];
	$jury=$row['Date_jury'];
	}
if($dateNonRecevabilite{5}!=0||$dateNonRecevabilite{6}!=0){
	$bilan=1;}
else if(($dateRecevabiliteCD{5}==0&&$dateRecevabiliteCD{6}==0)&&($dateRecevabilite{5}==0&&$dateRecevabilite{6}==0)){
	$bilan=2;}
else if($dateInfo{5}==0&&$dateInfo{6}==0){
	$bilan=3;}
else if($livret2{5}==0&&$livret2{6}==0){
	$bilan=4;}
?>
<HTML>
	<HEAD>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link type="text/css" rel="stylesheet" href="./css/style.css"/>
		<TITLE>Candidat</TITLE>
	</HEAD>
	<BODY>
		<TABLE class="general">
			<CAPTION>Renseignements généraux</CAPTION>
			<TR>
				<TD class="case">
					<?php
					$requete="SELECT civilite,nom_candidat,prenom_candidat,nom_JF FROM vaecandidat WHERE code_candidat='".$_GET['code']."'";
					$res=mysql_query($requete,$connexion);
					while($row=mysql_fetch_assoc($res)){
						echo $row['civilite']." ".$row['nom_candidat']." ".$row['prenom_candidat'];
						if($row['nom_JF']!=""){
							echo "<BR>Nom JF : ".$row['nom_JF'];}
						}
					?>
				</TD>
				<TD class="case">
					<?php
					$requete="SELECT adresse,cp,localite FROM vaecandidat WHERE code_candidat='".$_GET['code']."'";
					$res=mysql_query($requete,$connexion);
					while($row=mysql_fetch_assoc($res)){
						if($row['adresse']!=""&&$row['adresse']!=" "){
							echo $row['adresse'];}
						else{
							echo "Adresse non renseignée";}
						if($row['cp']!=0){
							echo "<BR>".$row['cp'];}
						else{
							echo "<BR>CP non renseigné ";}
						if($row['localite']!=""){
							echo " ".$row['localite'];}
						else{
							echo "Ville non renseignée";}
						}
					?>
				</TD>
				<TD class="case">
					<?php
					$requete="SELECT tel_dom,tel_trav FROM vaecandidat WHERE code_candidat='".$_GET['code']."'";
					$res=mysql_query($requete,$connexion);
					while($row=mysql_fetch_assoc($res)){
						if($row['tel_dom']!=0){
							echo "Tel dom : 0".$row['tel_dom']{0}.".".$row['tel_dom']{1}.$row['tel_dom']{2}.".".$row['tel_dom']{3}.$row['tel_dom']{4}.".".$row['tel_dom']{5}.$row['tel_dom']{6}.".".$row['tel_dom']{7}.$row['tel_dom']{8};}
						else{
							echo "<BR>Tel dom : Non renseigné";}
						if($row['tel_trav']!=0){
							echo "<BR>Tel trav : 0".$row['tel_trav']{0}.".".$row['tel_trav']{1}.$row['tel_trav']{2}.".".$row['tel_trav']{3}.$row['tel_trav']{4}.".".$row['tel_trav']{5}.$row['tel_trav']{6}.".".$row['tel_trav']{7}.$row['tel_trav']{8};}
						else{
							echo "<BR>Tel trav : Non renseigné";}
						}
					?>
				</TD>
			</TR>
			<TR>
				<TD class="case">
					<?php
					$requete="SELECT code_diplome FROM vaecandidat WHERE code_candidat='".$_GET['code']."'";
					$res=mysql_query($requete,$connexion);
					while($row=mysql_fetch_assoc($res)){
						echo "Code diplôme : ".$row['code_diplome'];
						}
					?>
				</TD>
				<TD class="case">
					<?php
					$requete="SELECT type_diplome_demande,nom_diplome_demande FROM vaecandidat WHERE code_candidat='".$_GET['code']."'";
					$res=mysql_query($requete,$connexion);
					while($row=mysql_fetch_assoc($res)){
						echo $row['type_diplome_demande']." ".$row['nom_diplome_demande'];
						}
					?>
				</TD>
				<TD class="case">
					<?php
					$requete="SELECT origine FROM vaecandidat WHERE code_candidat='".$_GET['code']."'";
					$res=mysql_query($requete,$connexion);
					while($row=mysql_fetch_assoc($res)){
						if($row['origine']!=""){
							echo "Origine : ".$row['origine'];}
						else{
							echo "Origine non renseignée";}
						}
					?>
				</TD>
			</TR>
			<TR>
				<TD class="case">
					<?php
					$requete="SELECT situ_pro FROM vaecandidat WHERE code_candidat='".$_GET['code']."'";
					$res=mysql_query($requete,$connexion);
					while($row=mysql_fetch_assoc($res)){
						if($row['situ_pro']!=""){
							echo "Situation : ".$row['situ_pro'];
							}
						else{
							echo "Situation non renseignée";}
						}
					?>
				</TD>
				<TD class="case">
					<?php
					$requete="SELECT date_naiss,lieu_naiss FROM vaecandidat WHERE code_candidat='".$_GET['code']."'";
					$res=mysql_query($requete,$connexion);
					while($row=mysql_fetch_assoc($res)){
						if($row['date_naiss']{5}==0&&$row['date_naiss']{6}==0){
							echo "Date non renseignée";}
						else{
							echo "Date de naiss : ".changeDateFR($row['date_naiss']);}
						if($row['lieu_naiss']==""){
							echo " Lieu de naiss non renseignée";}
						else{
							echo " Lieu de naiss : ".$row['lieu_naiss'];}
						}
					?>
				</TD>
				<TD class="case">
					<?php
					$requete="SELECT bilan_parcours FROM vaecandidat WHERE code_candidat='".$_GET['code']."'";
					$res=mysql_query($requete,$connexion);
					while($row=mysql_fetch_assoc($res)){
						if($row['bilan_parcours']!="attente livret 2"){
							echo "Bilan : ".$row['bilan_parcours'];
							}
						else if($bilan==1){
								echo "Bilan : Non recevable";}
						else if($bilan==2){
								echo "Bilan : Attente recevabilité ou abandon";}
						else if($bilan==3){
								echo "Bilan : Attente réunion info";}
						else if($bilan==4){
								echo "Bilan : Attente livret 2";}
						}
					?>
				</TD>
			</TR>
		</TABLE>
		<BR><BR>
		<TABLE class="etapes">
			<CAPTION>Etapes du parcours VAE</CAPTION>
			<TR>
				<TD class="case">
					<p>Retour du livret 1</p>
				</TD>
				<TD class="case">
					<p>Date de recevabilité</p>
				</TD>
				<TD class="case">
					<p>Date de réunion d'info</p>
				</TD>
				<TD class="case">
					<?php
					$d=changeDateFR($demandeAcc);
					if($d{0}!=0||$d{1}!=0){
						echo "<a class='lien' href='analyse.php?code=".$_GET['code']."'><p>Date d'analyse de l'expérience</p></a>";}
					else{
						echo "<p>Date d'analyse de l'expérience</p>";}
					?>
				</TD>
				<TD class="case">
					<p>Retour du livret 2</p>
				</TD>
				<TD class="case">
					<?php
					if($jury{5}!=0||$jury{6}!=0){
						echo "<a class='lien' href='jury.php?code=".$_GET['code']."'><p>Date jury</p></a>";}
					else{
						echo "<p>Date jury</p>";}
					?>
				</TD>
			</TR>
			<TR>
				<TD class="case">
					<?php
					echo changeDateFR($livret1);
					?>
				</TD>
				<TD class="case">
					<?php
					if($dateNonRecevabilite{5}!=0||$dateNonRecevabilite{6}!=0){
						echo "Déclaré non recevable";}
					else if($dateRecevabilite{5}!=0||$dateRecevabilite{6}!=0){
						echo "Recevable le :<BR>".changeDateFR($dateRecevabilite);}
					else if($dateRecevabiliteCD{5}!=0||$dateRecevabiliteCD{6}!=0){
						echo "Recevable le :<BR>".changeDateFR($dateRecevabiliteCD)."<BR>avec changement de diplôme";}
					else{
						echo "En attente de recevabilité ou abandon";}
					?>
				</TD>
				<TD class="case">
					<?php
					if($dateInfo{5}==0&&$dateInfo{6}==0){
						echo "Date non définie";}
					else{
						echo changeDateFR($dateInfo);}
					?>
				</TD>
				<TD class="case">
					<?php
					if($d{0}==0&&$d{1}==0){
						echo "Analyse non demandée";}
					else{
						echo $d;}
					?>
				</TD>
				<TD class="case">
					<?php
					if($livret2{5}==0&&$livret2{6}==0){
						echo "Livret 2 non rendu";}
					else{
						echo changeDateFR($livret2);}
					?>
				</TD>
				<TD class="case">
					<?php
					if($jury{5}==0&&$jury{6}==0){
						echo "Date non définie";}
					else{
						echo changeDateFR($jury);}
					?>
				</TD>
			</TR>
		</TABLE>
		<BR><BR><INPUT type="button" name="retour" value="Retour" onclick="history.go(-1)"><BR>
		<INPUT type="button" name="accueil" value="Accueil" onclick="document.location.replace('index.php')">
	</BODY>
</HTML>
