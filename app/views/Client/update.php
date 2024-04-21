<html dir='<?= _('ltr') ?>' lang='<?= $lang ?>'>
<head>
	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<title><?= _('Client Update') ?></title>
</head>
<body>
	<div class='container'>
		<?php
			$this->view('shared/clock');
		?>

	<h1><?= _('Client update') ?></h1>
	<p><?= _('Please enter the details of the client that you want to update.') ?></p>
	<form method='post' action=''>
		<label class='form-label'><?= _('First name') ?>:<input type='text' name='first_name' class='form-control' value='<?= $data->first_name?>' /></label><br>
		<label class='form-label'><?= _('Last name') ?>:<input type='text' name='last_name' class='form-control' value='<?= $data->last_name?>' /></label><br>
		<label class='form-label'><?= _('Notes') ?>:<textarea name='notes' class='form-control'><?= $data->notes?></textarea></label><br>
		<label class='form-label'><?= _('Phone') ?>:<input type='text' name='phone' class='form-control' value='<?= $data->phone?>' /></label><br>
		<input type="submit" name='action' value='<?= _('Update!') ?>' class='form-control' />
	</form>
		<?php
			$this->view('shared/navigation');
		?>
	</div>
</body>
</html>