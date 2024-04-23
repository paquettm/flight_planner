		<ul>
			<li><a href='/Flight/index'><?= _('Flight application index') ?></a></li>
		<?php if(!isset($_SESSION['username'])){ ?>
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