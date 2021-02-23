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

use App\Models\Oficio_de_solicitud;

class Oficio_de_solicitudsController extends Controller
{
	public $show_action = true;
	public $view_col = 'nodeoficio';
	public $listing_cols = ['id', 'nodeoficio', 'fecha', 'diasdeplazo', 'fechadevencimiento', 'auditorquesolicita', 'documentoescaneado', 'agendaractividad', 'status'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Oficio_de_solicituds', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Oficio_de_solicituds', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Oficio_de_solicituds.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Oficio_de_solicituds');
		
		if(Module::hasAccess($module->id)) {
			return View('la.oficio_de_solicituds.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new oficio_de_solicitud.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created oficio_de_solicitud in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("Oficio_de_solicituds", "create")) {
		
			$rules = Module::validateRules("Oficio_de_solicituds", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("Oficio_de_solicituds", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.oficio_de_solicituds.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified oficio_de_solicitud.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Oficio_de_solicituds", "view")) {
			
			$oficio_de_solicitud = Oficio_de_solicitud::find($id);
			if(isset($oficio_de_solicitud->id)) {
				$module = Module::get('Oficio_de_solicituds');
				$module->row = $oficio_de_solicitud;
				
				return view('la.oficio_de_solicituds.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('oficio_de_solicitud', $oficio_de_solicitud);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("oficio_de_solicitud"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified oficio_de_solicitud.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("Oficio_de_solicituds", "edit")) {			
			$oficio_de_solicitud = Oficio_de_solicitud::find($id);
			if(isset($oficio_de_solicitud->id)) {	
				$module = Module::get('Oficio_de_solicituds');
				
				$module->row = $oficio_de_solicitud;
				
				return view('la.oficio_de_solicituds.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('oficio_de_solicitud', $oficio_de_solicitud);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("oficio_de_solicitud"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified oficio_de_solicitud in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("Oficio_de_solicituds", "edit")) {
			
			$rules = Module::validateRules("Oficio_de_solicituds", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("Oficio_de_solicituds", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.oficio_de_solicituds.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified oficio_de_solicitud from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("Oficio_de_solicituds", "delete")) {
			Oficio_de_solicitud::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.oficio_de_solicituds.index');
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
		$values = DB::table('oficio_de_solicituds')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Oficio_de_solicituds');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/oficio_de_solicituds/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("Oficio_de_solicituds", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/oficio_de_solicituds/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("Oficio_de_solicituds", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.oficio_de_solicituds.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
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
