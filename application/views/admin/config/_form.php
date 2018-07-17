<?php
$isNew = true;
if(segment(4) != '') {
    $isNew = false;
    $admin = $admin[0];
    $username = $admin['username'];
    $password = $admin['password'];
    $type = $admin['type'];
}
?>
<div class="box-header">
    <h3 class="box-title">
        <a data-toggle="collapse" href="#admin-config">
            Admin User | <?php echo ($isNew) ? 'Add' : 'Update' ?>
        </a>
    </h3>
</div><!-- /.box-header -->
<div class="box-body collapse in" id="admin-config">
    <form role="form" class="forms" method="post" action="">
        <table class="table table-bordered">
            <tr>
                <td>
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo (!$isNew) ? $username : '';?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" value="<?php echo (!$isNew) ? $password : '';?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Account Type</label>
                    <select name="type" class="form-control">
                        <option value="1" <?php echo (!$isNew && $type == 1) ? 'selected' : '' ?>>Super Admin</option>
                        <option value="2" <?php echo (!$isNew && $type == 2) ? 'selected' : '' ?>>Admin</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input class="btn btn-primary" type="submit" value="Save"/>
                </td>
            </tr>
        </table>
    </form>
</div>