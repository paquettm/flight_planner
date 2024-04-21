<html dir='<?= _('ltr') ?>' lang='<?= $lang ?>'>
<head>
	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<title><?= _('Animal Index') ?></title>
</head>
<body>
	<div class='container'>
		<?php
			$this->view('shared/clock');
		?>

		<?php
			$this->view('Client/details_subview',$data['client']);
		?>

		<h1><?= _('All Animals') ?></h1>
		<p><?= _('This is the list of animals.') ?></p>
		<a href='/Animal/create/<?= $data['client']->client_id ?>'><?= _('Create a new animal') ?></a>
		<table>
			<tr><th><?= _('Animal Name') ?></th><th><?= _('Date of birth') ?></th><th><?= _('actions') ?></th></tr>
		<?php 
			global $lang;
			$fmt = new IntlDateFormatter(	$lang, 
											IntlDateFormatter::MEDIUM, 
											IntlDateFormatter::NONE, 
											'UTC', 
											IntlDateFormatter::GREGORIAN);
			//$data is the local name for the data passed into the view
			foreach ($data['animals'] as $animal) {
				$date = new \DateTime($animal->dob);
				echo "<tr><td>$animal->name</td><td>".$fmt->format($date)."</td>
					<td>
						<a href='/Animal/update/$animal->animal_id'>"._('update')."</a> | 
						<a href='/Animal/delete/$animal->animal_id'>"._('delete')."</a> | 
						<a href='/Animal/details/$animal->animal_id'>"._('details')."</a>
					</td>
				<tr>";
			}
		?>
		</table>
		<?php
			$this->view('shared/navigation');
		?>

	</div>
</body>
</html>