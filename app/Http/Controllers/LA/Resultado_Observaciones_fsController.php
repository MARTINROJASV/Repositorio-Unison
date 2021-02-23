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

use App\Models\Resultado_Observaciones_f;

class Resultado_Observaciones_fsController extends Controller
{
	public $show_action = true;
	public $view_col = 'numero';
	public $listing_cols = ['id', 'numero', 'descripcionresultado', 'documentoescaneado', 'direccionresponsable', 'num', 'fecha', 'plazo', 'fechadevencimiento', 'status'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Resultado_Observaciones_fs', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Resultado_Observaciones_fs', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Resultado_Observaciones_fs.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Resultado_Observaciones_fs');
		
		if(Module::hasAccess($module->id)) {
			return View('la.resultado_observaciones_fs.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new resultado_observaciones_f.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resultado_observaciones_f in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Resultado_Observaciones_fs", "create")) {
		
			$rules = Module::validateRules("Resultado_Observaciones_fs", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Resultado_Observaciones_fs", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.resultado_observaciones_fs.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified resultado_observaciones_f.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Resultado_Observaciones_fs", "view")) {
			
			$resultado_observaciones_f = Resultado_Observaciones_f::find($id);
			if(isset($resultado_observaciones_f->id)) {
				$module = Module::get('Resultado_Observaciones_fs');
				$module->row = $resultado_observaciones_f;
				
				return view('la.resultado_observaciones_fs.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('resultado_observaciones_f', $resultado_observaciones_f);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("resultado_observaciones_f"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified resultado_observaciones_f.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Resultado_Observaciones_fs", "edit")) {			
			$resultado_observaciones_f = Resultado_Observaciones_f::find($id);
			if(isset($resultado_observaciones_f->id)) {	
				$module = Module::get('Resultado_Observaciones_fs');
				
				$module->row = $resultado_observaciones_f;
				
				return view('la.resultado_observaciones_fs.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('resultado_observaciones_f', $resultado_observaciones_f);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("resultado_observaciones_f"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified resultado_observaciones_f in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Resultado_Observaciones_fs", "edit")) {
			
			$rules = Module::validateRules("Resultado_Observaciones_fs", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Resultado_Observaciones_fs", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.resultado_observaciones_fs.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified resultado_observaciones_f from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Resultado_Observaciones_fs", "delete")) {
			Resultado_Observaciones_f::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.resultado_observaciones_fs.index');
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
		$values = DB::table('resultado_observaciones_fs')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Resultado_Observaciones_fs');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/resultado_observaciones_fs/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("Resultado_Observaciones_fs", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/resultado_observaciones_fs/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Resultado_Observaciones_fs", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.resultado_observaciones_fs.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
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
