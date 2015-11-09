<?php require("header.php"); ?>

<h3><?= $row['title']; ?></h3>
<p><?= $row['text']; ?></p>
<div class="comments"><a href="?act=view=entry&id=<?= $row['id'];?>">Comments</a></div>

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
      <button type="submit" class="btn">Post</button>
    </div>
  </div>
</form>

<?php endif; ?>

<?php require("footer.php"); ?>