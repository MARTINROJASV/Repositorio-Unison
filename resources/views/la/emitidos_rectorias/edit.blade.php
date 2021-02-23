@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/emitidos_rectorias') }}">Emitidos Rectoria</a> :
@endsection
@section("contentheader_description", $emitidos_rectoria->$view_col)
@section("section", "Emitidos Rectorias")
@section("section_url", url(config('laraadmin.adminRoute') . '/emitidos_rectorias'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Emitidos Rectorias Edit : ".$emitidos_rectoria->$view_col)

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
				{!! Form::model($emitidos_rectoria, ['route' => [config('laraadmin.adminRoute') . '.emitidos_rectorias.update', $emitidos_rectoria->id ], 'method'=>'PUT', 'id' => 'emitidos_rectoria-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'nodeoficio')
					@la_input($module, 'fecha')
					@la_input($module, 'asunto')
					@la_input($module, 'comentarios')
					@la_input($module, 'documentoescaneado')
					@la_input($module, 'agendaractividad')
					@la_input($module, 'status')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/emitidos_rectorias') }}">Cancel</a></button>
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
	$("#emitidos_rectoria-edit-form").validate({
		
	});
});
</script>
@endpush
