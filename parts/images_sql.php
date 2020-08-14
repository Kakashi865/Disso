<?php

include "sql.php";
include "sql_functions.php";

// Creates the query to grab images from the database
$statement = $connection->prepare("SELECT * FROM images");

// Run the prepared statement above, against the mysql database, to grab the most recent images.
$statement->execute();

// Telling the mysql database that we want an associative array back when requesting for data
$statement->setFetchMode(PDO::FETCH_ASSOC);

// Tell the mysql database that we want to get all of the results from that query.
$images = $statement->fetchAll();

// Randomize the order of the images given.
shuffle($images);

?>
<script>
var list = [
<?php
    foreach ($images as $image) {
        ?>
            {
                "id": <?= $image['id'] ?>,
                "url": "<?= $image['image_url'] ?>"
            },
        <?php
    }
?>
]
</script>
<?php
