@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/asf_auditorias') }}">ASF AUDITORIA</a> :
@endsection
@section("contentheader_description", $asf_auditoria->$view_col)
@section("section", "ASF AUDITORIAS")
@section("section_url", url(config('laraadmin.adminRoute') . '/asf_auditorias'))
@section("sub_section", "Edit")

@section("htmlheader_title", "ASF AUDITORIAS Edit : ".$asf_auditoria->$view_col)

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
				{!! Form::model($asf_auditoria, ['route' => [config('laraadmin.adminRoute') . '.asf_auditorias.update', $asf_auditoria->id ], 'method'=>'PUT', 'id' => 'asf_auditoria-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'numeroauditoria')
					@la_input($module, 'nombreauditoria')
					@la_input($module, 'programapresupuest')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/asf_auditorias') }}">Cancel</a></button>
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
	$("#asf_auditoria-edit-form").validate({
		
	});
});
</script>
@endpush
