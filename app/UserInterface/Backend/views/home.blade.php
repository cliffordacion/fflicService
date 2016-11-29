@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                <table id="example" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Request Id</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Request Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Request Id</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Request Date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($transactionRequests as $request)
                        {{ $request->isNew()}}
                        <tr {{ $request->isNew() ? 'class=new_Requests': '' }}>
                            <td>{{ $request->id }}</td>
                            <td>{{ $request->frontendUser->name }}</td>
                            <td>{{ $request->getTypeName() }}</td>
                            <td>{{ $request->getStatusName() }}</td>
                            <td>{{ $request->created_at }}</td>
                            <td>
                                <a href="{{ url('/backend/requests/' . $request->id ) }}" class="btn btn-info" role="button">Details</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <style>
        .new_Requests {
            background-color: #CCFFFF !important;
        }
    </style>
@endsection
