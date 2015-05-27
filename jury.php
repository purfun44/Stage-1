<?php
include'connexion.php';
$requete="SELECT unites_obtenues,unites_non_obtenues FROM vaecandidat WHERE code_candidat='".$_GET['code']."'";
$res=mysql_query($requete,$connexion);
while($row=mysql_fetch_assoc($res)){
	if(isset($row['unites_obtenues'])&&$row['unites_obtenues']!=""&&$row['unites_obtenues']!=" "){
		$unites1=explode("- ",$row['unites_obtenues']);
		}
	if(isset($row['unites_non_obtenues'])&&$row['unites_non_obtenues']!=""&&$row['unites_non_obtenues']!=" "){
		$unites2=explode("- ",$row['unites_non_obtenues']);
		}
	}
?>
<HTML>
	<HEAD>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link type="text/css" rel="stylesheet" href="./css/style.css"/>
		<TITLE>Jury</TITLE>
	</HEAD>
	<BODY>
		<TABLE>
			<TR>
				<TD>
					<?php
					$requete="SELECT Nom_inspecteur FROM vaecandidat WHERE code_candidat='".$_GET['code']."'";
					$res=mysql_query($requete,$connexion);
					while($row=mysql_fetch_assoc($res)){
						echo "Le jury a été présidé par : ".$row['Nom_inspecteur']."<BR><BR>";
						}
					?>
				</TD>
			</TR>
			<TR>
				<TD class="unites1">
					<?php
					if(isset($unites2)&&$unites2[0]!=" "){
						if(isset($unites1)&&$unites1[0]!=" "){
							echo "Unités obtenues :<BR>";
							for($i=0;$i<count($unites1);$i++){
								echo $unites1[$i].'<BR>';
								}
							}
						}
					else{
						if(isset($unites1)&&$unites1[0]!=" "){
							echo "Toutes les unités sont validées";
							}
						}
					?>
				<BR><BR></TD>
			</TR>
			<TR>
				<TD class="unites2">
					<?php
					if(isset($unites2)&&$unites2[0]!=" "){
						echo "Unités non obtenues :<BR>";
						for($j=0;$j<count($unites2);$j++){
							echo $unites2[$j].'<BR>';
							}
						}
					?>
				</TD>
			</TR>
		</TABLE>
		<BR><BR><INPUT type="button" name="retour" value="Retour" onclick="history.go(-1)">
		<BR><INPUT type="button" name="accueil" value="Accueil" onclick="document.location.replace('index.php')">
	</BODY>
</HTML>
