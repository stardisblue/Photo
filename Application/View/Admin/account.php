<form action="<?= WEB_ROOT ?>/admin/account" method="post">
    <div class="form-group">
        <label for="login">Login</label>
        <input class="form-control" id="login" type="text" value="<?= trim($login) ?>"/>
    </div>
    <div class="form-group">
        <input class="btn btn-default" type="submit" name="submit" value="Modify"/>
    </div>
</form>