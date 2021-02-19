<?php
include 'config.php';

$sql = "SELECT * FROM user";
$result = mysqli_query($conn, $sql);
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
    <h2 class="text-center pt-4" style="color : black; padding-top:20px;">Transfer Money</h2>
    <br>
    <div class="row">
        <div class="col">
            <div class="table-responsive-sm">
                <table class="table table-hover table-sm table-striped table-condensed table-bordered" style="border: 2px solid black;">
                    <thead style="color : black;">
                        <tr>
                            <th scope="col" class="text-center py-2" style="border: 2px solid black;">Id</th>
                            <th scope="col" class="text-center py-2" style="border: 2px solid black;">Name</th>
                            <th scope="col" class="text-center py-2" style="border: 2px solid black;">E-Mail</th>
                            <th scope="col" class="text-center py-2" style="border: 2px solid black;">Balance</th>
                            <th scope="col" class="text-center py-2" style="border: 2px solid black;">Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($rows = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr style="color : black; text-align:center;">
                                <td class="py-2" style="border: 2px solid black;"><?php echo $rows['id'] ?></td>
                                <td class="py-2" style="border: 2px solid black;"><?php echo $rows['firstName'] ?></td>
                                <td class="py-2" style="border: 2px solid black;"><?php echo $rows['email'] ?></td>
                                <td class="py-2" style="border: 2px solid black;"><?php echo $rows['balance'] ?></td>
                                <td style="border: 2px solid black;"><a href="selecteduserdetail.php?id=<?php echo $rows['id']; ?>"> <button class="transfer-btn"">Transfer</button></a></td>
                                </tr>
                           
<?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

  <?php
    include 'footer.php';
    ?>