<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SongResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Song;

class SongsController extends Controller
{
    
    function index($searchStr=null)
    {
        $perPage = request('per_page', 10);
        if($searchStr){
            $this->data = Song::where('user_id', auth()->user()->id)
            ->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($searchStr) . '%'])
            ->orderBy('id', 'desc')
            ->paginate($perPage);
        }else{
            $this->data = Song::orderBy('order_by', 'asc')->orderBy('id', 'desc')->where('user_id', auth()->user()->id)->paginate($perPage);
            // $songs = Song::orderBy('id', 'desc')->where('user_id', auth()->user()->id)->paginate($perPage);
            // $data = SongResource::collection($songs);
            // $this->data = $data->response()->getData(true);
            // $this->data = SongResource::collection($songs);
            /*$this->data = [
                'data' => $data,
                'pagination' => [
                    'total' => $songs->total(),
                    'per_page' => $songs->perPage(),
                    'current_page' => $songs->currentPage(),
                    'last_page' => $songs->lastPage(),
                    'from' => $songs->firstItem(),
                    'to' => $songs->lastItem(),
                ],
            ]; */
        }
        if($this->data){
            $this->responsee(true);
        }
        else{
            $this->responsee(false, $this->d_err);
        }
        return json_response($this->resp, $this->httpCode);
    }
    
    function store(Request $request)
    {
        $request->merge(['user_id' => auth()->user()->id]);
        $request->merge(['order_by' => Song::max('order_by') + 1]);
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'user_id' => 'required',
        ]);

        if ($validator->fails())
            $this->responsee(false, $validator->errors());
        else{
            $this->data = Song::create($request->all());
            if($this->data){
                $this->responsee(true);
            }
            else{
                $this->responsee(false);
            }
        }
        return json_response($this->resp, $this->httpCode);
    }
    
    
    public function edit($id)
    {
        if($id){
            $this->data = Song::where('user_id', auth()->user()->id)->find($id);
            if($this->data)
                $this->responsee(true);
            else
                $this->responsee(false, $this->d_err);
        }else
            $this->responsee(false, $this->id_err);
        return json_response($this->resp, $this->httpCode);
    }
    public function reorderSongs(Request $request)
    {
        $newOrder = $request->input('new_order');
        // $startPosition = $request->input('start_position');
        // $endPosition = $request->input('end_position');

        foreach ($newOrder as $index => $songId) {
            // Update the order_by value for each song
            Song::where('id', $songId)->update(['order_by' => $index+1]);
        }

        return response()->json(['message' => 'Songs reordered successfully']);
    }
   
    public function update(Request $request)
    {
        $input = $request->all();
        
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);

        if ($validator->fails())
            $this->responsee(false,$validator->errors());
        else{
            $this->data = Song::where('user_id', auth()->user()->id)->find($request->id);
            if($this->data){
                if($this->data->update($request->all()))
                    $this->responsee(true);
                else
                    $this->responsee(false, $this->w_err);
            }else
                $this->responsee(false, $this->d_err);
        }
        return json_response($this->resp, $this->httpCode);
    }
    public function delete($id)
    {
        if($id){
            $this->data = Song::where('user_id', auth()->user()->id)->find($id);
            if($this->data){
                if($this->data->delete()){
                    $this->responsee(true);
                    
                }
                else
                    $this->responsee(false, $this->w_err);
            }else
                $this->responsee(false, $this->d_err);
        }else
            $this->responsee(false, $this->id_err);
        return json_response($this->resp, $this->httpCode);
    }
}

