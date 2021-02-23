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

use App\Models\InformeCuentaPublica;

class InformeCuentaPublicasController extends Controller
{
	public $show_action = true;
	public $view_col = 'numdeobservaciones';
	public $listing_cols = ['id', 'numdeobservaciones', 'fechapublicacion', 'conobservacion', 'sinobservaciones', 'documentoescaneado'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('InformeCuentaPublicas', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('InformeCuentaPublicas', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the InformeCuentaPublicas.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('InformeCuentaPublicas');
		
		if(Module::hasAccess($module->id)) {
			return View('la.informecuentapublicas.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new informecuentapublica.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created informecuentapublica in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("InformeCuentaPublicas", "create")) {
		
			$rules = Module::validateRules("InformeCuentaPublicas", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("InformeCuentaPublicas", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.informecuentapublicas.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified informecuentapublica.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("InformeCuentaPublicas", "view")) {
			
			$informecuentapublica = InformeCuentaPublica::find($id);
			if(isset($informecuentapublica->id)) {
				$module = Module::get('InformeCuentaPublicas');
				$module->row = $informecuentapublica;
				
				return view('la.informecuentapublicas.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('informecuentapublica', $informecuentapublica);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("informecuentapublica"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified informecuentapublica.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("InformeCuentaPublicas", "edit")) {			
			$informecuentapublica = InformeCuentaPublica::find($id);
			if(isset($informecuentapublica->id)) {	
				$module = Module::get('InformeCuentaPublicas');
				
				$module->row = $informecuentapublica;
				
				return view('la.informecuentapublicas.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('informecuentapublica', $informecuentapublica);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("informecuentapublica"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified informecuentapublica in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("InformeCuentaPublicas", "edit")) {
			
			$rules = Module::validateRules("InformeCuentaPublicas", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("InformeCuentaPublicas", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.informecuentapublicas.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified informecuentapublica from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("InformeCuentaPublicas", "delete")) {
			InformeCuentaPublica::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.informecuentapublicas.index');
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
		$values = DB::table('informecuentapublicas')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('InformeCuentaPublicas');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/informecuentapublicas/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("InformeCuentaPublicas", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/informecuentapublicas/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("InformeCuentaPublicas", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.informecuentapublicas.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
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
