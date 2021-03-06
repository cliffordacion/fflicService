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
  <div class="panel panel-{{ $transactionRequest->isInProgress() ? 'primary' : 'danger' }}">
    <div class="panel-heading">
      <h3 class="panel-title">Transaction Details{{ $transactionRequest->isInProgress() ? '' : ' - Cancelled' }}</h3>
    </div>
    <div class="panel-body">

<div class="panel panel-default">
  <!-- <div class="panel-heading">Panel heading without title</div> -->
  <div class="panel-body">
    <h4><b>Client Information</b></h4>
    <div class="row">
        <div class="col-md-8  col-lg-8"> 
            <table class="table table-user-information">
              <tbody>
                <tr>
                  <td>Name:</td>
                  <td>{{ $transactionRequest->frontendUser->name}}</td>
                </tr>
                <tr>
                  <td>Student Number:</td>
                  <td>{{ $transactionRequest->frontendUser->id }}</td>
                </tr>
                <tr>
                  <td>Email Address:</td>
                  <td>{{ $transactionRequest->frontendUser->email }}</td>
                </tr>
                <tr>
                  <td>Mobile Number:</td>
                  <td>{{ $transactionRequest->frontendUser->mobileNumber }}</td>
                </tr>
                <tr>
                  <td>Course:</td>
                  <td>{{ $transactionRequest->frontendUser->course }}</td>
                </tr>
                <tr>
                  <td>College:</td>
                  <td>{{ $transactionRequest->frontendUser->college }}</td>
                </tr>
              </tbody>
            </table> 
        </div>
            <div class="col-md-4  col-lg-4" align='center'>
                <img src="{{ url($transactionRequest->frontendUser->id_image_front) }}" alt="Id" style="width:304px;height:228px; ">
                <h4>ID Image:</h4>
            </div>
            <div class="col-md-4  col-lg-4 pull-right" align='center'>
                <img src="{{ url($transactionRequest->frontendUser->id_image_front) }}" alt="Id" style="width:304px;height:228px; ">
                <h4>ID Image:</h4>
            </div>
    </div>
  </div>
</div>



        <div class="panel panel-default">
            <div class="panel-body">
                <h4><b>Request Information</b></h4>
                <div class="row">
                    <div class="col-md-12  col-lg-12"> 
                        <table class="table table-user-information">
                          <tbody>
                            <tr>
                              <td>Transaction:</td>
                              <td>{{ $transactionRequest->getTypeName() }}</td>
                            </tr>
                            <tr>
                              <td><b>Status:</b></td>
                              <td>{{ $transactionRequest->getStatusName() }}</td>
                            </tr>
                            @if( !empty($transactionRequest->remarks))
                              <tr>
                                <td><b>Remarks:</b></td>
                                <td>{{ $transactionRequest->remarks }}</td>
                              </tr>
                            @endif
                            <tr>
                              <td>Book/s Accession Number:</td>
                              <td>
                                @foreach($transactionRequest->getAccessionNumbers() as $accessionNumber)
                                  {{ $accessionNumber }} <br>
                                @endforeach
                              </td>
                            </tr>
                            <tr>
                              <td>Loation of Delivery:</td>
                              <td>{{ $transactionRequest->address }}</td>
                            </tr>
                              <tr>
                              <td>Location Notes:</td>
                              <td>{{ $transactionRequest->bookingSpecifics }}</td>
                            </tr>
                          </tbody>
                        </table> 
                    </div>
                </div>
            </div>
        </div>
              <!-- Trigger the cancel modal -->
              @if($transactionRequest->isInProgress())
                @if($transactionRequest->isDelivered())
                  <!-- Dispay Confirm Button -->
                  <form role="form" method="POST" action="{{ url('/frontend/confirmDelivered') }}">
                    {{ csrf_field() }}
                    <div class="pull-right" style="width:100%; padding:10px">
                      <div style="width: 100%; text-align: center;"><b>Rate Us!</b></div>
                      <input id="rating-system" name="userRating" type="number" class="rating" data-container-class='text-center' min="0" max="5" step=".5" data-size="xs">
                    </div>
                    <div class="pull-right">
                      <input id="transactionId" name="transactionId" type="hidden" value={{ $transactionRequest->id }} />
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
                      <input id="transactionId" name="transactionId" type="hidden" value={{ $transactionRequest->id }} />
                      <button type="submit" class="btn btn-danger pull-right">Confirm</button> 
                    </div>
                </form>
              @endif
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
              <input id="transactionId" name="transactionId" type="hidden" value="{{ $transactionRequest->id }}" />
              @if($transactionRequest->isInTransit())
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