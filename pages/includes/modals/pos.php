<div class="modal fade" id="sellModal">
  <div class="modal-dialog" style="width: 400px;">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="text-center">Add Items To Pending List</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <form action="">
              <div class="form-group">
                <label for="">Item Name</label>
                <input type="text" id="pname" class="form-control" disabled>
              </div>
              <div class="form-group">
                <label for="">Quantity</label>
                <input type="number" class="form-control" id="qty" onkeyup="add()" autocomplete="off">
              </div>
              <div class="form-group">
                <label for="">Total</label>
                <input type="text" class="form-control" id="price" disabled>
              </div>
              <input type="hidden" id="editRowID">
              <input type="hidden" id="actualPrice">
              <button type="button" class="btn btn-primary" onclick="save()">Save</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="msg" style="display: none;"></div>
      </div>
    </div>
  </div>
</div>