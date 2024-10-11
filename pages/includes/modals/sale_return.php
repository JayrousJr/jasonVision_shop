<div class="modal fade" id="sale-return" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header px-5">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Sales Return</h4>
      </div>
      <div class="modal-body px-5">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="particular">Particular</label>
                    <input type="text" name="particular" id="particular" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="note-no">Debit Note Number</label>
                    <input type="text" name="note-no" id="note-no" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="status">Details</label>
                    <select name="status" id="status" class="form-control">
                        <option value="" hidden>Choose</option>
                        <option>Blocked</option>
                        <option>Expired</option>
                        <option>Excess</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="qty">LF/Quantities</label>
                    <input type="number" id="qty" name="qty" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="amount">Amount</label>
                    <input type="number" name="amount" id="amount" class="form-control">
                </div>
            </div>
      </div>
      <div class="modal-footer px-5">
        <input type="hidden" name="hidden-id">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="save-return-btn">
            <i class="glyphicon glyphicon-ok"></i> Save
        </button>
        </form>
      </div>
    </div>
  </div>
</div>