		<ul>
			<li><a href='/Client/index'><?= _('Client index') ?></a></li>
			<li><a href='/Client/create'><?= _('Client create') ?></a></li>
			<li><a href='/Main/index'><?= _('Main index') ?></a></li>
		<?php if(!isset($_SESSION['user_id'])){ ?>
			<li><a href='/User/login'><?= _('Log in') ?></a></li>
		<?php }else{ ?>
			<li><a href='/User/logout'><?= _('Log out') ?></a></li>
		<?php } ?>
</ul>
<?= _('Language') ?>
<ul><?php
foreach ($localizations as $locale){
	echo "<li><a href='?lang=$locale'>". \Locale::getDisplayName($locale,$locale) . "</a></li>";
}
?>
		</ul>