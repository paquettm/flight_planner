<html dir='<?= _('ltr') ?>' lang='<?= $lang ?>'>
<head>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<script type="text/javascript">
		function sendForm(){
			first_name = $('input[name=first_name]').val();
			last_name = $('input[name=last_name]').val();
			notes = $('textarea[name=notes]').val();
			phone = $('input[name=phone]').val();
			$.ajax({
					method: "GET",
					url: "/Test/feedback?action=send",
					data: { first_name: first_name, last_name: last_name, notes: notes, phone: phone }
				})
				.done(function( msg ) {
					alert( "REPLY: " + msg );
				}
			);
		}
	</script>
	<title><?= _('Client Create') ?></title>
</head>
<body>
	<div class='container'>
		<h1><?= _('Create a client') ?></h1>
		<p><?= _('Please enter the details of the client that you want to create.') ?></p>
		<form method='get' action=''>
			<label class='form-label'><?= _('First name') ?>:
				<input type='text' name='first_name' class='form-control' />
			</label><br>
			<label class='form-label'><?= _('Last name') ?>:
				<input type='text' name='last_name' class='form-control' />
			</label><br>
			<label class='form-label'><?= _('Notes') ?>:
				<textarea name='notes' class='form-control'></textarea>
			</label><br>
			<label class='form-label'><?= _('Phone') ?>:
				<input type='text' name='phone' class='form-control' />
			</label><br>
			<a href="javascript:sendForm();" class='btn btn-primary'>SEND</a>
		</form>
	</div>
</body>
</html>