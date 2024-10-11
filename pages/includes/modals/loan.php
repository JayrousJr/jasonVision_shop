<div class="modal fade" id="loan" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header px-5">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Loan</h4>
      </div>
      <div class="modal-body px-5">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group row">
                <div class="col-md-4">
                  <label for="date">Recording Date</label>
                  <input type="date" name="date" id="date" class="form-control">
                </div>
                <div class="col-md-4">
                  <label for="due-date">Due Date</label>
                  <input type="date" name="due-date" id="due-date" class="form-control">
                </div>
                <div class="col-md-4">
                  <label for="exp-date">Expired Date</label>
                  <input type="date" name="exp-date" id="exp-date" class="form-control">
                </div>
            </div>
            <div class="form-group row">
              <div class="col-md-8">
                <label for="name">Name/Organization name</label>
                <input type="text" name="name" id="name" class="form-control">
              </div>
              <div class="col-md-4">
                <label for="amount">Amount</label>
                <input type="number" id="amount" name="amount" class="form-control">
              </div>
            </div>
      </div>
      <div class="modal-footer px-5">
        <input type="hidden" name="hidden-id">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="save-loan-btn">
            <i class="glyphicon glyphicon-ok"></i> Save
        </button>
        </form>
      </div>
    </div>
  </div>
</div>