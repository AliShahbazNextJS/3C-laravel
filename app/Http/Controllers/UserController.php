<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete|approve-user', ['only' => ['index','store']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['delete']]);
         $this->middleware('permission:approve-user', ['only' => ['approved', 'unapprove']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::orderBy('id','DESC')->with('roles')->get();
            // echo "<pre>"; print_r($data); die;
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('roles', function ($row) {
                    $roles='';
                    // $mroles = $row->getRoleNames();
                    $firstRole = $row->roles->first();
                    $role = $firstRole?$firstRole->name:'';
                    $roles .='<label class="badge badge-success">'.$role.'</label>';
                    // if(!empty($mroles)){
                    //     foreach($mroles as $v){
                    //         $roles .='<label class="badge badge-success">'.$v.'</label>';
                    //     }
                    // }
                    return $roles ;
                })
                ->addColumn('action', function($row){
                    // $url = "/notification/delete/".$row->id;
                    // $btn = '<a href="javascript:void(0)" onclick="DeleteMe(this, '."'".$url."'".')" class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash"></i></a>';
                    // $btn .= ' <a href="'.@url("/meeting/$row->meeting_id/participent".$row->id).'" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>';
                    $btn='';
                    $firstRole = $row->roles->first();
                    $role = $firstRole?$firstRole->name:'';
                    if($role!='Admin'){
                        if (Gate::allows('approve-user')){
                            $btn .=' <a class="btn btn-xs btn-info" href="'.route('users.show',$row->id).'"><i class="fas fa-eye"></i></a>';
                            if($row->is_approved=='on'){
                            $btn .=' <a class="btn btn-xs btn-primary" href="'.route('users.unapprove',$row->id).'"><i class="fas fa-check"></i></a>';
                            }elseif($row->is_approved=='ban'){
                            $btn .= ' <a class="btn btn-xs btn-danger" href="'.route('users.unapprove',$row->id).'"><i class="fas fa-ban"></i></a>';
                            }else{
                                $btn .= ' <a class="btn btn-xs btn-primary" href="'.route('users.approve',$row->id).'"><i class="fas fa-check"></i></a>';
                            $btn .= ' <a class="btn btn-xs btn-danger" href="'.route('users.unapprove',$row->id).'"><i class="fas fa-ban"></i></a>';
                            }
                        }
                        $btn .= ' <a class="btn btn-xs btn-primary" href="'.route('users.edit',$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
                        $url = route("users.destroy", $row->id);
                        $btn .= ' <a href="javascript:void(0)" onclick="DeleteMe(this, '."'".$url."'".')" class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash"></i></a>';
                    }else{
                        $btn .= ' <a class="btn btn-xs btn-primary" href="'.route('users.edit',$row->id).'"><i class="fas fa-pencil-alt"></i></a>';
                    }   
                    return $btn;
                })

                ->addColumn('rownum', function ($row) {
                    return '';
                })
                ->rawColumns(['rownum','roles', 'action'])
                ->make(true);
        }
        $data['pageTitle'] = 'Users';
        $data['userListActive'] = 'active';
        $data['userOpening'] = 'menu-is-opening';  
        $data['userOpend'] = 'menu-open';
        return view('admin.users.index', $data);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.users.create',compact('roles'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id): View
    // {
    //     $user = User::find($id);
    //     return view('admin.users.show',compact('user'));
    // }
    public function show($id)
    {
        $user = User::find($id);
        if($user){
            $pageTitle = 'View User';
            $userListActive = 'active';
            $userOpening = 'menu-is-opening';
            $userOpend = 'menu-open';
            return view('admin.users.show',compact('user', 'pageTitle', 'userListActive', 'userOpening', 'userOpend'));
        }else{
            return redirect()->route('users.index')
                        ->with('error','User not found');
        }
        
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('admin.users.edit',compact('user','roles','userRole'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_password()
    {
        $user = User::find(Auth::user()->id);
        $pageTitle = 'Change Password';
        $profileActive = 'active';
        $profileOpening = 'menu-is-opening';
        $profileOpend = 'menu-open';
    
        return view('admin.users.change-password',compact('user', 'pageTitle', 'profileActive', 'profileOpening', 'profileOpend'));
    }
    public function update_password(Request $request){
        $validator = Validator::make($request->all(), [
            'old-password' => 'required',
            'password' => 'required|string|min:8|same:confirm-password',
        ]);
        
        if ($validator->fails()) {
            return redirect('change-password')
            ->withErrors($validator)
            ->withInput();
        }
        $user = User::find($request->id);
        if (Hash::check($request->input('old-password'), $user->password)) {
            // Update the user's password with the new password
            $user->password = Hash::make($request->input('password'));
            $user->save();

            // Redirect to a success page or return a response
            return redirect()->back()->with('success', 'Password changed successfully');
        } else {
            // If the current password is incorrect, show an error message
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect'])->withInput();
        }

    }
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            // 'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        // DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        // $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id): RedirectResponse
    // {
    //     User::find($id)->delete();
    //     return redirect()->route('users.index')
    //                     ->with('success','User deleted successfully');
    // }
    public function destroy($id)
    {
        if(User::find($id)->delete()){
            return 'ok';
        }else{
            return 'notok';
        }
    }

    public function approved($id)
    {

        // $settings = AppSettingsModel::create();
        $user = User::find($id);
        // $user->client_id = $settings->id;
        if(($user->is_approved = 'off' || $user->is_approved = 'ban') && $user->license_key == '-1'){
            $user->is_approved = 'on';
            $user->license_key = generateLicenseKey($user->id);
            $user->save();
            $roles = ['User'];
            $user->assignRole($roles);
            return redirect()->route('users.index')->with('success','User approved successfully');
        }else{
            return redirect()->route('users.index')->with('danger','User already approved');
        }
    }

    
    

    public function unapprove($id)
    {
        $user = User::find($id);
        $user->is_approved = 'ban';
        $user->save();
        
        return redirect()->route('users.index')->with('success','User updated successfully');
    }
}
// hal e dil sunao tujh ko
// dekh nashan zda kamar ko
// phir dastan e mazdoor sunao tujh ko
// pichley pehar jab khunak raton me
// kabhi ghar ko laotney ka khayal aya
// thehar gya, k pehley manaon tujh ko
// teri yaad ki cheeseyn uth.ti rahi
// me raton k qiseey kahan sunaon tujh ko
// tu dard e dil se raha hamesha be-khabar
// aor me pagal jhoom jhoom k gaon tujh ko
// be-yaro madadgar a gherha jab arza e dil ne
// me dil ko thama k kabhi to yaad aon tujh ko
// teri yaad rahi  mera ek hamsafar
// to samjhey k bhool paon tujh ko
// tham dil ko k ab teri bari hey
// ankheyn na mond, zakham dekh
// dil o jigar cheer dikhaon tujh ko
?>