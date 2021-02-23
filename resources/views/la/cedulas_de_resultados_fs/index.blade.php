@extends("la.layouts.app")

@section("contentheader_title", "Cedulas de resultados fs")
@section("contentheader_description", "Cedulas de resultados fs listing")
@section("section", "Cedulas de resultados fs")
@section("sub_section", "Listing")
@section("htmlheader_title", "Cedulas de resultados fs Listing")

@section("headerElems")
@la_access("Cedulas_de_resultados_fs", "create")
	<button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#AddModal">Add Cedulas de resultados f</button>
@endla_access
@endsection

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

<div class="box box-success">
	<!--<div class="box-header"></div>-->
	<div class="box-body">
		<table id="example1" class="table table-bordered">
		<thead>
		<tr class="success">
			@foreach( $listing_cols as $col )
			<th>{{ $module->fields[$col]['label'] or ucfirst($col) }}</th>
			@endforeach
			@if($show_actions)
			<th>Actions</th>
			@endif
		</tr>
		</thead>
		<tbody>
			
		</tbody>
		</table>
	</div>
</div>

@la_access("Cedulas_de_resultados_fs", "create")
<div class="modal fade" id="AddModal" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Cedulas de resultados f</h4>
			</div>
			{!! Form::open(['action' => 'LA\Cedulas_de_resultados_fsController@store', 'id' => 'cedulas_de_resultados_f-add-form']) !!}
			<div class="modal-body">
				<div class="box-body">
                    @la_form($module)
					
					{{--
					@la_input($module, 'nodeoficio')
					@la_input($module, 'fecha')
					@la_input($module, 'direccionemiteofc')
					@la_input($module, 'fechapresentacion')
					@la_input($module, 'lugar')
					@la_input($module, 'fechaacta')
					@la_input($module, 'nodeacta')
					@la_input($module, 'documentoescaneado')
					@la_input($module, 'numderesultados')
					@la_input($module, 'observacionunison')
					@la_input($module, 'sinobservaciones')
					@la_input($module, 'observaciongobedo')
					@la_input($module, 'plazoparaatencion')
					@la_input($module, 'fechadevencimiento')
					@la_input($module, 'status')
					--}}
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				{!! Form::submit( 'Submit', ['class'=>'btn btn-success']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endla_access

@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('la-assets/plugins/datatables/datatables.min.css') }}"/>
@endpush

@push('scripts')
<script src="{{ asset('la-assets/plugins/datatables/datatables.min.js') }}"></script>
<script>
$(function () {
	$("#example1").DataTable({
		processing: true,
        serverSide: true,
        ajax: "{{ url(config('laraadmin.adminRoute') . '/cedulas_de_resultados_f_dt_ajax') }}",
		language: {
			lengthMenu: "_MENU_",
			search: "_INPUT_",
			searchPlaceholder: "Search"
		},
		@if($show_actions)
		columnDefs: [ { orderable: false, targets: [-1] }],
		@endif
	});
	$("#cedulas_de_resultados_f-add-form").validate({
		
	});
});
</script>
@endpush
