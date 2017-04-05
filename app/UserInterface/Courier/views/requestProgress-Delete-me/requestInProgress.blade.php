<div class="container" style="width: 90%">
  <!-- Processing Request -->
  <div class="panel panel-{{ $currentRequest->isInProgress() ? 'info' : 'danger' }}">
    <div class="panel-heading">
      <h3 class="panel-title">Transaction Details{{ $currentRequest->isInProgress() ? '' : ' - Cancelled' }}</h3>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-12  col-lg-12"> 
          <table class="table table-user-information">
            <tbody>
              <tr>
                <td>Transaction:</td>
                <td>{{ $currentRequest->getTypeName() }}</td>
              </tr>
              <tr>
                <td><b>Status:</b></td>
                <td>{{ $currentRequest->getStatusName() }}</td>
              </tr>
              @if( !empty($currentRequest->remarks))
                <tr class="info">
                  <td><b>Remarks:</b></td>
                  <td>{{ $currentRequest->remarks }}</td>
                </tr>
              @endif
              <tr>
                <td>Book/s Accession Number:</td>
                <td>
                  @foreach($currentRequest->getAccessionNumbers() as $accessionNumber)
                    {{ $accessionNumber }} <br>
                  @endforeach
                </td>
              </tr>
              <tr>
                <td>Loation of Delivery:</td>
                <td>{{ $currentRequest->address }}</td>
              </tr>
                <tr>
                <td>Location Notes:</td>
                <td>{{ $currentRequest->bookingSpecifics }}</td>
              </tr>
            </tbody>
          </table> 

          <!-- Trigger the cancel modal -->
          @if($currentRequest->isInProgress())
            @if($currentRequest->isDelivered())
              <!-- Dispay Confirm Button -->
              <form role="form" method="POST" action="{{ url('/courier/confirmDelivered') }}">
                {{ csrf_field() }}
                <input id="transactionId" name="transactionId" type="hidden" value={{ $currentRequest->id }} />
                <button type="submit" class="btn btn-success pull-right">Confirm</button> 
              </form>
            @else
              <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#cancelModal">Cancel Transaction</button> 
            @endif
          @else
            <!-- Dispay Confirm Button -->
            <form role="form" method="POST" action="{{ url('/courier/confirmFailed') }}">
              {{ csrf_field() }}
              <input id="transactionId" name="transactionId" type="hidden" value={{ $currentRequest->id }} />
              <button type="submit" class="btn btn-danger pull-right">Confirm</button> 
            </form>
          @endif
        </div>
      </div>
    </div>            
  </div>
</div>