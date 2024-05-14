<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\RecentlyPlayed;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        // return response()->json(Auth::user()->id);

        $data['pageTitle'] = 'Dashboard';
        $data['dashboard'] = 'active';
        $data['dashboardOpend'] = 'menu-open';
        $data['dashboardOpening'] = 'menu-is-opening';
        if(Auth::user()->hasRole('Admin')){
            $data['users'] = Role::where('name', 'User')->first()->users->count();
            $data['onlineUsers'] = Role::where('name', 'User')->first()->users->where('is_online', 1)->count();
            $data['playlists'] = Playlist::count();
            $data['songs'] = Song::count();
        }else{
            $data['playlists'] = Playlist::where('user_id', Auth::user()->id)->count();
            $data['songs'] = Song::where('user_id', Auth::user()->id)->count();
            $data['recentlyPlayed'] = RecentlyPlayed::where('user_id', Auth::user()->id)->count();
            // license_key
            // $data['songs'] = Song::count();
        //     $data['producers'] = User::whereHas('roles', function ($query) {
        //             $query->where('client_id', Auth::user()->client_id)->where('name', 'Producer');
        //         })->count();
        //     $data['clients'] = User::whereHas('roles', function ($query) {
        //         $query->where('client_id', Auth::user()->client_id)->where('name', 'Client');
        //     })->count();
        //     $data['meetings'] = MeetingModel::where('client_id', Auth::user()->client_id)->count();
        //     $data['todayMeetings'] = MeetingModel::whereDate('start', Carbon::today())->where('client_id', Auth::user()->client_id)->count();
        }
        // echo"<pre>";
        // print_r($data['producers']); die;
        return view('admin.dashboard', $data);
    }
    
    public function admin()
    {
        $data['pageTitle'] = 'Dashboard';
        $data['dashboard'] = 'active';
        $data['dashboardOpend'] = 'menu-open';
        $data['dashboardOpening'] = 'menu-is-opening';
        // if(Auth::user()->hasRole('Admin')){
        //     $data['producers'] = Role::where('name', 'Producer')->first()->users->count();
        //     $data['clients'] = Role::where('name', 'Client')->first()->users->count();
        //     $data['meetings'] = MeetingModel::count();
        //     $data['todayMeetings'] = MeetingModel::whereDate('start', Carbon::today())->count();
        // }else{
        //     $data['producers'] = User::whereHas('roles', function ($query) {
        //             $query->where('client_id', Auth::user()->client_id)->where('name', 'Producer');
        //         })->count();
        //     $data['clients'] = User::whereHas('roles', function ($query) {
        //         $query->where('client_id', Auth::user()->client_id)->where('name', 'Client');
        //     })->count();
        //     $data['meetings'] = MeetingModel::where('client_id', Auth::user()->client_id)->count();
        //     $data['todayMeetings'] = MeetingModel::whereDate('start', Carbon::today())->where('client_id', Auth::user()->client_id)->count();
        // }
        // echo"<pre>";
        // print_r($data['producers']); die;
        return view('admin.dashboard', $data);
    }
}
