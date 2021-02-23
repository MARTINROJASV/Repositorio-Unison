@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/oficio_de_solicituds') }}">Oficio de solicitud</a> :
@endsection
@section("contentheader_description", $oficio_de_solicitud->$view_col)
@section("section", "Oficio de solicituds")
@section("section_url", url(config('laraadmin.adminRoute') . '/oficio_de_solicituds'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Oficio de solicituds Edit : ".$oficio_de_solicitud->$view_col)

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
				{!! Form::model($oficio_de_solicitud, ['route' => [config('laraadmin.adminRoute') . '.oficio_de_solicituds.update', $oficio_de_solicitud->id ], 'method'=>'PUT', 'id' => 'oficio_de_solicitud-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'nodeoficio')
					@la_input($module, 'fecha')
					@la_input($module, 'diasdeplazo')
					@la_input($module, 'fechadevencimiento')
					@la_input($module, 'auditorquesolicita')
					@la_input($module, 'documentoescaneado')
					@la_input($module, 'agendaractividad')
					@la_input($module, 'status')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/oficio_de_solicituds') }}">Cancel</a></button>
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
	$("#oficio_de_solicitud-edit-form").validate({
		
	});
});
</script>
@endpush
