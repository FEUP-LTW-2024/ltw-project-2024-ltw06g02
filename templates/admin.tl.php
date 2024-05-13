<?php
   require_once('database/user.php');
   function printAdminSection(){
?>

    <h1 class="admin-title">Welcome, Administrator!</h1>
    
    <h2 class="admin-subtitle">Elevate a User to Admin Status</h2>
    <form id="elevateUserForm" action="../actions/elevate_user.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <button type="submit">Elevate to Admin</button>
    </form>

    <h2 class="admin-subtitle">Introduce New Item Categories, Sizes and Conditions</h2>
    <form id="addNewCategoryForm" action="../actions/add_category.php" method="POST">
        <input type="text" id="category" name="category" required>
        <button type="submit">Add Category</button>
    </form>
    <form id="addNewSizeForm" action="../actions/add_size.php" method="POST">
        <input type="text" id="size" name="size" required>
        <button type="submit">Add Size</button>
    </form>
    <form id="addNewConditionForm" action="../actions/add_condition.php" method="POST">
        <input type="text" id="condition" name="condition" required>
        <button type="submit">Add Condition</button>
    </form>

    <h2 class="admin-subtitle">Users registered</h2>
    <table>
        <tr>
            <th>UserID</th>
            <th>Username</th>
        </tr>
        <?php
            $usersRegistered = getAllUsersRegistered();
            foreach($usersRegistered as $user){
            ?>
            <tr>
                <td><?= $user['userID']; ?></td>
                <td><?= $user['username']; ?></td>
            </tr>
            <?php
            }
        ?>
    </table>
    <?php
      
   }
?>