<?php

require_once 'autoloader.php';

$pagination = new pagination();
$pagination->init();

$pagination->page;

$sql = "SELECT * FROM guestbook ORDER BY id DESC LIMIT $pagination->start, $pagination->records_per_page";
$query = DB::getInstance()->handler()->query($sql);

while ($r = $query->fetch(PDO::FETCH_ASSOC)):
?>

<div class='block'>
<div>name : <?php echo $r['name']; ?></div>
<div>email : <?php echo $r['email']; ?></div>
<div>message : <?php echo $r['message']; ?></div>
<div>posted : <?php echo $r['posted']; ?></div>
</div><br>

<?php
endwhile;

$pagination->filename = 'posts.php';
$pagination->createLinks();

?>
</div>

<script src="js/jquery.js"></script>
<script src="js/main.js"></script>