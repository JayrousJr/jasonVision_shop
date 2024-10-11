<div class="modal fade" id="staff" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header px-5">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Register new Staff</h4>
      </div>
      <div class="modal-body px-5">
        <form action="includes/actions.php" method="post">
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" id="fname" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" id="lname" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" class="form-control" required>
                        <option value="" hidden>Choose</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="role">Position/Role</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="" hidden>Choose</option>
                        <option value="accountant">Accountant</option>
                        <option value="manager">Manager</option>
                        <option value="marketing">Marketing</option>
                        <option>Watch Men</option>
                        <option>Cleaner</option>
                        <option>Worker</option>
                        <option>Human Resource</option>
                        <option>Store Keeper</option>
                        <option>Secretary</option>
                        <option>Stock Manager</option>
                    </select>
                </div>
            </div>
      </div>
      <div class="modal-footer px-5">
        <input type="hidden" name="hidden-id">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="save-staff-btn">
            <i class="glyphicon glyphicon-ok"></i> Register
        </button>
        </form>
      </div>
    </div>
  </div>
</div>