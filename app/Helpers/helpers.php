<?php

use App\Models\AppSettingsModel;

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
}

?>