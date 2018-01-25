<?php
	require_once(ROOT.'public/frac/head.php');
	require_once(ROOT.'public/frac/nav.php');
	// Check des données
	if(!isset($BILLET)) { $BILLET = array(); }
	if(!isset($COMMENTS)) { $COMMENTS = array(); }
	if(!isset($Edited)) { $Edited = null; }
?>

<div class="page" >
	<div class="content type1" >
		<?php if(count($BILLET) > 2) { ?>
		<h3 class="ttr title titre" ><?= $BILLET['titre']; ?></h3>
		<section class="content" >
			
			<div class="billet-page" >
                <section class="head" >
					<span class="date" ><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo dateFr($BILLET['date_create'], 'Publié le %1%/%2%/%3% à %4%h'); ?></span>
					<span class="date" ><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo dateFr($BILLET['date_update'], 'Dernière mise à jour le %1%/%2%/%3% à %4%h%5%'); ?></span>
					<span class="user" ><i class="fa fa-user" aria-hidden="true" ></i> Ajouté par <?php echo $BILLET['pseudo']; ?></span>
					<span class="coms" ><i class="fa fa-comment-o" ></i> <?= $comsEngine->getCountComments($BILLET[0], $bdd); ?> Commentaire(s)</span>
					<?php if($User->isAdmin()) { if($EditMode === true) { ?>
					<a class="admin-button small" href="/blog/chapitres/lire/<?php echo $BILLET['url'].'/' ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Fermer l'éditeur</a>
					<?php } else { ?>
					<a class="admin-button small" href="/blog/chapitres/lire/<?php echo $BILLET['url'].'/edit/' ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Editer</a>
					<a class="admin-button small" href="/blog/chapitres/delete/<?php echo $BILLET[0].'/' ?>"><i class="fa fa-trash" aria-hidden="true"></i> Supprimer</a>
					<?php } } ?>
				</section>
                
				<section class="content" >
					<div class="inset" >
						<?php if($EditMode === true) { ?>
						<form method="POST" class="tinymce" >
							<textarea class="tinymce" name="_edit-text" id="_tarea" ><?= nl2br($BILLET['content']) ?></textarea>
							<?php if($Edited != null) { info('info', $Edited); } ?>
							<input type="submit" class="sub" name="_edit-sub" value="Enregistrer" />
						</form>
						<?php } else { echo nl2br($BILLET['content']); } ?>
					</div>
				</section>
                
				<?php if($EditMode === false) { ?>
				<section class="coms" id="_coms" >
					<h4 class="ttr title titre" >Espace commentaires</h4>
					<div class="getcoms" >
						<?php if($User->isLogged()) { ?>
						<article class="Comment" id="write" >
							<div class="msg-head" >
								<span class="user" ><?= $User->get('pseudo') ?></span>
							</div>
							<div class="msg-body" >
								<form method="POST" >
									<textarea name="write_text" class="newmsg" placeholder="Message..." ></textarea>
									<input type="submit" class="sub smallsize" value="Poster" name="write_post" />
								</form>
							</div>
						</article>
						<?php } ?>
						<?= listComments($COMMENTS, $BILLET, $User); ?>
					</div>
				</section>
				<?php } ?>
                
            </div>
			
		</section>
		<?php } else {
			info('error', "Ce chapitre n'existe pas");
		} ?>
	</div>
	
</div>

<?php
	require_once(ROOT.'public/frac/foot.php');
?>