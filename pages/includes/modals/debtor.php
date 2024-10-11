<!-- Register Modal -->
<div class="modal fade" id="debtor" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header px-5">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Register new debtor</h4>
      </div>
      <div class="modal-body px-5">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
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
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="country">Country</label>
                    <input type="text" name="country" id="country" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="amount">Amount</label>
                    <input type="number" name="amount" id="amount" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="codate">Compliance Date</label>
                    <input type="date" name="codate" id="codate" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="exdate">End Date</label>
                    <input type="date" name="exdate" id="exdate" class="form-control">
                </div>
            </div>
      </div>
      <div class="modal-footer px-5">
        <input type="hidden" name="hidden-id">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="save-debtor-btn">
            <i class="glyphicon glyphicon-ok"></i> Save
        </button>
        </form>
      </div>
    </div>
  </div>
</div>