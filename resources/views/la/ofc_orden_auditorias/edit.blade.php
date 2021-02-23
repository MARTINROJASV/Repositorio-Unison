@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/ofc_orden_auditorias') }}">Ofc orden auditoria</a> :
@endsection
@section("contentheader_description", $ofc_orden_auditoria->$view_col)
@section("section", "Ofc orden auditorias")
@section("section_url", url(config('laraadmin.adminRoute') . '/ofc_orden_auditorias'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Ofc orden auditorias Edit : ".$ofc_orden_auditoria->$view_col)

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
				{!! Form::model($ofc_orden_auditoria, ['route' => [config('laraadmin.adminRoute') . '.ofc_orden_auditorias.update', $ofc_orden_auditoria->id ], 'method'=>'PUT', 'id' => 'ofc_orden_auditoria-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'nodeoficio')
					@la_input($module, 'fecha')
					@la_input($module, 'direccionemiteofc')
					@la_input($module, 'fechainicioauditor')
					@la_input($module, 'fechaactaauditoria')
					@la_input($module, 'nodeacta')
					@la_input($module, 'comentarios')
					@la_input($module, 'documentoescaneado')
					@la_input($module, 'agendaractividad')
					@la_input($module, 'status')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/ofc_orden_auditorias') }}">Cancel</a></button>
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
	$("#ofc_orden_auditoria-edit-form").validate({
		
	});
});
</script>
@endpush
