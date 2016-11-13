<h1>This is wrong!!!</h1>


<div class="container" style="width: 90%">
  <!-- Failed/Cancelled Request -->
  <div class="panel panel-danger">
    <div class="panel-heading">
      <h3 class="panel-title">Transaction Details - Cancelled</h3>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class=" col-md-9 col-lg-9 "> 
          <table class="table table-user-information">
            <tbody>
              <tr>
                <td>Transaction:</td>
                <td>Loan</td>
              </tr>
              <tr>
                <td>Status</td>
                <td>Failed Validation</td>
              </tr>
              <tr>
                <td>Remarks</td>
                <td>The book is not available</td>
              </tr>

              <tr>
                <td>Book/s Transaction Number:</td>
                <td>
                  Book1
                  <br>
                  Book2
                  <br>
                  Book3
                </td>
              </tr>
              <tr>
                <td>Loation of Delivery:</td>
                <td>#172 Long Addres goes here, and must be at least long enought, to be called an adderess </td>
              </tr>
                <tr>
                <td>Location Notes:</td>
                <td>Room 4332</td>
              </tr>                     
            </tbody>
          </table> 

          <!-- Trigger the cancel modal -->
          <form role="form" method="POST" action="{{ url('/frontend/confirmFailed') }}">
            {{ csrf_field() }}
            <input id="transactionId" name="transactionId" type="hidden" value="2" />
            <button type="submit" class="btn btn-danger pull-right">Confirm</button> 
          </form>
        </div>
      </div>
    </div>            
  </div>
</div>
