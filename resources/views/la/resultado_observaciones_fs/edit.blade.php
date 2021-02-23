@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/resultado_observaciones_fs') }}">Resultado Observaciones f</a> :
@endsection
@section("contentheader_description", $resultado_observaciones_f->$view_col)
@section("section", "Resultado Observaciones fs")
@section("section_url", url(config('laraadmin.adminRoute') . '/resultado_observaciones_fs'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Resultado Observaciones fs Edit : ".$resultado_observaciones_f->$view_col)

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
				{!! Form::model($resultado_observaciones_f, ['route' => [config('laraadmin.adminRoute') . '.resultado_observaciones_fs.update', $resultado_observaciones_f->id ], 'method'=>'PUT', 'id' => 'resultado_observaciones_f-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'numero')
					@la_input($module, 'descripcionresultado')
					@la_input($module, 'documentoescaneado')
					@la_input($module, 'direccionresponsable')
					@la_input($module, 'num')
					@la_input($module, 'fecha')
					@la_input($module, 'plazo')
					@la_input($module, 'fechadevencimiento')
					@la_input($module, 'status')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/resultado_observaciones_fs') }}">Cancel</a></button>
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
	$("#resultado_observaciones_f-edit-form").validate({
		
	});
});
</script>
@endpush
