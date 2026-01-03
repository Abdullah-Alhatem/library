<?php

namespace App;

class ResponseHelper{
    static function success($message ="تمت العملية بنجاح" , $data = null){
        return [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];
    }
    static function failed($message ="فشلت العملية" , $data = null){
        return [
            'success' => false,
            'message' => $message,
            'data' => $data,
        ];
    }
}
