<div class="modal fade" id="license" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header px-5">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add License</h4>
      </div>
      <div class="modal-body px-5">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="due-date">Due Date</label>
                    <input type="date" name="due-date" id="due-date" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="exp-date">Expired Date</label>
                    <input type="date" name="exp-date" id="exp-date" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="amount">Amount</label>
                    <input type="number" id="amount" name="amount" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        <option value="" hidden>Choose</option>
                        <option>Laboratory</option>
                    </select>
                </div>
            </div>
      </div>
      <div class="modal-footer px-5">
        <input type="hidden" name="hidden-id">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="save-license-btn">
            <i class="glyphicon glyphicon-ok"></i> Save
        </button>
        </form>
      </div>
    </div>
  </div>
</div>