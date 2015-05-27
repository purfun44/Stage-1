<?php
include'connexion.php';
$idr=(isset($_POST['type_diplome_demande'])?$_POST['type_diplome_demande']:null);
?>
<HTML>
	<HEAD>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link type="text/css" rel="stylesheet" href="./css/jquery.ui.all.css"/>
		<link type="text/css" rel="stylesheet" href="./css/jquery.autocomplete.css"/>
		<link type="text/css" rel="stylesheet" href="./css/jquery.ui.datepicker.css"/>
		<link type="text/css" rel="stylesheet" href="./css/style.css"/>
		<script type="text/javascript" src="./js/jquery-1.8.3.js"></script>
		<script type="text/javascript" src="./js/jquery.ui.core.js"></script>
		<script type="text/javascript" src="./js/jquery.ui.widget.js"></script>
		<script type="text/javascript" src="./js/jquery.autocomplete.js"></script>
		<script type="text/javascript" src="./js/autocomplete.js"></script>
		<script type="text/javascript" src="./js/jquery.ui.datepicker.js"></script>
		<script type="text/javascript" src="./js/jquery.ui.datepicker-fr.js"></script>
		<script type="text/javascript" src="./js/datepicker.js"></script>
		<TITLE>Rechercher un candidat VAE</TITLE>
	</HEAD>
	<BODY>
		<p class="intitule">Informations parcours candidats VAE depuis 2007</p>
		<?php
		$sql1="SELECT distinct type_diplome_demande FROM vaecandidat ORDER BY type_diplome_demande";
		$rech_type_diplome_demande=mysql_query($sql1);
		$type_diplome_demande=array();
		$nb_type=0;
		if($rech_type_diplome_demande!=false){
			while($ligne=mysql_fetch_assoc($rech_type_diplome_demande)){
				array_push($type_diplome_demande,$ligne['type_diplome_demande']);
				$nb_type++;
				}
			}
		echo "<FORM action='".$_SERVER['PHP_SELF']."' method='POST' id='formulaire'>";
			echo "<TABLE>";
				echo "<TR>";
					echo "<TD>";
						echo "<h5>Types de diplômes:</h5>";
					echo "</TD>";
					echo "<TD>";
						echo "<SELECT name='type_diplome_demande' id='type_diplome_demande' onchange='document.forms['diplomes'].submit();'>";
							if(isset($idr)&&$idr!=-1){
								echo "<option value='".$_POST['type_diplome_demande']."'>".$type_diplome_demande[$_POST['type_diplome_demande']]."</option>";}
							else{
								echo "<option value='-1'>Choisissez un type de diplôme demandé</option>";}
							for($i=0;$i<$nb_type;$i++){
								echo "<option value='$i'>";
								echo $type_diplome_demande[$i];
								echo "</option>";
								}
						echo "</SELECT>";
					echo "</TD>";
					echo "<TD>";
						echo "<input type='submit' name='ok1' id='ok1' value='Valider type diplôme'>";
					echo "</TD>";
					echo "<TD>";
						if(isset($idr)&&$idr!=-1){
							echo "<h5>Intitulés:</h5>";}
					echo "</TD>";
					echo "<TD>";
						if(isset($idr)&&$idr!=-1&&$idr!=0){
							$sql2="SELECT distinct nom_diplome_demande FROM vaecandidat WHERE type_diplome_demande LIKE '".$type_diplome_demande[$_POST['type_diplome_demande']]."' ORDER BY nom_diplome_demande";
							$rech_nom_diplome_demande=mysql_query($sql2,$connexion);
							$nb_nom=0;
							$nom_diplome_demande=array();
							while($ligne_nom=mysql_fetch_assoc($rech_nom_diplome_demande)){
								array_push($nom_diplome_demande,$ligne_nom['nom_diplome_demande']);
								$nb_nom++;
								}
							echo "<SELECT name='nom_diplome_demande' id='nom_diplome_demande'>";
							if(isset($_POST['nom_diplome_demande'])&&$_POST['nom_diplome_demande']!=-1&&$_POST['nom_diplome_demande']!=-2){
								echo "<option value='".$_POST['nom_diplome_demande']."'>".$nom_diplome_demande[$_POST['nom_diplome_demande']]."</option>";}
							else if(isset($_POST['nom_diplome_demande'])&&$_POST['nom_diplome_demande']==-2){
								echo "<option value='-2'></option>";
								}
							else{
								echo "<option value='-1'>Choisissez un nom de diplôme demandé</option>";}
							echo "<option value='-2'></option>";
							for($d=0;$d<$nb_nom;$d++){
								echo "<option value='$d'>";
								echo $nom_diplome_demande[$d];
								echo "</option>";
								}
							echo "</SELECT>";
							}
						else if(isset($idr)&&$idr==0){
							$sql3="SELECT distinct nom_diplome_demande FROM vaecandidat ORDER BY nom_diplome_demande";
							$rech_nom_diplome_demande=mysql_query($sql3,$connexion);
							$nb_nom=0;
							$nom_diplome_demande=array();
							while($ligne_nom=mysql_fetch_assoc($rech_nom_diplome_demande)){
								array_push($nom_diplome_demande,$ligne_nom['nom_diplome_demande']);
								$nb_nom++;
								}
							echo "<SELECT name='nom_diplome_demande' id='nom_diplome_demande'>";
								if(isset($_POST['nom_diplome_demande'])&&$_POST['nom_diplome_demande']!=-1){
									echo "<option value='".$_POST['nom_diplome_demande']."'>".$nom_diplome_demande[$_POST['nom_diplome_demande']]."</option>";}
								else{
									echo "<option value='-1'>Choisissez un nom de diplôme demandé</option>";}
								for($d=0;$d<$nb_nom;$d++){
									echo "<option value='$d'>";
									echo $nom_diplome_demande[$d];
									echo "</option>";
									}
							echo "</SELECT>";
							}
						$rech_nom_diplome_demande='';
					echo "</TD>";
				echo "</TR>";
			echo "</TABLE>";
			?>
			<TABLE>
				<TR>
					<TD>
						<h5>Nom d'usage candidat:</h5>
					</TD>
					<TD>
						<?php
						if(isset($_POST['nom_candidat'])&&$_POST['nom_candidat']!=""){
							echo "<input type='text' name='nom_candidat' id='nom_candidat' size='50' value='".$_POST['nom_candidat']."'>";
							}
						else{
							echo "<input type='text' name='nom_candidat' id='nom_candidat' size='50'>";
							}
						?>
					</TD>
					<TD>
						<h5>et/ou Nom de famille:</h5>
					</TD>
					<TD>
						<?php
						if(isset($_POST['nom_JF'])&&$_POST['nom_JF']!=""){
							echo "<input type='text' name='nom_JF' id='nom_JF' size='50' value='".$_POST['nom_JF']."'>";
							}
						else{
							echo "<input type='text' name='nom_JF' id='nom_JF' size='50'>";
							}
						?>
					</TD>
				</TR>
			</TABLE>
			<TABLE class="tableau">
				<TR>
					<TH class="encadre">
						<h5>Etapes</h5>
					</TH>
					<TH class="encadre">
						<h5>Début</h5>
					</TH>
					<TH class="encadre">
						<h5>Fin</h5>
					</TH>
				</TR>
				<TR>
					<TD class="encadre">
						<h5>Réunion d'information:<BR>OU</h5>
					</TD>
					<TD class="encadre">
						<?php
						if(isset($_POST['date_reunion_info'])&&$_POST['date_reunion_info']!=""){
							echo "<input type='text' size='7' style='padding:5px;border:solid 1px black;color:black;border-radius:5px;' name='date_reunion_info' id='date_reunion_info' value='".$_POST['date_reunion_info']."'>";}
						else{
							echo "<input type='text' size='7' style='padding:5px;border:solid 1px black;color:black;border-radius:5px;' name='date_reunion_info' id='date_reunion_info'>";}
						?>
					</TD>
					<TD class="encadre">
						<?php
						if(isset($_POST['date_reunion_info2'])&&$_POST['date_reunion_info2']!=""){
							echo "<input type='text' size='7' style='padding:5px;border:solid 1px black;color:black;border-radius:5px;' name='date_reunion_info2' id='date_reunion_info2' value='".$_POST['date_reunion_info2']."'>";}
						else{
							echo "<input type='text' size='7' style='padding:5px;border:solid 1px black;color:black;border-radius:5px;' name='date_reunion_info2' id='date_reunion_info2'>";}
						?>
					</TD>
				</TR>
				<TR>
					<TD class="encadre">
						<h5>Analyse d'expérience:<BR>OU</h5>
					</TD>
					<TD class="encadre">
						<?php
						if(isset($_POST['DateDemande_accompagnement'])&&$_POST['DateDemande_accompagnement']!=""){
							echo "<input type='text' size='7' style='padding:5px;border:solid 1px black;color:black;border-radius:5px;' name='DateDemande_accompagnement' id='DateDemande_accompagnement' value='".$_POST['DateDemande_accompagnement']."'>";}
						else{
							echo "<input type='text' size='7' style='padding:5px;border:solid 1px black;color:black;border-radius:5px;' name='DateDemande_accompagnement' id='DateDemande_accompagnement'>";}
						?>
					</TD>
					<TD class="encadre">
						<?php
						if(isset($_POST['DateDemande_accompagnement2'])&&$_POST['DateDemande_accompagnement2']!=""){
							echo "<input type='text' size='7' style='padding:5px;border:solid 1px black;color:black;border-radius:5px;' name='DateDemande_accompagnement2' id='DateDemande_accompagnement2' value='".$_POST['DateDemande_accompagnement2']."'>";}
						else{
							echo "<input type='text' size='7' style='padding:5px;border:solid 1px black;color:black;border-radius:5px;' name='DateDemande_accompagnement2' id='DateDemande_accompagnement2'>";}
						?>
					</TD>
				</TR>
				<TR>
					<TD class="encadre">
						<h5>Retour du livret 2:<BR>OU</h5>
					</TD>
					<TD class="encadre">
						<?php
						if(isset($_POST['livret2_rendu_le'])&&$_POST['livret2_rendu_le']!=""){
							echo "<input type='text' size='7' style='padding:5px;border:solid 1px black;color:black;border-radius:5px;' name='livret2_rendu_le' id='livret2_rendu_le' value='".$_POST['livret2_rendu_le']."'/>";}
						else{
							echo "<input type='text' size='7' style='padding:5px;border:solid 1px black;color:black;border-radius:5px;' name='livret2_rendu_le' id='livret2_rendu_le'/>";}
						?>
					</TD>
					<TD class="encadre">
						<?php
						if(isset($_POST['livret2_rendu_le2'])&&$_POST['livret2_rendu_le2']!=""){
							echo "<input type='text' size='7' style='padding:5px;border:solid 1px black;color:black;border-radius:5px;' name='livret2_rendu_le2' id='livret2_rendu_le2' value='".$_POST['livret2_rendu_le2']."'/>";}
						else{
							echo "<input type='text' size='7' style='padding:5px;border:solid 1px black;color:black;border-radius:5px;' name='livret2_rendu_le2' id='livret2_rendu_le2'/>";}
						?>
					</TD>
				</TR>
				<TR>
					<TD class="encadre">
						<h5>Jury:</h5>
					</TD>
					<TD class="encadre">
						<?php
						if(isset($_POST['date_jury'])&&$_POST['date_jury']!=""){
							echo "<input type='text' size='7' style='padding:5px;border:solid 1px black;color:black;border-radius:5px;' name='date_jury' id='date_jury' value='".$_POST['date_jury']."'/>";}
						else{
							echo "<input type='text' size='7' style='padding:5px;border:solid 1px black;color:black;border-radius:5px;' name='date_jury' id='date_jury'/>";}
						?>
					</TD>
					<TD class="encadre">
						<?php
						if(isset($_POST['date_jury2'])&&$_POST['date_jury2']!=""){
							echo "<input type='text' size='7' style='padding:5px;border:solid 1px black;color:black;border-radius:5px;' name='date_jury2' id='date_jury2' value='".$_POST['date_jury2']."'>";}
						else{
							echo "<input type='text' size='7' style='padding:5px;border:solid 1px black;color:black;border-radius:5px;' name='date_jury2' id='date_jury2'>";}
						?>
					</TD>
				</TR>
			</TABLE>
			<TABLE class="recapitulatif">
			<TR><TD>
				<h4 class="a">Récapitulatif de la recherche:</h4>
				<P class="b">
				<?php
				//Type et intitule du diplome
				if((isset($idr)&&$idr!=-1&&$idr!=0) || (isset($_POST['nom_diplome_demande'])&&$_POST['nom_diplome_demande']!=-1)){
					if($idr!=0||$_POST['nom_diplome_demande']!=0){
						echo "Diplôme sélectionné: ";
						}
					else{
						echo "<p class='rouge'>Diplôme non sélectionné</p>";}
					}
				else{
					echo "<p class='rouge'>Diplôme non sélectionné</p>";}
				if(isset($idr)&&$idr!=-1&&$idr!=0){
					echo $type_diplome_demande[$_POST['type_diplome_demande']];
					}
				if(isset($_POST['nom_diplome_demande'])&&$_POST['nom_diplome_demande']!=-1&&$_POST['nom_diplome_demande']!=-2){
					echo " ".$nom_diplome_demande[$_POST['nom_diplome_demande']];
					}
				//Nom et prenom du candidat
				if(isset($_POST['nom_candidat'])&&$_POST['nom_candidat']!=""){
					echo "<p>Il s'agit du candidat ";
					list($nom,$prenom)=explode(" ",$_POST['nom_candidat']);
					echo $nom." ".$prenom."</p>";
					}
				else{
					echo "<p class='rouge'>Nom du candidat non renseigné</p>";}
				//Nom de jeune fille
				if(isset($_POST['nom_JF'])&&$_POST['nom_JF']!=""){
					echo "<p>Le nom de jeune fille du candidat est: ";
					echo $_POST['nom_JF']."</p>";
					}
				//Dates
				if(isset($_POST['date_reunion_info'])&&$_POST['date_reunion_info']!=""&&isset($_POST['date_reunion_info2'])&&$_POST['date_reunion_info2']!=""){
					echo "<p>Intervalle de dates pour la réunion d'information: ";
					echo $_POST['date_reunion_info']." - ".$_POST['date_reunion_info2']."</p>";
					}
				else{
					echo "<p class='rouge'>Date de réunion d'information non saisie ou incomplète</p>";}
				if(isset($_POST['DateDemande_accompagnement'])&&$_POST['DateDemande_accompagnement']!=""&&isset($_POST['DateDemande_accompagnement2'])&&$_POST['DateDemande_accompagnement2']!=""){
					echo "<p>Intervalle de dates pour la demande d'accompagnement: ";
					echo $_POST['DateDemande_accompagnement']." - ".$_POST['DateDemande_accompagnement2']."</p>";
					}
				else{
					echo "<p class='rouge'>Date d'analyse non saisie ou incomplète</p>";}
				if(isset($_POST['livret2_rendu_le'])&&$_POST['livret2_rendu_le']!=""&&isset($_POST['livret2_rendu_le2'])&&$_POST['livret2_rendu_le2']!=""){
					echo "<p>Intervalle de dates pour le retour du livret 2: ";
					echo $_POST['livret2_rendu_le']." - ".$_POST['livret2_rendu_le2']."</p>";
					}
				else{
					echo "<p class='rouge'>Date de retour du livret 2 non saisie ou incomplète</p>";}
				if(isset($_POST['date_jury'])&&$_POST['date_jury']!=""&&isset($_POST['date_jury2'])&&$_POST['date_jury2']!=""){
					echo "<p>Intervalle de dates pour le jury: ";
					echo $_POST['date_jury']." - ".$_POST['date_jury2']."</p>";
					}
				else{
					echo "<p class='rouge'>Date de jury non saisie ou incomplète</p>";}
				?>
				</P>
			</TD></TR>
			</TABLE>
			<center class="bouton">
			<INPUT type="submit" name="ok4" id="ok4" value="Validez vos critères">
			<INPUT type="button" name="annuler" value="Annulez les critères" onclick="document.location.replace('index.php')">
			</center>
			<h4 class="titre">Veuillez choisir votre candidat dans la liste ci-dessous<BR>Si votre recherche ne donne aucun résultat, vérifiez dans le récapitulatif si vos critères ont bien été pris en compte</h4>
				<p> <?php include 'suggestions.php'; ?> </p>
		</FORM>
	</BODY>
</HTML>
