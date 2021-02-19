<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $email = $_POST['email'];
    $balance = $_POST['balance'];
    $result = mysqli_query($conn, "insert into user(firstName,email,balance) values('{$firstName}','{$email}','{$balance}')");
    if ($result) {
        echo "<script> alert('Hurray! User created');
            window.location='transfermoney.php';
  </script>";
    }
}
?>




<?php
include 'header.php';
?>

<div class="container-fluid">

    <div class="bg-img">
        <img class="home-img" src="images/home-img.jpg">
    </div>
    <div class="row">
        <div class="welcome"><b>Welcome to TSF Bank!</b></div>
        <div class="login-form">

            <form class="form-fields" action="index.php" method="post">
                <p class="create-user">Create Account</p>
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter Your Name" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email ID</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email Address">
                </div>
                <div class="form-group">
                    <label for="exampleInputBalance1">Balance Amount</label>
                    <input type="number" class="form-control" id="balance" name="balance" placeholder="Current Balance">
                </div>

                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>

    </div>
</div>

<?php
include 'footer.php';
?>