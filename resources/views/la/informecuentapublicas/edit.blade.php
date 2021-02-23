@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/informecuentapublicas') }}">InformeCuentaPublica</a> :
@endsection
@section("contentheader_description", $informecuentapublica->$view_col)
@section("section", "InformeCuentaPublicas")
@section("section_url", url(config('laraadmin.adminRoute') . '/informecuentapublicas'))
@section("sub_section", "Edit")

@section("htmlheader_title", "InformeCuentaPublicas Edit : ".$informecuentapublica->$view_col)

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($informecuentapublica, ['route' => [config('laraadmin.adminRoute') . '.informecuentapublicas.update', $informecuentapublica->id ], 'method'=>'PUT', 'id' => 'informecuentapublica-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'numdeobservaciones')
					@la_input($module, 'fechapublicacion')
					@la_input($module, 'conobservacion')
					@la_input($module, 'sinobservaciones')
					@la_input($module, 'documentoescaneado')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/informecuentapublicas') }}">Cancel</a></button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#informecuentapublica-edit-form").validate({
		
	});
});
</script>
@endpush
