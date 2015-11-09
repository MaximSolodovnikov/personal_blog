<?php require("header.php"); ?>

<h3><?= $ENTRY['title']; ?></h3>
<p><?= $ENTRY['text']; ?></p>

<h3>Комментарии</h3>

<?php foreach($comments as $row): ?>

<p class="text"><?= $row['text']; ?></p>
<div class="comments">
	<span class="author"><?= $row['author'];?></span>
	<span class="date"><?= $row['date'];?></span>
</div>

<?php endforeach; ?>

<h3>Добавить новый комментарий</h3>

<form class="form-horizontal" action="?act=do-new-comment" method="POST">
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
      <button type="submit" class="btn">Post</button>
    </div>
  </div>
</form>

<?php require("footer.php"); ?>