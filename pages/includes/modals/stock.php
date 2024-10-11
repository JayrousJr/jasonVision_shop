<!-- Register Modal -->
<div class="modal fade" id="stock" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header px-5">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Register new stock</h4>
      </div>
      <div class="modal-body px-5">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="form-group row">
            <div class="col-md-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="batch">Batch No.</label>
                <input type="text" name="batch" id="batch" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="qty">Quantity</label>
                <input type="number" name="qty" id="qty" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="cost">Buying Price</label>
                <input type="number" name="cost" id="cost" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="price">Selling Price</label>
                <input type="number" name="price" id="price" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="supplier">Supplier Name</label>
                <input type="text" name="supplier" id="supplier" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="phone">Supplier Phone</label>
                <input type="text" name="phone" id="phone" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="manufact">Manufacturer</label>
                <input type="text" name="manufact" id="manufact" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="man-date">Manufacture Date</label>
                <input type="date" name="man-date" id="man-date" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="en-date">Entry Date</label>
                <input type="date" name="en-date" id="en-date" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="ex-date">Expire Date</label>
                <input type="date" name="ex-date" id="ex-date" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-3">
                <label for="shop">Shop</label>
                <select name="shop" id="shop-id" class="form-control" <?=$perms->is_admin() ? '':'disabled' ?>>
                    <?php if ($shops): ?>
                        <?php foreach ($shops as $shop): ?>
                            <option value="<?= $shop->id ?>" <?= ($shop->id == $db->get_user_shop()) ? 'selected' : '' ?>>
                                <?= $shop->address ?>
                            </option>
                        <?php endforeach ?>
                    <?php endif ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="country">Supplier Country</label>
                <input type="text" name="country" id="country" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="remark">Remark</label>
                <textarea name="remark" id="remark" class="form-control"></textarea>
            </div>
        </div>
      </div>
      <div class="modal-footer px-5">
        <input type="hidden" name="hidden-id">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="save-stock-btn">
            <i class="glyphicon glyphicon-ok"></i> Register
        </button>
        </form>
      </div>
    </div>
  </div>
</div>