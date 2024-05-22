<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompaniesResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Companies;
use Illuminate\Support\Facades\Response;

class CompaniesController extends Controller
{
    function index($searchStr=null)
    {
        $perPage = request('per_page', 10);
        if($searchStr){
            $data = Companies::with('user')->whereRaw('LOWER(legal_name) LIKE ?', ['%' . strtolower($searchStr) . '%'])
            ->orderBy('id', 'desc')
            ->paginate($perPage);
        }else{
            $data = Companies::with('user')->orderBy('id', 'desc')->paginate($perPage);
        }
        $this->data = CompaniesResource::collection($data);
        if($this->data){
            $this->data = [
                'data' => $this->data,
                'pagination' => [
                    'total' => $data->total(),
                    'per_page' => $data->perPage(),
                    'current_page' => $data->currentPage(),
                    'last_page' => $data->lastPage(),
                    'from' => $data->firstItem(),
                    'to' => $data->lastItem(),
                ],
            ];  
            
            $this->responsee(true);
        }
        else{
            $this->responsee(false, $this->d_err);
        }
        return json_response($this->resp, $this->httpCode);
    }
    
    function store(Request $request)
    {
        // $request->merge(['license_key' => generateKey()]);
        $validator = Validator::make($request->all(), [
            'legal_name'                    => 'required|max:225|string',
            'email'                         => 'required|email|unique:companies,email|max:255',
            'user_id'                       => 'required|integer',
            'contact'                       => 'required|string|unique:companies,contact|max:255',
            'head_office_address'           => 'required|string|max:255',
            'city'                          => 'required|string|max:255',
            'state'                         => 'required|string|max:255',
            'country'                       => 'required|string|max:255',
            'contact_person'                => 'required|string|max:255',
            'contact_person_designation'    => 'required|string|max:255',
            'contact_person_phone'          => 'required|string|max:20',
            'contact_person_email'          => 'required|email|max:255',
            'website'                       => 'nullable|url|max:255',
            'industry'                      => 'required|string|max:255',
            'status'                        => 'required|in:active,inactive',
            'founded_date'                  => 'nullable|date',
            'number_of_employees'           => 'nullable|integer',
            'active_users'                  => 'nullable|integer',
            'is_trial'                      => 'nullable|boolean',
            'start_date'                    => 'nullable|date',
            'expiry_date'                   => 'nullable|date',
        ]);

        if ($validator->fails())
            $this->responsee(false, $validator->errors());
        else{
            $license_key = createLicenseKey($request);
            // $payload = decryptLicenseKey($license_key)->toArray();
            
            // print_r($payload['data']['legal_name']); die;
            $request->merge(['license_key' => $license_key]);
            $this->data = Companies::create($request->all());
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
            $this->data = Companies::find($id);
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
        // $input = $request->all();
        $validator = Validator::make($request->all(), [
            'legal_name'                    => 'required|max:225|string',
            'email'                         => 'required|email|max:255|unique:companies,email,'.$id,
            'contact'                       => 'required|string|max:255|unique:companies,contact,'.$id,
            'user_id'                       => 'required|integer',
            'head_office_address'           => 'required|string|max:255',
            'city'                          => 'required|string|max:255',
            'state'                         => 'required|string|max:255',
            'country'                       => 'required|string|max:255',
            'contact_person'                => 'required|string|max:255',
            'contact_person_designation'    => 'required|string|max:255',
            'contact_person_phone'          => 'required|string|max:20',
            'contact_person_email'          => 'required|email|max:255',
            'website'                       => 'nullable|url|max:255',
            'industry'                      => 'required|string|max:255',
            'status'                        => 'required|in:active,inactive',
            'founded_date'                  => 'nullable|date',
            'number_of_employees'           => 'nullable|integer',
        ]);

        if ($validator->fails())
            $this->responsee(false,$validator->errors());
        else{
            $this->data = Companies::find($id);
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
            $this->data = Companies::find($id);
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

