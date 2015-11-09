<?php require("header.php"); ?>

<h3><?= $row['title']; ?></h3>
<p><?= $row['text']; ?></p>
<div class="comments"><a href="?act=view=entry&id=<?= $row['id'];?>">Comments</a></div>

<?php require("footer.php"); ?>