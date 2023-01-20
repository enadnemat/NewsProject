<?php

namespace App\Traits;


trait HelperTrait{

    public function GetDataWithArray($data , $error_code =1 , $error_msg ="success" ){
        return response()->json([
            'status' => true ,
            'error_code' => $error_code,
            'error_msg' =>$error_msg,
            'data'=>$data
        ]);
    }

    public function ReturnError($error_code =0 , $error_msg ="Not found")
    {
        return response()->json([
            'status' => false ,
            'error_code' =>$error_code,
            'error_msg' =>$error_msg,
            'data'=>null
        ]);
    }


}
