<?php

namespace App\Traits;


trait ApiResponser
{

    private function successResponse($data, $code){
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code){
        return response()->json(['error'=>$message,'code'=>$code], $code);
    }

    protected function showAll($collection, $code=200){
        return $this->successResponse($collection,$code);
    }

    protected function showOne($result, $code=200){
        return $this->successResponse($result,$code);

    }
}