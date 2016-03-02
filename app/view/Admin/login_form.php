<?php if ($info == 'logout_success'): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <b>Logout success !</b>
    </div>
<?php endif ?>
<?php if ($info == 'login_error'): ?>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <b>Wrong login</b>
    </div>
<?php endif ?>
<?php if ($info == 'password_error'): ?>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <b>Wrong password</b>
    </div>
<?php endif ?>
<form action="<?= WEB_ROOT ?>/admin/login" method="post">
    <div class="form-group">
        <label for="login">Login</label>
        <input class="form-control" id="login" placeholder="Enter login" type="text" name="login"/>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input class="form-control" id="password" placeholder="Enter password" type="password" name="password"/>
    </div>
    <div class="form-group">
        <input class="btn btn-default" type="submit" name="submit" value="Login"/>
    </div>
</form>