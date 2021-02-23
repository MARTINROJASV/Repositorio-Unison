<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;

use App\Models\Ofc_orden_auditoria;

class Ofc_orden_auditoriasController extends Controller
{
	public $show_action = true;
	public $view_col = 'nodeoficio';
	public $listing_cols = ['id', 'nodeoficio', 'fecha', 'direccionemiteofc', 'fechainicioauditor', 'fechaactaauditoria', 'nodeacta', 'comentarios', 'documentoescaneado', 'agendaractividad', 'status'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Ofc_orden_auditorias', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Ofc_orden_auditorias', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Ofc_orden_auditorias.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Ofc_orden_auditorias');
		
		if(Module::hasAccess($module->id)) {
			return View('la.ofc_orden_auditorias.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new ofc_orden_auditoria.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created ofc_orden_auditoria in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Ofc_orden_auditorias", "create")) {
		
			$rules = Module::validateRules("Ofc_orden_auditorias", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Ofc_orden_auditorias", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.ofc_orden_auditorias.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified ofc_orden_auditoria.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Ofc_orden_auditorias", "view")) {
			
			$ofc_orden_auditoria = Ofc_orden_auditoria::find($id);
			if(isset($ofc_orden_auditoria->id)) {
				$module = Module::get('Ofc_orden_auditorias');
				$module->row = $ofc_orden_auditoria;
				
				return view('la.ofc_orden_auditorias.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('ofc_orden_auditoria', $ofc_orden_auditoria);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("ofc_orden_auditoria"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified ofc_orden_auditoria.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Ofc_orden_auditorias", "edit")) {			
			$ofc_orden_auditoria = Ofc_orden_auditoria::find($id);
			if(isset($ofc_orden_auditoria->id)) {	
				$module = Module::get('Ofc_orden_auditorias');
				
				$module->row = $ofc_orden_auditoria;
				
				return view('la.ofc_orden_auditorias.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('ofc_orden_auditoria', $ofc_orden_auditoria);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("ofc_orden_auditoria"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified ofc_orden_auditoria in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Ofc_orden_auditorias", "edit")) {
			
			$rules = Module::validateRules("Ofc_orden_auditorias", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Ofc_orden_auditorias", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.ofc_orden_auditorias.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified ofc_orden_auditoria from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Ofc_orden_auditorias", "delete")) {
			Ofc_orden_auditoria::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.ofc_orden_auditorias.index');
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}
	
	/**
	 * Datatable Ajax fetch
	 *
	 * @return
	 */
	public function dtajax()
	{
		$values = DB::table('ofc_orden_auditorias')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Ofc_orden_auditorias');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/ofc_orden_auditorias/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("Ofc_orden_auditorias", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/ofc_orden_auditorias/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Ofc_orden_auditorias", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.ofc_orden_auditorias.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
					$output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
					$output .= Form::close();
				}
				$data->data[$i][] = (string)$output;
			}
		}
		$out->setData($data);
		return $out;
	}
}
