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

use App\Models\Solicitudes_info;

class Solicitudes_infosController extends Controller
{
	public $show_action = true;
	public $view_col = 'nodeoficio';
	public $listing_cols = ['id', 'nodeoficio', 'fecha', 'direccionemiteofcopc', 'fechadevencimiento', 'informacionsolicita', 'documentoescaneado', 'agendaractividad', 'status'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Solicitudes_infos', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Solicitudes_infos', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Solicitudes_infos.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Solicitudes_infos');
		
		if(Module::hasAccess($module->id)) {
			return View('la.solicitudes_infos.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new solicitudes_info.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created solicitudes_info in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Solicitudes_infos", "create")) {
		
			$rules = Module::validateRules("Solicitudes_infos", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Solicitudes_infos", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.solicitudes_infos.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified solicitudes_info.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Solicitudes_infos", "view")) {
			
			$solicitudes_info = Solicitudes_info::find($id);
			if(isset($solicitudes_info->id)) {
				$module = Module::get('Solicitudes_infos');
				$module->row = $solicitudes_info;
				
				return view('la.solicitudes_infos.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('solicitudes_info', $solicitudes_info);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("solicitudes_info"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified solicitudes_info.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Solicitudes_infos", "edit")) {			
			$solicitudes_info = Solicitudes_info::find($id);
			if(isset($solicitudes_info->id)) {	
				$module = Module::get('Solicitudes_infos');
				
				$module->row = $solicitudes_info;
				
				return view('la.solicitudes_infos.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('solicitudes_info', $solicitudes_info);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("solicitudes_info"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified solicitudes_info in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Solicitudes_infos", "edit")) {
			
			$rules = Module::validateRules("Solicitudes_infos", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Solicitudes_infos", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.solicitudes_infos.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified solicitudes_info from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Solicitudes_infos", "delete")) {
			Solicitudes_info::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.solicitudes_infos.index');
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
		$values = DB::table('solicitudes_infos')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Solicitudes_infos');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/solicitudes_infos/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("Solicitudes_infos", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/solicitudes_infos/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Solicitudes_infos", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.solicitudes_infos.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
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
