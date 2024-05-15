<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SongResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Packages;

class CompaniesController extends Controller
{
    function index($searchStr=null)
    {
        $perPage = request('per_page', 10);
        if($searchStr){
            $this->data = Packages::whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($searchStr) . '%'])
            ->orderBy('id', 'desc')
            ->paginate($perPage);
        }else{
            $this->data = Packages::orderBy('id', 'desc')->paginate($perPage);
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'price' => 'required|max:255',
            'duration' => 'required|numeric',
            'short_description' => 'required',
            'long_description' => 'required',
        ]);

        if ($validator->fails())
            $this->responsee(false, $validator->errors());
        else{
            $this->data = Packages::create($request->all());
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
            $this->data = Packages::find($id);
            if($this->data)
                $this->responsee(true);
            else
                $this->responsee(false, $this->d_err);
        }else
            $this->responsee(false, $this->id_err);
        return json_response($this->resp, $this->httpCode);
    }
    public function update(Request $request, $id)
    {
        $input = $request->all();
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'price' => 'required|max:255',
            'duration' => 'required|numeric',
            'short_description' => 'required',
            'long_description' => 'required',
        ]);

        if ($validator->fails())
            $this->responsee(false,$validator->errors());
        else{
            $this->data = Packages::find($id);
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
            $this->data = Packages::find($id);
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

