<div class="modal fade" id="salary" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header px-5">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Salary</h4>
      </div>
      <div class="modal-body px-5">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" id="fname" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="mname">Middle Name</label>
                    <input type="text" name="mname" id="mname" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" id="lname" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="position">Position</label>
                    <select name="position" id="position" class="form-control">
                        <option value="" hidden>Choose</option>
                        <option>Accountant</option>
                        <option>Manager</option>
                        <option>Marketing</option>
                        <option>Watch Men</option>
                        <option>Cleaner</option>
                        <option>Worker</option>
                        <option>Human Resource</option>
                        <option>Store Keeper</option>
                        <option>Secretary</option>
                        <option>Stock Manager</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="salary">Salary</label>
                    <input type="number" id="g-salary" name="salary" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control">
                </div>
            </div>
      </div>
      <div class="modal-footer px-5">
        <input type="hidden" name="hidden-id">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="save-salary-btn">
            <i class="glyphicon glyphicon-ok"></i> Register
        </button>
        </form>
      </div>
    </div>
  </div>
</div>