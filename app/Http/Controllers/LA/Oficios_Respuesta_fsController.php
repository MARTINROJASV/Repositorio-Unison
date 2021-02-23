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

use App\Models\Oficios_Respuesta_f;

class Oficios_Respuesta_fsController extends Controller
{
	public $show_action = true;
	public $view_col = 'nodeoficio';
	public $listing_cols = ['id', 'nodeoficio', 'fecha', 'asunto', 'comentarios', 'documentoescaneado', 'status'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Oficios_Respuesta_fs', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Oficios_Respuesta_fs', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Oficios_Respuesta_fs.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Oficios_Respuesta_fs');
		
		if(Module::hasAccess($module->id)) {
			return View('la.oficios_respuesta_fs.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new oficios_respuesta_f.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created oficios_respuesta_f in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Oficios_Respuesta_fs", "create")) {
		
			$rules = Module::validateRules("Oficios_Respuesta_fs", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Oficios_Respuesta_fs", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.oficios_respuesta_fs.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified oficios_respuesta_f.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Oficios_Respuesta_fs", "view")) {
			
			$oficios_respuesta_f = Oficios_Respuesta_f::find($id);
			if(isset($oficios_respuesta_f->id)) {
				$module = Module::get('Oficios_Respuesta_fs');
				$module->row = $oficios_respuesta_f;
				
				return view('la.oficios_respuesta_fs.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('oficios_respuesta_f', $oficios_respuesta_f);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("oficios_respuesta_f"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified oficios_respuesta_f.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Oficios_Respuesta_fs", "edit")) {			
			$oficios_respuesta_f = Oficios_Respuesta_f::find($id);
			if(isset($oficios_respuesta_f->id)) {	
				$module = Module::get('Oficios_Respuesta_fs');
				
				$module->row = $oficios_respuesta_f;
				
				return view('la.oficios_respuesta_fs.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('oficios_respuesta_f', $oficios_respuesta_f);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("oficios_respuesta_f"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified oficios_respuesta_f in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Oficios_Respuesta_fs", "edit")) {
			
			$rules = Module::validateRules("Oficios_Respuesta_fs", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Oficios_Respuesta_fs", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.oficios_respuesta_fs.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified oficios_respuesta_f from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Oficios_Respuesta_fs", "delete")) {
			Oficios_Respuesta_f::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.oficios_respuesta_fs.index');
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
		$values = DB::table('oficios_respuesta_fs')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Oficios_Respuesta_fs');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/oficios_respuesta_fs/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("Oficios_Respuesta_fs", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/oficios_respuesta_fs/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Oficios_Respuesta_fs", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.oficios_respuesta_fs.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
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
