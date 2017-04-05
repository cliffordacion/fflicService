@extends('layouts.app')

@section('css')
    <link href="{{ url('/courier_public/css/userProfile.css') }}" rel="stylesheet">
@endsection

@section('content')
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1" >
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">User Profile</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                 <div class=" col-md-9 col-lg-12 "> 
                  <table class="table table-user-information">

                    <div class="col-md-12 col-lg-12 col-md-offset-3 col-lg-offset-3" align="center" style="">
                      <div class="col-md-3 col-lg-3 " align="center"> 
                        <div>ID Front Image:</div>
                        <img alt="User Pic" src="{{ url($user->id_image_front) }}" class="img-responsive" style="width:304px;height:228px;"> 
                      </div>
                      <div class="col-md-3 col-lg-3 " align="center"> 
                        <div>ID Back Image:</div>
                        <img alt="User Pic" src="{{ url($user->id_image_back) }}" class="img-responsive" style="width:304px;height:228px;"> 
                      </div>
                    </div>

                    <div style="padding-top:20px"><h3>Profile<hr><h3></div>
                    
                    <tbody>
                      <tr>
                        <td>Name:</td>
                        <td>{{ $user->name }}</td>
                      </tr>
                      <tr>
                        <td>Student Number:</td>
                        <td>{{ $user->id }}</td>
                      </tr>
                      <tr>
                        <td>Email Address:</td>
                        <td>{{ $user->email }}</td>
                      </tr>
                      <tr>
                        <td>Course:</td>
                        <td>{{ $user->course }}</td>
                      </tr>
                        <tr>
                        <td>College</td>
                        <td>{{ $user->college }}</td>
                      </tr>
                        <td>Mobile Number</td>
                        <td>{{ $user->mobileNumber }}
                        </td>
                           
                      </tr>
                     
                    </tbody>
                  </table>
                </div>               
              </div>
            </div>
                 <div class="panel-footer">
                    <div align="right">
                        <a href="{{ url('/courier/profile/update') }}" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                    </div>   
                </div>
            
          </div>
        </div>
      </div>
@endsection