<!DOCTYPE html>
<html dir='<?= _('ltr') ?>' lang='<?= $lang ?>'>
<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/style.css" />
    <title><?= _('User login') ?></title>
</head>
<body>
    <div class="container mt-3">

        <h1><?= _('Log into your user account') ?></h1>

        <form method="post" action="">
            <div class="mb-3">
                <label for="username" class="form-label"><?= _('Username') ?></label>
                <input type="text" id="username" name="username" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label"><?= _('Password') ?></label>
                <input type="password" id="password" name="password" class="form-control" />
            </div>
            <div class="d-grid">
                <input type="submit" name="action" value="<?= _('Login!') ?>" class="btn btn-primary" />
            </div>
        </form>

        <p class="mt-3"><?= _('No account?') ?> <a href="/User/register"><?= _('Register here.') ?></a></p>
        <p class="mt-3"><a href="/Flight/index"><?= _('Back to trip planning') ?></a></p>
    </div>
</body>
</html>
