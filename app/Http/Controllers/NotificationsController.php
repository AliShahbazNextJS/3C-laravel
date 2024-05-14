<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NotificationsModel;
use DataTables;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DB;

class NotificationsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:notification-list', ['only' => ['index','update','destroy']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $updateData = ['is_delivered'=>'1', 'is_seen'=>'1'];
            NotificationsModel::where('is_delivered', '0')->update($updateData);

            $data = NotificationsModel::select('id', 'title', 'description', 'is_seen', 'is_delivered')->get();
            return Datatables::of($data)->addIndexColumn()
                ->editColumn('description', function ($row) {
                    // $description = str_replace('<a', '{!! <a', $row->description);
                    // $description = str_replace('</a>', '</a> !!}', $row->description);
                    return $row->description;
                })
                ->addColumn('action', function($row){
                    $url = "/notification/delete/".$row->id;
                    $btn = '<a href="javascript:void(0)" onclick="DeleteMe(this, '."'".$url."'".')" class="btn btn-danger btn-xs btn-delete"><i class="fa fa-trash"></i></a>';
                    // $btn .= ' <a href="'.@url("/meeting/$row->meeting_id/participent".$row->id).'" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>';
                    return $btn;
                })
                ->addColumn('rownum', function ($row) {
                    return '';
                })
                ->rawColumns(['rownum', 'description', 'action'])
                ->make(true);
        }
        $data['pageTitle'] = 'Notifications';
        $data['notificationsListActive'] = 'active';
        $data['notificationsOpening'] = 'menu-is-opening';  
        $data['notificationsOpend'] = 'menu-open';
        return view('admin.notifications.index', $data);
    }
    
    public function update(BlogRequest $request)
    {
        $post = BlogsModel::find($request->id);
        $request['slug'] = Str::slug($request->title);
        $request['user_id'] = auth()->user()->id;
        // dd($request->all());
        // var_dump($request->all()); die;
        $post->update($request->all());
        if($post){
            if($request->hasFile('image') && $request->file('image')->isValid()){
                $post->clearMediaCollection('images');
                $post->addMediaFromRequest('image')->toMediaCollection('images');
            }
            session()->flash('msg', 'Successfully saved the data!');
            session()->flash('alert-class', 'alert-success');
            
            return redirect()->route('blogs');
        }else{
            session()->flash('msg', 'Successfully saved the data!');
            session()->flash('alert-class', 'alert-danger');
            return back();
        }
    }

    
    public function destroy($id)
    {
        $notification = NotificationsModel::find($id);
        if($notification){
            if($notification->delete()){
                return 'ok';
            }else{
                return 'notok';
            }

        }
    }
}

