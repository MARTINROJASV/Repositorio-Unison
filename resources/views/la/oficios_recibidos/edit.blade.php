@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/oficios_recibidos') }}">Oficios Recibido</a> :
@endsection
@section("contentheader_description", $oficios_recibido->$view_col)
@section("section", "Oficios Recibidos")
@section("section_url", url(config('laraadmin.adminRoute') . '/oficios_recibidos'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Oficios Recibidos Edit : ".$oficios_recibido->$view_col)

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
				{!! Form::model($oficios_recibido, ['route' => [config('laraadmin.adminRoute') . '.oficios_recibidos.update', $oficios_recibido->id ], 'method'=>'PUT', 'id' => 'oficios_recibido-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'nodeoficio')
					@la_input($module, 'fecha')
					@la_input($module, 'direccionemiteofc')
					@la_input($module, 'asunto')
					@la_input($module, 'comentarios')
					@la_input($module, 'documentoescaneado')
					@la_input($module, 'agendaractividad')
					@la_input($module, 'status')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/oficios_recibidos') }}">Cancel</a></button>
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
	$("#oficios_recibido-edit-form").validate({
		
	});
});
</script>
@endpush
