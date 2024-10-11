<!-- Register Modal -->
<div class="modal fade" id="asset" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header px-5">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Register new asset</h4>
      </div>
      <div class="modal-body px-5">
        <form action="includes/actions.php" method="post">
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="code">Code</label>
                    <input type="text" name="code" id="code" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="location">Location/Department</label>
                    <input type="text" name="location" id="location" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="category">Category</label>
                    <select name="category" class="form-control" id="category">
                        <option hidden>Choose</option>
                        <option>Furniture</option>
                        <option>Machinery</option>
                        <option>Building</option>
                        <option>Equipment</option>
                        <option>Office Suppliers</option>
                        <option>Land</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="date">Purchased Date</label>
                    <input type="date" name="date" id="date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="price">Current Price</label>
                    <input type="number" name="price" id="price" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="remark">Description</label>
                <textarea name="remark" id="remark" class="form-control"></textarea>
            </div>
      </div>
      <div class="modal-footer px-5">
        <input type="hidden" name="hidden-id">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="save-asset-btn">
            <i class="glyphicon glyphicon-ok"></i> Register
        </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- DISPOSE ASSETS -->
<div class="modal fade" id="dispose" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header px-5">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Dispose Asset</h4>
      </div>
      <div class="modal-body px-5">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="disp-price">Disposed Price</label>
                    <input type="number" name="disp-price" id="disp-price" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="disp-date">Date</label>
                    <input type="date" name="date" id="disp-date" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="disp-remark">Description</label>
                <textarea name="remark" id="disp-remark" class="form-control"></textarea>
                <input type="hidden" name="asset_id" value="">
            </div>
      </div>
      <div class="modal-footer px-5">
        <input type="hidden" name="hidden-id">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="save-disposal-btn">
            <i class="glyphicon glyphicon-ok"></i> Save
        </button>
        </form>
      </div>
    </div>
  </div>
</div>