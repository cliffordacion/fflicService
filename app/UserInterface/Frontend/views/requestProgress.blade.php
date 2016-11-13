@extends('layouts.app')


@section('css')
    <link href="{{ url('/frontend_public/css/googleMaps.css') }}" rel="stylesheet">
    <link href="{{ url('/frontend_public/css/star-rating.min.css') }}" media="all" rel="stylesheet" type="text/css" />
@endsection


@section('scripts')
    <script src="{{ url('/frontend_public/js/star-rating.min.js') }}" type="text/javascript"></script>
    <script src="{{ url('/frontend_public/js/custom-star-rating.js') }}" type="text/javascript"></script>
    <script src="{{ url('/frontend_public/js/googleMaps.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_Su-SVied1FsCZI9vBCM02EAUypFiDaY&libraries=places&callback=init"
         async defer></script>
@endsection


@section('content')
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
              <form role="form" method="POST" action="{{ url('/frontend/confirmDelivered') }}">
                {{ csrf_field() }}
                <div class="pull-right" style="width:100%; padding:10px">
                  <div style="width: 100%; text-align: center;"><b>Rate Us!</b></div>
                  <input id="rating-system" name="userRating" type="number" class="rating" data-container-class='text-center' min="0" max="5" step=".5" data-size="xs">
                </div>
                <div class="pull-right">
                  <input id="transactionId" name="transactionId" type="hidden" value={{ $currentRequest->id }} />
                  <button type="submit" class="btn btn-success pull-right">Confirm</button> 
                </div>
              </form>
            @else
              <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#cancelModal">Cancel Transaction</button> 
            @endif
          @else
            <!-- Dispay Confirm Button -->
            <form role="form" method="POST" action="{{ url('/frontend/confirmFailed') }}">
              {{ csrf_field() }}
                <div class="pull-right" style="width:100%; padding:10px">
                  <div style="width: 100%; text-align: center;"><b>Rate Us!</b></div>
                  <input id="rating-system" name="userRating" type="number" class="rating" data-container-class='text-center' min="0" max="5" step=".5" data-size="xs">
                </div>
                <div class="pull-right">
                  <input id="transactionId" name="transactionId" type="hidden" value={{ $currentRequest->id }} />
                  <button type="submit" class="btn btn-danger pull-right">Confirm</button> 
                </div>
            </form>
          @endif
        </div>
      </div>
    </div>            
  </div>
</div>
@endsection

<!-- Modal -->
<div id="cancelModal" class="modal fade in" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="color: red">&times;</button>
        <h4 class="modal-title">Cancel Transaction</h4>
      </div>
      <form role="form" method="POST" action="{{ url('/frontend/cancelTransaction') }}">
        {{ csrf_field() }}
        <div class="modal-body">
          <p>What is your reason for cancelling the current request?</p>

            <div class="form-group">
              <label for="sel1">Select one:</label>
              <div class="radio">
                <label><input type="radio" name="cancelReason" value="I cannot wait that long" required>I cannot wait that long</label>
              </div>
              <div class="radio">
                <label><input type="radio" name="cancelReason" value="I will go to the library myself">I will go to the library myself</label>
              </div>
              <div class="radio">
                <label><input type="radio" name="cancelReason" value="I already have the book">I already have the book</label>
              </div>
              <div class="radio">
                <label><input type="radio" name="cancelReason" value="Others">Others</label>
              </div>
            </div>

          <div class="alert alert-warning" role="alert"><small>Note: You cannot cancel a transaction in <b>TRANSIT STATUS</b>.</small></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info pull-right" data-dismiss="modal">Close</button>
          <div class="pull-right" style="width:50px; padding-right: 5px;">
              <input id="transactionId" name="transactionId" type="hidden" value="{{ $currentRequest->id }}" />
              @if($currentRequest->isInTransit())
                <button type="submit" class="btn btn-danger pull-right" disabled>Okay</button> 
              @else
                <button type="submit" class="btn btn-danger pull-right">Okay</button> 
              @endif
          </div>
        </div>
      </form>
    </div>
  </div>
</div>