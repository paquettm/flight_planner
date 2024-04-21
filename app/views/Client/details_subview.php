	<h1><?= _('Client details') ?></h1>
	<form method='post' action=''>
		<label class='form-label'><?= _('First name') ?>:<input type='text' name='first_name' class='form-control' value='<?= $data->first_name?>' /></label><br>
		<label class='form-label'><?= _('Last name') ?>:<input type='text' name='last_name' class='form-control' value='<?= $data->last_name?>' /></label><br>
		<label class='form-label'><?= _('Notes') ?>:<textarea name='notes' class='form-control'><?= $data->notes?></textarea></label><br>
		<label class='form-label'><?= _('Phone') ?>:<input type='text' name='phone' class='form-control' value='<?= $data->phone?>' /></label><br>
	</form>
<a href='/Animal/index/<?= $data->client_id ?>'><?= _('List my animals') ?></a>