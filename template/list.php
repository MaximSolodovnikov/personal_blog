<?php require("header.php"); ?>

<?php foreach($records as $row): ?>

<h3><a href="?act=view-entry&id=<?= $row['id'];?>"><?= $row['title']; ?></a></h3>
<p class="text"><?= $row['text']; ?></p>
<div class="comments">
	<span class="author"><?= $row['author'];?></span>
	<span class="date"><?= $row['date'];?></span>
	<a href="?act=view-entry&id=<?= $row['id'];?>">Comments</a>
</div>

<?php endforeach; ?>		

<?php require("footer.php"); ?>