<?php

namespace App\Http\Controllers;

use App\Models\AppSettingsModel;
use Illuminate\Http\Request;
// use App\Http\Controllers\Auth;
use DataTables;

use Illuminate\Support\Facades\Auth;

class AppsettingsConteroller extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
         $this->middleware('permission:zoom-settings', ['only' => ['zoomSettings','zoomSettingsUpdate']]);
         $this->middleware('permission:app-settings', ['only' => ['index','update']]);
    }
    // public function index() {
    //     $data['item'] = getAppSettings();
    //     $data['pageTitle'] = 'App Settings';
    //     $data['appSettings'] = 'active';
    //     // $data['appSettingsOpend'] = 'menu-open';
    //     // $data['appSettingsOpening'] = 'menu-is-opening';
    //     return view('admin.appsettings.index', $data);
    // }
    function index(Request $request){
        if ($request->ajax()) {
            $data = AppSettingsModel::get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn='';
                $btn .= ' <a class="btn btn-xs btn-primary" href="'.route('appSettings.edit',$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
                $url = route("appSettings.delete", $row->id);
                $btn .= ' <a href="javascript:void(0)" onclick="DeleteMe(this, '."'".$url."'".')" class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash"></i></a>';
                    
                return $btn;
            })
            ->addColumn('rownum', function ($row) {
                return '';
            })
            ->rawColumns(['rownum', 'action'])
            ->make(true);
        }
        $data['pageTitle'] = 'App Settings';
        $data['appSettingsListActive'] = 'active';
        $data['appSettingsOpend'] = 'menu-open';
        $data['appSettingsOpening'] = 'menu-is-opening';
        return view('admin.appsettings.index', $data);
    }
    public function create()
    {
        $data['pageTitle'] = 'App Settings';
        $data['appSettingsCreateActive'] = 'active';
        $data['appSettingsOpend'] = 'menu-open';
        $data['appSettingsOpening'] = 'menu-is-opening';
        return view('admin.appsettings.create', $data);
        // return view('admin.users.create',compact('roles'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'skey' => 'required|unique:appSettings,skey',
            'sval' => 'required',
        ], [
            'skey.unique' => 'key must be unique.',
            // Add custom error messages for other rules as needed
        ]);
        if(AppSettingsModel::create($request->all())){
            return redirect()->route('appSettings.list');
        }else{
            return redirect()->route('appSettings.create')
            ->with('error','Something went wrong, Please try again');

        }
    }
    public function uploadLogo(Request $request)
    {
        $this->validate($request, [
            'skey' => 'required|unique:appSettings,skey',
            'sval' => 'required',
        ], [
            'skey.unique' => 'key must be unique.',
            // Add custom error messages for other rules as needed
        ]);
        if(AppSettingsModel::create($request->all())){
            return redirect()->route('appSettings.list');
        }else{
            return redirect()->route('appSettings.create')
            ->with('error','Something went wrong, Please try again');

        }
    }
    public function edit($id)
    {
        $data['pageTitle'] = 'Edit App Settings';
        $data['appSettingsListActive'] = 'active';
        $data['appSettingsOpend'] = 'menu-open';
        $data['appSettingsOpening'] = 'menu-is-opening';
        $data['data'] = AppSettingsModel::find($id);
        return view('admin.appsettings.edit', $data);
    }
    public function update(Request $request){
        $data = AppSettingsModel::find($request->id);
        $data->update($request->all());
        
        if($request->hasFile('logo') && $request->file('logo')->isValid()){
            // echo"<pre>";
            // print_r($request->all()); die;
            $data->clearMediaCollection('logo');
            $data->addMediaFromRequest('logo')->toMediaCollection('logo');
        }
        session()->flash('msg', 'Successfully saved the data!');
        session()->flash('alert-class', 'alert-success');
        
        return redirect()->route('appSettings.list');
        
    }
    public function delete($id)
    {
        if(AppSettingsModel::find($id)->delete()){
            return 'ok';
        }else{
            return 'notok';
        }
    }
    
    
}
