@extends('layouts.app')

@section('header')
<h1 class="page-title"> Type Sports
	<small>Manage Type Sports</small>
</h1>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="{{ url('/') }}">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>			
			<a href="{{ url('typesport') }}">Type Sports Management</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<span>
				@if (empty($data))
					Add New Type Sports
				@else
					Update Type Sports
				@endif
			</span>
		</li>
	</ul>                        
</div>
@endsection

@section('content')

<div class="row">
	<div class="col-lg-12 col-lg-3 col-md-3 col-sm-6 col-xs-12">
	    <!-- BEGIN EXAMPLE TABLE PORTLET-->
	    <div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-soccer-ball-o font-green"></i>
					<span class="caption-subject font-green sbold uppercase">
						@if (empty($data))
							ADD NEW TYPE SPORTS
						@else
							UPDATE TYPE SPORTS
						@endif
					</span>
				</div>

				<div class="btn-group" style="float: right; padding-top: 2px; padding-right: 10px;">
                	<a class="btn btn-md green" href="{{ url('typesport/') }}">
                		<i class="fa fa-chevron-left"></i> Back
                	</a>
				</div>
	        </div>
	        <div class="portlet-body" style="padding: 15px;">
	        	<!-- MAIN CONTENT -->
	        	<form id="form_type_sports" class="form-horizontal" action="{{ url('typesport', @$data->id) }}" method="POST">	        	
			        {{ csrf_field() }}
			        @if (!empty($data))
			          {{ method_field('PATCH') }}
			        @endif
			        <div class="form-body">
                    	<div class="alert alert-danger display-hide">
                        	<button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                        <div class="alert alert-success display-hide">
                        	<button class="close" data-close="alert"></button> Your form validation is successful! </div>
                        
                        <div class="caption padding-caption">
                        	<span class="caption-subject font-dark bold uppercase">DETAILS</span>
                        	<hr>
                        </div>

				        <div class="form-group">
				          <label class="col-sm-2 control-label">Name</label>
				          <div class="col-sm-9">
				          	<div class="input-icon right">
				          		<i class="fa"></i>
				            	<input type="text" name="name" class="form-control" value="{{ @$data->name }}" placeholder="Input Name" />
				            </div>
				          </div>
				        </div>

				        <div class="form-group">
				          <label class="col-sm-2 control-label">Kind Sport</label>
				          <div class="col-sm-9">

				          <div class="input-group" style="width: 100%;">
     
                                <select class="select2select" name="kindsport_id" id="kindsport" required></select>
                               	
                                <span class="input-group-addon display-hide">
                                	<i class="fa"></i>
                                </span>

              				</div>
				            
				          </div>
				        </div>	

				        <div class="form-group">
				          <label class="col-sm-2 control-label">Gender Type</label>
				          <div class="col-sm-9">

				          <div class="input-group" style="width: 100%;">
     
                                <select class="select2select" name="gender_type" id="gendertype" required>
                                	<option value="MALE" {{ (@$data->gender_type == 'MALE') ? "selected" : "" }}>MALE</option>
                                	<option value="FEMALE" {{ (@$data->gender_type == 'FEMALE') ? "selected" : "" }}>FEMALE</option>
                                	<option value="MIXED" {{ (@$data->gender_type == 'MIXED') ? "selected" : "" }}>MIXED</option>
                                </select>
                               	
                                <span class="input-group-addon display-hide">
                                	<i class="fa"></i>
                                </span>

              				</div>
				            
				          </div>
				        </div>			        			        		    
				        
				        <div class="form-group">
				          <label class="col-sm-2 control-label">Description</label>
				          <div class="col-sm-9">
				          	<div class="input-icon right">
				          		<i class="fa"></i>
				          		<textarea name="description" class="form-control" rows="5" placeholder="Description about this type sports..">{{ @$data->description }}</textarea>
				          	</div>
				          </div>
				        </div>
				        
				        <div class="form-group" style="padding-top: 15pt;">
				          <div class="col-sm-9 col-sm-offset-2">
				            <button type="submit" class="btn btn-primary green">Save</button>
				          </div>
				        </div>

			    	</div>
			    </form>
				<!-- END MAIN CONTENT -->
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
@endsection

@section('additional-scripts')	
	<!-- BEGIN SELECT2 SCRIPTS -->
    <script src="{{ asset('js/handler/select2-handler.js') }}" type="text/javascript"></script>
    <!-- END SELECT2 SCRIPTS -->
	<!-- BEGIN PAGE VALIDATION SCRIPTS -->
    <script src="{{ asset('js/handler/type-sports-handler.js') }}" type="text/javascript"></script>
    <!-- END PAGE VALIDATION SCRIPTS -->
    
    <script>
		$(document).ready(function () {
			$.ajaxSetup({
	        	headers: {
	            	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });

	       	$('#kindsport').select2(setOptions('{{ route("data.kindsports") }}', 'Kind Sport', function (params) {
                        // console.log(params);
                        return filterData('name', params.term);
                    }, function (data, params) {
                        return {
                            results: $.map(data, function (obj) {                                
                                return {id: obj.id, text: obj.name}
                            })
                        }
                    }));

	      	$('#gendertype').select2({
                        width: '100%',
                        placeholder: 'Gender Type'
                    })

	       // Set select2 => 'branchsport' if method PATCH	       
	       setSelect2IfPatch($("#kindsport"), "{{ @$data->kindsport_id }}", "{{ @$data->kindSport->name }}");	     	      

		});
	</script>
@endsection