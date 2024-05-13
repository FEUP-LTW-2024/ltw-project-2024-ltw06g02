<?php
   function printPurchasesSection($purchases){
?>

    <h1 class="admin-subtitle">Purchases</h1>
    <table>
        <tr>
            <th>Product</th>
            <th>Message</th>
            <th>Date</th>
        </tr>
        <?php
        if(empty($purchases)) {
            ?>
            <tr>
                <td colspan="3">No purchases available</td>
            </tr>
            <?php
        } else {
            foreach($purchases as $purchase) {
                ?>
                <tr>
                    <td><?= $purchase['productName']; ?></td>
                    <td><?= $purchase['notificationText']; ?></td>
                    <td><?= $purchase['notificationDate']; ?></td>
                </tr>
                <?php
            }
        }
        ?>

    </table>

<?php
   }
?>


<?php
   function printSalesSection($sales){
?>

    <h1 class="admin-subtitle">Sales</h1>
    <table>
        <tr>
            <th>Product</th>
            <th>Message</th>
            <th>Date</th>
        </tr>
        <?php
            if(empty($sales)) {
                ?>
                <tr>
                    <td colspan="3">No sales available</td>
                </tr>
                <?php
            } else {
                foreach($sales as $sale){
                    ?>
                    <tr>
                        <td><?= $sale['productName']; ?></td>
                        <td><?= $sale['notificationText']; ?></td>
                        <td><?= $sale['notificationDate']; ?></td>
                    </tr>
                    <?php
                }
            }
        ?>
    </table>

<?php
   }
?>