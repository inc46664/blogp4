<?php
	require_once(ROOT.'public/frac/head.php');
	require_once(ROOT.'public/frac/nav.php');
	if($PROFILE->isAdmin()) {
?>

<div class="page" >
	
	<div class="content type1">
		<h3 class="ttr title titre">Commentaires</h3>	
		<table class="listComs" >
		<?php for($n=0;$n!=count($comments);$n++) { ?>
			<tr>
				<th><?= $comments[$n]['pseudo'] ?></th>
				<td class="main" ><?= $comments[$n]['text'] ?></td>
				<td class="reports"><?= $comments[$n]['reports'] ?> report(s)</td>
				<td><a href="<?= WEBROOT.'moderation/index/v/'.$comments[$n][0] ?>" >valider</a></td>
				<td><a href="<?= WEBROOT.'moderation/index/d/'.$comments[$n][0] ?>" >supprimer</a></td>
			</tr>
		<?php } ?>
		</table>
	</div>
	
	<div class="content type1">
		<h3 class="ttr title titre">Supprimer un billet</h3>	
		
		<form method="POST" class="newbil" >
			<select name="_dbil-select" >
				<option selected value="0" >Choisir un billet</option>
				<?php for($n=0; $n!=count($billets); $n++) {
					echo '<option value="'.$billets[$n][0].'" >'.htmlspecialchars($billets[$n]['titre']).'</option>';
				} ?>
			</select>
			<input name="_dbil-post" type="submit" value="Supprimer" />
		</form>
		
	</div>
	
	<div class="content type1">
		<h3 class="ttr title titre">Nouveau Billet</h3>	
		
		<form method="POST" class="newbil" >
			<input name="_nbil-titre" type="text" placeholder="Titre..." required="required" />
			<textarea name="_nbil-content" type="text" id="_tarea" ></textarea>
			<input name="_nbil-post" type="submit" value="Créer" />
		</form>
		
	</div>
	
</div>

<?php
	} else {
		header('location:'.WEBROOT);
	}
	require_once(ROOT.'public/frac/foot.php');
?>