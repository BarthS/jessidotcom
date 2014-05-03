<?php
// Couleur du texte des champs si erreur saisie utilisateur
$color_font_warn="#FF0000";
// Couleur de fond des champs si erreur saisie utilisateur
$color_form_warn="#FFCC66";
// Ne rien modifier ci-dessous si vous n’êtes pas certain de ce que vous faites !
if(isset($_POST['submit'])){
	$erreur="";
	// Nettoyage des entrées
	while(list($var,$val)=each($_POST)){
	if(!is_array($val)){
		$$var=strip_tags($val);
	}else{
		while(list($arvar,$arval)=each($val)){
				$$var[$arvar]=strip_tags($arval);
			}
		}
	}
	// Formatage des entrées
	$f_1=trim(ucwords(eregi_replace("[^a-zA-Z0-9éèàäö\ -]", "", $f_1)));
	$f_2=trim(ucwords(eregi_replace("[^a-zA-Z0-9éèàäö\ -]", "", $f_2)));
	$f_4=strip_tags(trim($f_4));
	$f_5=trim(eregi_replace("[^0-9\ +]", "", $f_5));
	$f_6=trim(ucwords(eregi_replace("[^a-zA-Z0-9éèàäö\ -]", "", $f_6)));
	// Verification des champs
	if(strlen($f_2)<2){
		$erreur.="<li><span class='txterror'>Le champ &laquo; Objet &raquo; est vide ou incomplet.</span>";
		$errf_2=1;
	}
	if(strlen($f_3)<2){
		$erreur.="<li><span class='txterror'>Le champ &laquo; Message &raquo; est vide ou incomplet.</span>";
		$errf_3=1;
	}
	if(strlen($f_4)<2){
		$erreur.="<li><span class='txterror'>Le champ &laquo; E-Mail &raquo; est vide ou incomplet.</span>";
		$errf_4=1;
	}else{
		if(!ereg('^[-!#$%&\'*+\./0-9=?A-Z^_`a-z{|}~]+'.
		'@'.
		'[-!#$%&\'*+\/0-9=?A-Z^_`a-z{|}~]+\.'.
		'[-!#$%&\'*+\./0-9=?A-Z^_`a-z{|}~]+$',
		$f_4)){
			$erreur.="<li><span class='txterror'>La syntaxe de votre adresse e-mail n'est pas correcte.</span>";
			$errf_4=1;
		}
	}
	if($erreur==""){
		// Création du message
		$titre="Message de votre site";
		$tete="From:Site@Jessi\n";
		$corps.="Nom : ".$f_1."\n";
		$corps.="Objet : ".$f_2."\n";
		$corps.="Message : ".$f_3."\n";
		$corps.="E-Mail : ".$f_4."\n";
		$corps.="Téléphone : ".$f_5."\n";
		$corps.="Site web : ".$f_6."\n";
		if(mail("administrateurs@jessi-strasbourg.fr", $titre, stripslashes($corps), $tete)){
			$ok_mail="true";
		}else{
			$erreur.="<li><span class='txterror'>Une erreur est survenue lors de l'envoi du message, veuillez refaire une tentative.</span>";
		}
	}
}
?>




<? if($ok_mail=="true"){ ?>
	<table width='100%' border='0' cellspacing='1' cellpadding='1'>
		<tr><td><span class='txtform'>Le message ci-dessous nous a bien été transmis, et nous vous en remercions.</span></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td><tt><?echo nl2br(stripslashes($corps));?></tt></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td><span class='txtform'>Nous allons y donner suite dans les meilleurs délais.<br>A bientôt.</span></td></tr>
	</table>
<? }else{ ?>
<form action='<? echo $PHP_SELF ?>' method='post' name='Form'>
<table width='100%' border='0' cellspacing='1' cellpadding='1'>
<? if($erreur){ ?><tr><td colspan='2' bgcolor='red'><span class='txterror'><font color='white'><b>&nbsp;ERREUR, votre message n'a pas été transmis</b></font></span></td></tr><tr><td colspan='2'><ul><?echo$erreur?></ul></td></tr><?}?>
<tr><td colspan='2'><span class='txterror'>Les champs marqué d'un * sont obligatoires</span></td></tr>
<tr><td align='right' width='30%'><span class='txtform'>Nom :</span></td><td><input type='text' style='width:200 <?if($errf_1==1){print("; background-color: ".$color_form_warn."; color: ".$color_font_warn);}?>;' name='f_1' value='<?echo stripslashes($f_1);?>' size='24' border='0'></td></tr>
<tr><td align='right' width='30%'><span class='txtform'>Objet* :</span></td><td><input type='text' style='width:200 <?if($errf_2==1){print("; background-color: ".$color_form_warn."; color: ".$color_font_warn);}?>;' name='f_2' value='<?echo stripslashes($f_2);?>' size='24' border='0'></td></tr>
<tr><td align='right' width='30%'><span class='txtform'>Message* :</span></td><td><textarea style='width:360 <?if($errf_3==1){print("; background-color: ".$color_form_warn."; color: ".$color_font_warn);}?>;' name='f_3' rows='6' cols='40'><?echo$f_3?></textarea></td></tr>
<tr><td align='right' width='30%'><span class='txtform'>E-Mail* :</span></td><td><input type='text' style='width:200 <?if($errf_4==1){print("; background-color: ".$color_form_warn."; color: ".$color_font_warn);}?>;' name='f_4' value='<?echo stripslashes($f_4);?>' size='24' border='0'></td></tr>
<tr><td align='right' width='30%'><span class='txtform'>Téléphone :</span></td><td><input type='text' style='width:200 <?if($errf_5==1){print("; background-color: ".$color_form_warn."; color: ".$color_font_warn);}?>;' name='f_5' value='<?echo stripslashes($f_5);?>' size='24' border='0'></td></tr>
<tr><td align='right' width='30%'><span class='txtform'>Site web :</span></td><td><input type='text' style='width:200 <?if($errf_6==1){print("; background-color: ".$color_form_warn."; color: ".$color_font_warn);}?>;' name='f_6' value='<?echo stripslashes($f_6);?>' size='24' border='0'></td></tr>
<tr><td align='right' width='30%'></td><td><input type='submit' name='submit' value='Envoyer' border='0'></td></tr>
</table>
</form>
<? } ?>