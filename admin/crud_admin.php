<?php include("includes/template_header.php"); ?>
<?php include("includes/sidebar_DBD.php");

if(!$session->is_signed_in()){
    redirect_to("login.php"); }
?>

<?php

if($_GET['admin_id']) {
    $admin_update = Admins::find_by_admin_id($_GET['admin_id']);
}

if(isset($_POST['update'])){
    if($admin_update) {
        $admin_update->admin_name = $_POST['name'];
        $admin_update->password = $_POST['password'];
        $admin_update->update_admin_id();
    }
    else {
        echo $admin_update->errors;
    }
}

if(isset($_POST['submit'])){
    if($admins) {
        $admins->admin_name = $_POST['name'];
        $admins->password = $_POST['password'];
        $admins->save();
    }
    else {
        echo $admins->errors;
    }
}

?>

<div class="container-fluid">
    
    <div class="row">
            <div class="col-12 col-lg-8 mb-3 bg-light rounded mx-auto">
                <form action="" method="POST">
                <div class="row no-gutters">
                    <div class="col-md-10">
                        <div class="m-3">
                            <h5>
                                <label for="name">Add/Update an admin</label>

                            </h5>
                            <p class="card-text">
                                <label for="name">Admin name</label>
                                <input type="text" name="name" class="border-0 w-100" value="<?php echo $admin_update->admin_name; ?>">
                            </p>
                            <p class="card-text">
                                <label for="password">Password</label>
                                <input type="password" id="myInput" name="password" class="border-0 w-100 text-sm text-grey-300" value="<?php echo $admin_update->password;?>">
                                <input type="checkbox" onclick="myFunction()"> Show Password (max 20)
                                <script>
                                    function myFunction() {
                                        var x = document.getElementById("myInput");
                                        if (x.type === "password") {
                                            x.type = "text";
                                        } else {
                                            x.type = "password";}}</script>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- submit buttom-->
                <div class="row justify-content-end">
                    <input type="submit" name="update" value="Update" class="btn btn-success mr-4 mb-3">
                    <input type="submit" name="submit" value="Add" class="btn btn-danger mr-4 mb-3">
                </div>
            </form>
            <!--form-->
            </div>
        </div>
    <form action="" method="POST" >
    <div class="row">
        <div class="col-12 col-lg-8 mb-3 bg-light rounded mx-auto">
        <?php $admins = Admins::find_all(); ?>
        <table class="table table-striped table-light">
            <thead>
            <tr class="text-center">
                <th scope="col">Id</th>
                <th scope="col">name</th>
                <th scope="col">password</th>
                <th scope="col">Update <i class="fas fa-edit text-success"> /<i class="fas fa-trash-alt text-danger"></th>
            </tr>
            </thead>
            <tbody>

        <?php foreach ($admins as $admin): ?>
                        <tr class="text-center">
                            <th scope="row"><?php echo $admin->admin_id; ?></th>
                            <td><?php echo $admin->admin_name; ?></td>
                            <td><?php echo $admin->password; ?></td>
                            <td>
                                <a href="crud_admin.php?admin_id=<?php echo $admin->admin_id; ?>" class="text-success"><i
                                        class="fas fa-edit"></i></a>
                                <a href="delete_admin.php?admin_id=<?php echo $admin->admin_id; ?>" class="text-danger"><i
                                        class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
        <?php endforeach; ?>

            </tbody>
        </table>
    </div>
    </div>
    </form>
    <!--Container-fluid-->
</div>

<?php include("includes/template_footer.php"); ?>

 