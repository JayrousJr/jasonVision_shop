<!-- Register Modal -->
<div class="modal fade" id="customer" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header px-5">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Register new Customer</h4>
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
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="remark">Remark</label>
                    <textarea name="remark" id="remark" class="form-control"></textarea>
                </div>
            </div>
      </div>
      <div class="modal-footer px-5">
        <input type="hidden" name="hidden-id">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="save-customer-btn">
            <i class="glyphicon glyphicon-ok"></i> Register
        </button>
        </form>
      </div>
    </div>
  </div>
</div>