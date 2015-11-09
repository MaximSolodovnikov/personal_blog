<?php require("header.php"); ?>

<?php foreach($records as $row): ?>

<h3><a href="?act=view-entry&id=<?= $row['id'];?>"><?= $row['title']; ?></a></h3>
<p class="text"><?= $row['text']; ?></p>
<div class="comments">
	<span class="author"><?= $row['author']; ?></span>
	<span class="date"><?= $row['date']; ?></span>
	<a href="?act=view-entry&id=<?= $row['id']; ?>"><?= $row['comments']; ?>Comments</a>
</div>

<?php endforeach; ?>	

<!-- -------------Output of pagination---------------------- -->
<div class="pages">
Pages:
<?php for ($i = 1; $i < $pages; $i++): ?>
	<?php if ($i == $page): ?> <b><?= $i; ?></b>
	<?php else : ?> <a href="?page=<?= $i; ?>"><?= $i; ?></a>
	<?php endif; ?>
<?php endfor; ?>
</div>

<?php if (IS_ADMIN): ?>

<h3>Добавить новую статью</h3>

<form class="form-horizontal" action="?act=do-new-entry" method="POST">
  <div class="control-group">
    <label class="control-label" for="inputEmail">Title</label>
    <div class="controls">
      <input type="text" name="title" id="inputEmail" placeholder="Title">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Author</label>
    <div class="controls">
      <input type="text" name="author" id="inputPassword" placeholder="Author">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Text</label>
    <div class="controls">
      <textarea name="text"></textarea>
    </div>
  </div><br />
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Add</button>
    </div>
  </div>
</form>

<?php endif; ?>	

<?php require("footer.php"); ?>