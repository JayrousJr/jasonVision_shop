<div class="modal fade" id="sales" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header px-5">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update Sales Record</h4>
      </div>
      <div class="modal-body px-5">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
          <div class="form-group row">
            <div class="col-md-6">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="col-md-6">
              <label for="type">Type</label>
              <select name="type" class="form-control" id="type">
                <option value="cash">Cash Sales</option>
                <option value="credit">Credit Sales</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-6">
              <label for="quantity">Quantity</label>
              <input type="number" name="quantity" id="quantity" class="form-control">
            </div>
            <div class="col-md-6">
              <label for="price">Price</label>
              <input type="number" name="price" id="price" class="form-control">
            </div>
          </div>
      </div>
      <div class="modal-footer px-5">
        <input type="hidden" name="hidden-id">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="update_sale">
            <i class="glyphicon glyphicon-ok"></i> Update
        </button>
        </form>
      </div>
    </div>
  </div>
</div>