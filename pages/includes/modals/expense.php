<!-- Register Modal -->
<div class="modal fade" id="expense" tabindex="-1" role="dialog">
  <div class="modal-dialog" style="width: 700px" role="document">
    <div class="modal-content">
      <div class="modal-header px-5">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Register new Expense</h4>
      </div>
      <div class="modal-body px-5">
        <form action="includes/actions.php" method="post">
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="name">Title</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="method">Payment Method</label>
                    <select name="method" id="method" class="form-control" required>
                        <option>Cash</option>
                        <option>Bank</option>
                        <option>Cheque</option>
                        <option>Mobile Bank</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="amount">Amount</label>
                    <input type="text" name="amount" id="amount" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control">
                </div>
                <div class="col-md-8">
                    <label for="remark">Remark</label>
                    <textarea name="remark" id="remark" class="form-control"></textarea>
                </div>
            </div>
      </div>
      <div class="modal-footer px-5">
        <input type="hidden" name="hidden-id">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="save-expense-btn">
            <i class="glyphicon glyphicon-ok"></i> Save
        </button>
        </form>
      </div>
    </div>
  </div>
</div>