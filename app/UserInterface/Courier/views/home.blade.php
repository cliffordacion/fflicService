@extends('layouts.post_login')


@section('css')
    <link href="{{ url('/courier_public/css/googleMaps.css') }}" rel="stylesheet">
@endsection


@section('scripts')
    <script src="{{ url('/courier_public/js/googleMaps.js') }}"></script>
    <script src="{{ url('/courier_public/js/dynamicForm.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_Su-SVied1FsCZI9vBCM02EAUypFiDaY&libraries=places&callback=init"
         async defer></script>
@endsection


@section('content')
<!--  -->
    <style type="text/css">
        .container
        {
          width: auto;
        }
        .entry:not(:first-of-type)
        {
            margin-top: 10px;
        }

        .glyphicon
        {
            font-size: 12px;
        }

        #requestTab {
          margin-top:3%;
          width: auto;
        }

        #requestTab .nav-tabs > li > a {
            border-radius: 4px 4px 0 0 ;
        }

        #requestTab .tab-content {
          padding : 5px;
        }
    </style>
<!-- Page Heading -->
<div class="row"  style="padding-top: 60px">
    <div class="col-lg-12">
        <h1 class="page-header">
            On Going Delivery
        </h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Area Chart</h3>
            </div>
            <div class="panel-body">
                <div class="container">
                    <div class="row">
                        <div class="">
                            <div class="panel panel-default">
                                <!-- <div class="panel-heading"> -->
                              <div id="requestTab" class="container"> 
                                    <div class="tab-content clearfix">
                                      <div class="tab-pane active" id="loanTab">

                                              
                                                  @if (count($errors) > 0)
                                                      <div class="alert alert-danger">
                                                          <ul>
                                                              @foreach ($errors->all() as $error)
                                                                  <li>{{ $error }}</li>
                                                              @endforeach
                                                          </ul>
                                                      </div>
                                                  @endif

                                                  <form class="form-horizontal" role="form" method="POST" action="{{ url('/courier/loan') }}">
                                                      {{ csrf_field() }}
                                                      
                                                      <label for="usr">Accession Number:</label>
                                                      <small><br><i>Click <a href="http://ilib.upd.edu.ph" target="_blank">here</a> to check book accession number</i></small>
                                                      
                                                      <div class="dynamicArea" style="padding-bottom: 5px">
                                                        @if(Session::has('_old_input'))
                                                          <?php $oldInput = Session::get('_old_input', 'default') ?>
                                                          @foreach($oldInput['accessionNumber'] as $key => $oldAccessionNumber)
                                                            <div class="entry input-group col-xs-12">
                                                                <input class="form-control" name="accessionNumber[]" type="text" placeholder="Accession Number" value="{{ $oldAccessionNumber }}" maxlength="100" required/>
                                                              <span class="input-group-btn">
                                                                    @if($key >= (count($oldInput['accessionNumber']) -1) )
                                                                      <button class="btn btn-success btn-add" type="button">
                                                                          <span class="glyphicon glyphicon-plus"></span>
                                                                      </button>
                                                                    @else
                                                                      <button class="btn btn-remove btn-danger" type="button">
                                                                          <span class="glyphicon glyphicon-minus"></span>
                                                                      </button>
                                                                    @endif
                                                                </span>
                                                            </div>
                                                          @endforeach
                                                        @else
                                                          <div class="entry input-group col-xs-12">
                                                              <input class="form-control" name="accessionNumber[]" type="text" placeholder="Accession Number" maxlength="100" required/>
                                                            <span class="input-group-btn">
                                                                  <button class="btn btn-success btn-add" type="button">
                                                                      <span class="glyphicon glyphicon-plus"></span>
                                                                  </button>
                                                              </span>
                                                          </div>
                                                        @endif
                                                      </div>                    

                                                    <input name="bookingAddress" id="bookingAddress" class="controls" type="text" placeholder="Search Box" style="margin: 5px; width:90%;" value="{{ old('bookingAddress') }}" required/>
                                                    <div id="map"></div>

                                                    <br>
                                                    <div class="form-group" style="margin: 2px">
                                                      <label for="usr">Location Notes:</label>
                                                      <small><br>(Office name/ room number/ floor number/ etc.)</small>
                                                      <textarea class="form-control" name="bookingSpecifics" required>{{old('bookingSpecifics')}}</textarea>
                                                    </div>
                                                    <input id="lat" name="lat" type="hidden"/>
                                                    <input id="lng" name="lng" type="hidden"/>
                                                    <div class="pull-right" style="padding:5px;">
                                                        <input type="submit" class="pull-right btn btn-primary">
                                                    </div>
                                                  </form>
                                              
                                      </div>
                                      <div class="tab-pane" id="returnTab">
                                        <h3>We use the class nav-pills instead of nav-tabs which automatically creates a background color for the tab</h3>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
@endsection

