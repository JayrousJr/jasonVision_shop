<div class="modal fade" id="logout" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Log Out?</h5>
      </div>
      <div class="modal-body">Select "Logout" below to End Up the session.</div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-danger" href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- CHANGE PASSWORD MODAL -->
<div class="modal fade" id="changePwd">
  <div class="modal-dialog" style="width: 400px">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center">Change Your Password</h4>
      </div>
      <div class="modal-body">
        <form action="../includes/auth.php" method="post">
          <div class="form-group">
            <label for="">Old Password</label>
            <input type="password" class="form-control" name="current">
            <small class="with-msg" style='margin-top: 5px'></small>
          </div>
          <div class="form-group">
            <label for="">New Password</label>
            <input type="password" class="form-control" name="new" required>
          </div>
      </div>
      <div class="modal-footer">
          <input type="submit" name="change-password" class="btn btn-primary" value="Change Password">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>