@extends('layouts.app')

@section('css')
    <link href="{{ url('/frontend_public/css/userProfile.css') }}" rel="stylesheet">
@endsection

@section('content')
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1" >
          
            <div class="panel panel-warning">
              <div class="panel-heading">
                <h3 class="panel-title">Update User Profile</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                   <div class=" col-md-9 col-lg-12 "> 
                    <table class="table table-user-information">

                      <div class="col-md-12 col-lg-12 col-md-offset-3 col-lg-offset-3" align="center" style="padding: 10px">

                        <div class="col-md-3 col-lg-3 " align="center" style=""> 
                          <form class="form-horizontal" role="form" method="POST" action="{{ url('/frontend/profile/saveId') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div>ID Front Image:</div>
                            <img alt="User Pic" src="{{ url($user->id_image_front) }}" class="img-responsive" style="width:304px;height:228px;"> 
                            <div style="margin: 5px"><input type="file" name="idFrontImageFile" id="idFrontImageFile" style="float: left;"></div>
                            <div style="margin: 5px"><input type="submit" value="Upload Image" name="submit" style="float: left;" ></div>
                          </form>
                        </div>


                        <div class="col-md-3 col-lg-3 " align="center"> 
                          <form class="form-horizontal" role="form" method="POST" action="{{ url('/frontend/profile/saveId') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div>ID Back Image:</div>
                            <img alt="User Pic" src="{{ url($user->id_image_back) }}" class="img-responsive" style="width:304px;height:228px;"> 
                            <div style="margin: 5px"><input type="file" name="idBackImageFile" id="idBackImageFile" style="float: left;"></div>
                            <div style="margin: 5px"><input type="submit" value="Upload Image" name="submit" style="float: left;" ></div>
                          </form>
                        </div>
                      </div>
                      <div style="margin-top:50px"><h3>Profile<hr><h3></div>

                      <form class="form-horizontal" role="form" method="POST" action="{{ url('/frontend/profile/save') }}">
                        {{ csrf_field() }}

                      <tbody>
                        <tr>
                          <td>Name:</td>
                          <td>
                            <input type="text" class="form-control" value="{{ $user->name }}">
                          </td>
                        </tr>
                        <tr>
                          <td>Student Number:</td>
                          <td>
                            {{ $user->id }}
                            <input type="hidden" class="form-control" value="{{ $user->id }}">
                          </td>
                        </tr>
                        <tr>
                          <td>Email Address:</td>
                          <td>
                            <input type="email" class="form-control" value="{{ $user->email }}">
                          </td>
                        </tr>
                        <tr>
                          <td>Course:</td>
                          <td>
                            <input type="text" class="form-control" value="{{ $user->course }}">
                          </td>
                        </tr>
                          <tr>
                          <td>College</td>
                          <td>
                            <input type="text" class="form-control" value="{{ $user->college }}">
                          </td>
                        </tr>
                          <td>Mobile Number</td>
                          <td>
                            <input type="number" class="form-control" value="{{ $user->mobileNumber }}">
                          </td>
                             
                        </tr>
                       
                      </tbody>
                    </table>
                  </div>
                 
                </div>
              </div>
                   <div class="panel-footer">
                      <div align="right">
                          <a href="{{ url('/frontend/profile') }}" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove-sign"></i> Cancel</a>
                          <button type="submit" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-save"></i> Save</button>
                      </div>   
                  </div>
              
            </div> <!-- End Panel-->
          </form>
        </div>
      </div>
@endsection