<html dir='<?= _('ltr') ?>' lang='<?= $lang ?>'>
<head>
	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<title><?= _('Contact information') ?></title>
</head>
<body>
	<div class='container'>
		<?php
			$this->view('shared/clock');
		?>

		<h1><?= _('Contact us') ?></h1>
		<dl>
		<?php 
			//$data is the local name for the data passed into the view
			foreach ($data as $key => $value) {
				echo "<dt>$key</dt><dd>$value</dd>";
			}
		?>
		</dl>
		<?php
			$this->view('shared/navigation');
		?>
	</div>
</body>
</html>