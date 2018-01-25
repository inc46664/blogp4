<?php
	require_once(ROOT.'public/frac/head.php');
	require_once(ROOT.'public/frac/nav.php');
	// Check des données
	
	if($User->isAdmin()) {
	
	if(!isset($COMMENTS)) { $COMMENTS = array(); }
?>

<div class="page" >
	<div class="content type1" >
		<h3 class="ttr title titre" >Manager</h3>
		<section class="content" >
			
			<script type="text/javascript" src="<?= WEBROOT.'public/js/admin-comment.js' ?>" ></script>
			<script type="text/javascript" ></script>
			
			<table class="listComs" >
				<tbody>
					<tr class="head" >
						<th>Reports</th>
						<td>Pseudo</td>
						<td>Message</td>
						<td>Date</td>
					</tr>
					<?php listCheckComments($COMMENTS, $User); ?>
				</tbody>
			</table>
			
		</section>
	</div>
	
</div>

<?php

	} else {
		go(WEBROOT, 0);
	}
	
	require_once(ROOT.'public/frac/foot.php');
?>