@extends('layouts.app')

@section('breadcrumb')
<ol class="breadcrumb p-2">
	<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">Activity Logs</li>
</ol>
@endsection

@section('content')

<div class="container-fluid">
<div class="card">
 <div class="card-header pt-2 pb-2"><i class="fas fa-table"></i> Activity Logs</div>
 <div class="card-body">
    <div class="row">
        <!-- table -->
        <div class="col">
            <div class="table-responsive">
                <table id="activityLogs" class="table table-bordered table-hover table-sm display nowrap w-100">
                    <thead class="thead-light">
                        <tr>
                            <th data-priority="1">Date/Time</th>
                            <th data-priority="4">Title</th>
                            <th data-priority="3">Details</th>
                            <th data-priority="5">Office</th>
                            <th data-priority="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr>
                                <td>{{Carbon\Carbon::parse($log->created_at)->toDayDateTimeString()}}</td>
                                <td>{{$log->log_name}}</td>
                                <td>{{$log->description}}</td>
                                <td>{{$log->causer->office->office_code}}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" name="view_log" data-toggle="modal" data-target="#logModal" data-id="{{$log->id}}">View Log</button>
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

<!-- The Modal -->
<div class="modal" id="logModal">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">			
			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Activity Log Details</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
									
			<!-- Modal body -->
			<div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Log Date/Time:</label>
                        <input class="form-control" name="log_date" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Log Title:</label>
                        <input class="form-control" name="log_title" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Causer Username:</label>
                        <input class="form-control" name="log_username" disabled>
                    </div>
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-4">
                        <label>Causer Name:</label>
                        <input class="form-control" name="log_wholename" disabled>
                    </div>
                    <div class="form-group col-md-2">
                        <label>User Type:</label>
                        <input class="form-control" name="log_role" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Office/Department:</label>
                        <input class="form-control" name="log_office" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Log Description:</label>
                        <textarea class="form-control" name="log_desc" disabled></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Reason:</label>
                        <textarea class="form-control" name="log_reason" disabled></textarea>
                    </div>
                </div>
            </div>
            						
		</div>
	</div>
</div>


</div>

@endsection

@section('script')
<script>
    
$(document).ready(function () {
    $('#activityLogs').DataTable({
            responsive: true,
            "lengthMenu": [[-1, 10, 25, 50], ["All", 10, 25, 50]],
    });

    $("button[name='view_log']").click(function(){
        var log_id = $(this).attr('data-id');
        // console.log(log_id);
        $.get("http://ipams.test/logs/"+log_id).done(function( data ){
            console.log(data);

            $("[name='log_date']").val(data[0]);
            $("[name='log_username']").val(data[1]['causer']['username']);
            $("[name='log_wholename']").val(data[1]['causer']['wholename']);
            $("[name='log_role']").val(data[1]['causer']['roles'][0]['name']);
            $("[name='log_office']").val(data[1]['causer']['office']['office_name']);
            $("[name='log_title']").val(data[1]['log_name']);
            $("[name='log_desc']").val(data[1]['description']);
            $("[name='log_reason']").val(data[1]['properties']['Reason']);

        }).fail(function(xhr){
            var err = JSON.parse(xhr.responseText);
            console.log(err);
        });
    });
});
</script>
@endsection