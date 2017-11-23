
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request Room</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="/request">
          {{ csrf_field() }}
          <div class="form-group">
            Price:<span id="priceform"></span>USD<br>
            Taxes:<span id="taxform"></span>USD<br>
            Fees:<span id="feesform"></span>USD<br>
            Total:<span id="totalform"></span>USD<br>
          </div>
          <div class="form-group">
            <label for="name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="lastname" class="col-form-label">Last Name:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
          </div>
          <div class="form-group">
            <label for="email" class="col-form-label">Email:</label>
            <input type="text" class="form-control" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="creditcard" class="col-form-label">Credit Card Number:</label>
            <input type="text" class="form-control" id="creditcard" name="creditcard" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Request Room</button>
      </div>
    </div>
    </form>
  </div>
</div>
