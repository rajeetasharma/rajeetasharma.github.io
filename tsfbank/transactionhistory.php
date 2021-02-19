<?php
include 'header.php';
?>

<style>
    .container {

        height: 100vh;

    }
</style>


<div class="container">
    <h2 class="text-center pt-4" style="color: black; padding-top:20px;">Transaction History</h2>

    <br>
    <div class="table-responsive-sm">
        <table class="table table-hover table-striped table-condensed table-bordered" style=" border-color:black" ;>
            <thead style="color: black;">
                <tr>

                    <th class="text-center py-2" style="border: 2px solid black;">Sender</th>
                    <th class="text-center py-2" style="border: 2px solid black;">Receiver</th>
                    <th class="text-center py-2" style="border: 2px solid black;">Amount</th>
                    <th class="text-center py-2" style="border: 2px solid black;">Date & Time</th>
                </tr>
            </thead>

            <tbody>
                <?php
                include 'config.php';

                $sql = "SELECT * FROM `transaction`";
                $query = mysqli_query($conn, $sql);

                while ($rows = mysqli_fetch_assoc($query)) {

                ?>

                    <tr style="color: black;">

                        <td class="py-2" style="border: 2px solid black;"><?php echo $rows['sender']; ?></td>
                        <td class="py-2" style="border: 2px solid black;"><?php echo $rows['receiver']; ?></td>
                        <td class="py-2" style="border: 2px solid black;"><?php echo $rows['balance']; ?></td>
                        <td class="py-2" style="border: 2px solid black;"><?php echo $rows['datetime']; ?></td>
                    </tr>
                <?php } ?>

            </tbody>


        </table>

    </div>


</div>

<?php
include('footer.php')
?>