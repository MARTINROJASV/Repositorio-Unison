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

use App\Models\Cedulas_de_resultado;

class Cedulas_de_resultadosController extends Controller
{
	public $show_action = true;
	public $view_col = 'nodeoficio';
	public $listing_cols = ['id', 'nodeoficio', 'fecha', 'direccionemiteofc', 'fechapresentacion', 'lugar', 'fechaacta', 'nodeacta', 'documentoescaneado', 'numderesultados', 'observacionunison', 'sinobservaciones', 'observaciongobedo', 'plazoparaatencion', 'fechadevencimiento', 'status'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Cedulas_de_resultados', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Cedulas_de_resultados', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Cedulas_de_resultados.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Cedulas_de_resultados');
		
		if(Module::hasAccess($module->id)) {
			return View('la.cedulas_de_resultados.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new cedulas_de_resultado.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created cedulas_de_resultado in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Cedulas_de_resultados", "create")) {
		
			$rules = Module::validateRules("Cedulas_de_resultados", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Cedulas_de_resultados", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.cedulas_de_resultados.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified cedulas_de_resultado.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Cedulas_de_resultados", "view")) {
			
			$cedulas_de_resultado = Cedulas_de_resultado::find($id);
			if(isset($cedulas_de_resultado->id)) {
				$module = Module::get('Cedulas_de_resultados');
				$module->row = $cedulas_de_resultado;
				
				return view('la.cedulas_de_resultados.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('cedulas_de_resultado', $cedulas_de_resultado);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("cedulas_de_resultado"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified cedulas_de_resultado.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Cedulas_de_resultados", "edit")) {			
			$cedulas_de_resultado = Cedulas_de_resultado::find($id);
			if(isset($cedulas_de_resultado->id)) {	
				$module = Module::get('Cedulas_de_resultados');
				
				$module->row = $cedulas_de_resultado;
				
				return view('la.cedulas_de_resultados.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('cedulas_de_resultado', $cedulas_de_resultado);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("cedulas_de_resultado"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified cedulas_de_resultado in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Cedulas_de_resultados", "edit")) {
			
			$rules = Module::validateRules("Cedulas_de_resultados", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Cedulas_de_resultados", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.cedulas_de_resultados.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified cedulas_de_resultado from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Cedulas_de_resultados", "delete")) {
			Cedulas_de_resultado::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.cedulas_de_resultados.index');
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
		$values = DB::table('cedulas_de_resultados')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Cedulas_de_resultados');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/cedulas_de_resultados/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("Cedulas_de_resultados", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/cedulas_de_resultados/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Cedulas_de_resultados", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.cedulas_de_resultados.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
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
