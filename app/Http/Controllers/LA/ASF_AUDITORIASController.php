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

use App\Models\ASF_AUDITORIA;

class ASF_AUDITORIASController extends Controller
{
	public $show_action = true;
	public $view_col = 'Nombre Auditoría';
	public $listing_cols = ['id', 'numeroauditoria', 'nombreauditoria', 'programapresupuest'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('ASF_AUDITORIAS', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('ASF_AUDITORIAS', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the ASF_AUDITORIAS.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('ASF_AUDITORIAS');
		
		if(Module::hasAccess($module->id)) {
			return View('la.asf_auditorias.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Show the form for creating a new asf_auditoria.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created asf_auditoria in database.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if(Module::hasAccess("ASF_AUDITORIAS", "create")) {
		
			$rules = Module::validateRules("ASF_AUDITORIAS", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			$insert_id = Module::insert("ASF_AUDITORIAS", $request);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.asf_auditorias.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Display the specified asf_auditoria.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("ASF_AUDITORIAS", "view")) {
			
			$asf_auditoria = ASF_AUDITORIA::find($id);
			if(isset($asf_auditoria->id)) {
				$module = Module::get('ASF_AUDITORIAS');
				$module->row = $asf_auditoria;
				
				return view('la.asf_auditorias.show', [
					'module' => $module,
					'view_col' => $this->view_col,
					'no_header' => true,
					'no_padding' => "no-padding"
				])->with('asf_auditoria', $asf_auditoria);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("asf_auditoria"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Show the form for editing the specified asf_auditoria.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		if(Module::hasAccess("ASF_AUDITORIAS", "edit")) {			
			$asf_auditoria = ASF_AUDITORIA::find($id);
			if(isset($asf_auditoria->id)) {	
				$module = Module::get('ASF_AUDITORIAS');
				
				$module->row = $asf_auditoria;
				
				return view('la.asf_auditorias.edit', [
					'module' => $module,
					'view_col' => $this->view_col,
				])->with('asf_auditoria', $asf_auditoria);
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("asf_auditoria"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Update the specified asf_auditoria in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		if(Module::hasAccess("ASF_AUDITORIAS", "edit")) {
			
			$rules = Module::validateRules("ASF_AUDITORIAS", $request, true);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();;
			}
			
			$insert_id = Module::updateRow("ASF_AUDITORIAS", $request, $id);
			
			return redirect()->route(config('laraadmin.adminRoute') . '.asf_auditorias.index');
			
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}

	/**
	 * Remove the specified asf_auditoria from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if(Module::hasAccess("ASF_AUDITORIAS", "delete")) {
			ASF_AUDITORIA::find($id)->delete();
			
			// Redirecting to index() method
			return redirect()->route(config('laraadmin.adminRoute') . '.asf_auditorias.index');
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
		$values = DB::table('asf_auditorias')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('ASF_AUDITORIAS');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/asf_auditorias/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			
			if($this->show_action) {
				$output = '';
				if(Module::hasAccess("ASF_AUDITORIAS", "edit")) {
					$output .= '<a href="'.url(config('laraadmin.adminRoute') . '/asf_auditorias/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
				}
				
				if(Module::hasAccess("ASF_AUDITORIAS", "delete")) {
					$output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.asf_auditorias.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
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
