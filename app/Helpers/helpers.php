<?php

use App\Models\AppSettingsModel;
use Tymon\JWTAuth\Facades\JWTAuth;

function json_response($response = array(), $code = 201)
{
    // var_dump($response);die;
    // return response(['a'=>'ahad','b'=>'bahadur','c'=>'chniot'],200);
    return response()->json($response, $code);
}
if (!function_exists('getAppSettings')) {
    function getAppSettings($select=null)
    {
        if($select){
            return AppSettingsModel::select($select)->where('id', 1)->first();
        }else{
            return AppSettingsModel::select('*')->where('id', 1)->first();
        }
    }
}

if (!function_exists('generateLicenseKey')) {
    /**
     * Generate a unique license key.
     *
     * @param int $length
     * @param string $prefix
     * @return string
     */
    function generateLicenseKey($prefix = 'KEY-', $length = 16)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $prefix . $randomString;
    }
    function generateKey(): string
    {
        // Generate 16 bytes of random data (128 bits)
        $randomBytes = random_bytes(16);
        
        // Convert the random bytes to a hexadecimal string
        $licenseKey = bin2hex($randomBytes);

        return $licenseKey;
    }

    // Function to create a JWT containing the encrypted data
    function createLicenseKey($request)
    {
        $customClaims = [
            'data' => [
                'legal_name'=>$request->legal_name,
                'email'=>$request->email,
                'user_id'=>$request->user_id,
                'contact'=>$request->contact,
                'head_office_address'=>$request->head_office_address,
                'city'=>$request->city,
                'state'=>$request->state,
                'country'=>$request->country,
                'active_users'=>$request->active_users,
                'is_trial'=>$request->is_trial,
                'start_date'=>$request->starting_date,
                'expairy_date'=>$request->expiry_date,
            ],
            'sub' => $request->email,
        ];
        $payload = JWTFactory::customClaims($customClaims)->make();

        $keyBytes = base64_encode(env('JWT_SECRET'));

        $token = JWTAuth::encode($payload, $keyBytes, 'HS256');
        return $token;
    }

    // Function to decrypt the JWT to retrieve data
    function decryptLicenseKey($token)
    {
        // Decode the token to get the payload data
        $data = JWTAuth::setToken($token)->getPayload();

        return $data;
    }
}

?>