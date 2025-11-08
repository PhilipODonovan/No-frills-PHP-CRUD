<?php
function escape($data)
{
    $data = htmlspecialchars($data, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
    $data = trim($data);
    $data = stripslashes($data);
    return ($data);
}

function listtable($table, $option='')
{
    try {

        require_once '../src/DBconnect.php';
        $sql = "SELECT * FROM $table";

        $statement = $connection->prepare($sql);

        $statement->execute();
        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
?>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email Address</th>
            <th>Age</th>
            <th>Location</th>
            <th>Date</th>
    <?php
    if (isset($option)){
        ?>
            <th><?php echo $option ?></th>
        <?php
    }

    ?>

        </tr>
        </thead>
        <tbody>
    <?php

    foreach ($result as $row) : ?>
        <tr>
            <td><?php echo escape($row["id"]); ?></td>
            <td><?php echo escape($row["firstname"]); ?></td>
            <td><?php echo escape($row["lastname"]); ?></td>
            <td><?php echo escape($row["email"]); ?></td>
            <td><?php echo escape($row["age"]); ?></td>
            <td><?php echo escape($row["location"]); ?></td>
            <td><?php echo escape($row["date"]); ?> </td>
            <?php
            if (isset($option)){
            ?>
            <td><a href=<?php echo $option?>.php?id=<?php echo escape($row["id"]);
                ?>><?php echo $option?></a></td>
        <?php
            }

        ?>
        </tr>
    <?php endforeach;
    ?>
        </tbody>
    </table>
<?php

}
?>