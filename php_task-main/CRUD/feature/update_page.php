<?php

include('../layout/header.php');
require('../conn.php');
?>

<?php
if(isset($_GET['id'])){
    $id=$_GET['id'];;

    $query="SELECT * FROM `crud` WHERE `user_id`=:id";

    $statment=$dbconnection->prepare($query);
    $statment->bindParam(':id',$id,PDO::PARAM_INT);
    $statment->execute();

    $user=$statment->fetch(PDO::FETCH_ASSOC);
    print_r($user);

}

?>

<?php
if(isset($_POST['update_user'])){
    $fname=$_POST['fname'];
    
}

?>


<div class="container mt-5">
    <form action="update_page.php" method="post">
        <div class="form-group">
            <label for="fname">User Name</label>
            <input type="text" class="form-control" name="fname" id="fname" aria-describedby="fname"
                value=<?php echo $user['user_name'];?>>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="email" name="email"
                value=<?php echo $user['user_email'];?>>
        </div>
        <div class="form-group">
            <label for="mobile">User Mobile</label>
            <input type="text" class="form-control" id="mobile" aria-describedby="mobile" placeholder="mobile" name="mobile"
                value=<?php echo $user['user_mobile'];?>>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control" id="password" name="password" placeholder="password" value=<?php echo $user['user_password'];?>>
        </div>
        
        <input type="submit" class="btn btn-success" name="update_user" value="UPDATE">
    </form>
</div>

<?php

include('../layout/footer.php');
?>