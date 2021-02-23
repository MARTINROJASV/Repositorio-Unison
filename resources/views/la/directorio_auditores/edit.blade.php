@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/directorio_auditores') }}">Directorio auditore</a> :
@endsection
@section("contentheader_description", $directorio_auditore->$view_col)
@section("section", "Directorio auditores")
@section("section_url", url(config('laraadmin.adminRoute') . '/directorio_auditores'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Directorio auditores Edit : ".$directorio_auditore->$view_col)

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
				{!! Form::model($directorio_auditore, ['route' => [config('laraadmin.adminRoute') . '.directorio_auditores.update', $directorio_auditore->id ], 'method'=>'PUT', 'id' => 'directorio_auditore-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'nombre')
					@la_input($module, 'puesto')
					@la_input($module, 'correoelectronico')
					@la_input($module, 'telefonooficina')
					@la_input($module, 'telefonocelular')
					@la_input($module, 'comentarios')
					@la_input($module, 'status')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/directorio_auditores') }}">Cancel</a></button>
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
	$("#directorio_auditore-edit-form").validate({
		
	});
});
</script>
@endpush
