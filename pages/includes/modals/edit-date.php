<div class="modal fade" id="edit-date" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header px-5">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Date</h4>
      </div>
      <div class="modal-body px-5">
        <form  method="post">
          <div class="form-group ">
            <label for="new-date">Enter new Date</label>
            <input type="date" name="new-date" id="new-date" class="form-control" required>
          </div>
      </div>
      <div class="modal-footer px-5">
        <input type="hidden" name="hidden-id">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="edit-date-btn">
            <i class="glyphicon glyphicon-ok"></i> Save
        </button>
        </form>
      </div>
    </div>
  </div>
</div>