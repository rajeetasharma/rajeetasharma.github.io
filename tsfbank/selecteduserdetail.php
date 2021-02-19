<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from user where id=$from";
    $query = mysqli_query($conn, $sql);
    $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.

    $sql = "SELECT * from user where id=$to";
    $query = mysqli_query($conn, $sql);
    $sql2 = mysqli_fetch_array($query);



    // constraint to check input of negative value by user
    if (($amount) < 0) {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
        echo '</script>';
    }



    // constraint to check insufficient balance.
    else if ($amount > $sql1['balance']) {

        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }



    // constraint to check zero values
    else if ($amount == 0) {

        echo "<script type='text/javascript'>";
        echo "alert('Oops! Zero value cannot be transferred')";
        echo "</script>";
    } else {

        // deducting amount from sender's account
        $newbalance = $sql1['balance'] - $amount;
        $sql = "UPDATE user set balance=$newbalance where id=$from";

        mysqli_query($conn, $sql);


        // adding amount to reciever's account
        $newbalance = $sql2['balance'] + $amount;
        $sql = "UPDATE user set balance=$newbalance where id=$to";
        mysqli_query($conn, $sql);

        $sender = $sql1['firstName'];
        $receiver = $sql2['firstName'];
        $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
        $query = mysqli_query($conn, $sql);

        if ($query) {

            echo "<script> alert('Transaction Successful');
                                     window.location='transactionhistory.php';
                           </script>";
        }

        $newbalance = 0;
        $amount = 0;
    }
}
?>

<style>
    .container {
        height: 100vh;
    }
</style>



<?php
include 'header.php';
?>

<div class="container">
    <h2 class="text-center pt-4" style="color : black;padding-top:30px;">Transaction</h2>
    <?php
    include 'config.php';
    $sid = $_GET['id'];
    $sql = "SELECT * FROM  user where id=$sid";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo "Error : " . $sql . "<br>" . mysqli_error($conn);
    }
    $rows = mysqli_fetch_assoc($result);
    ?>
    <form method="post" name="selecteduserdetail.php" class="tabletext"><br>
        <div>
            <table class="table table-striped table-condensed table-bordered">
                <tr style="border: 2px solid black;">
                    <th class="text-center" style="border: 2px solid black;">Id</th>
                    <th class="text-center" style="border: 2px solid black;">Name</th>
                    <th class="text-center" style="border: 2px solid black;">Email</th>
                    <th class="text-center" style="border: 2px solid black;">Balance</th>
                </tr>
                <tr style="border: 2px solid black;">
                    <td class="py-2" style="border: 2px solid black;"><?php echo $rows['id'] ?></td>
                    <td class="py-2" style="border: 2px solid black;"><?php echo $rows['firstName'] ?></td>
                    <td class="py-2" style="border: 2px solid black;"><?php echo $rows['email'] ?></td>
                    <td class="py-2" style="border: 2px solid black;"><?php echo $rows['balance'] ?></td>
                </tr>
            </table>
        </div>
        <br><br><br>
        <label style="color : black; font-size:20px;"><b>Transfer To:</b></label>
        <input type="hidden" name="from" value="<?php echo $sid; ?>" />
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose</option>
            <?php
            include 'config.php';
            $sid = $_GET['id'];
            $sql = "SELECT * FROM user where id!=$sid";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                echo "Error " . $sql . "<br>" . mysqli_error($conn);
            }
            while ($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id']; ?>">

                    <?php echo $rows['firstName']; ?> (Balance:
                    <?php echo $rows['balance']; ?> )

                </option>
            <?php
            }
            ?>
            <div>
        </select>
        <br>
        <br>
        <label style="color : black; font-size:20px;"><b>Amount:</b></label>
        <input type="number" class="form-control" name="amount" required>
        <br><br>
        <div class="text-center">
            <button class="selected-btn" name="submit" type="submit" id="myBtn">Transfer</button>
        </div>
    </form>
</div>

<?php
include('footer.php');
?>