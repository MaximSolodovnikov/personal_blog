<?php require("header.php"); ?>

<br /><br/><br /><form class="form-horizontal" action="?act=do-login" method="POST">
  <div class="control-group">
    <label class="control-label" for="inputEmail">Login</label>
    <div class="controls">
      <input type="text" name="login" id="inputEmail" placeholder="Login">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Password</label>
    <div class="controls">
      <input type="password" name="password" id="inputPassword" placeholder="Password">
    </div>
  </div><br />
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Login</button>
    </div>
  </div>
</form>


<?php require("footer.php"); ?>