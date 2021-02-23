@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/dir_universidads') }}">Dir universidad</a> :
@endsection
@section("contentheader_description", $dir_universidad->$view_col)
@section("section", "Dir universidads")
@section("section_url", url(config('laraadmin.adminRoute') . '/dir_universidads'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Dir universidads Edit : ".$dir_universidad->$view_col)

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
				{!! Form::model($dir_universidad, ['route' => [config('laraadmin.adminRoute') . '.dir_universidads.update', $dir_universidad->id ], 'method'=>'PUT', 'id' => 'dir_universidad-edit-form']) !!}
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
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/dir_universidads') }}">Cancel</a></button>
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
	$("#dir_universidad-edit-form").validate({
		
	});
});
</script>
@endpush
