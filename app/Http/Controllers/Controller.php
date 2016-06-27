<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function respondWithSuccess($extras = [], $message = "")
    {
        $data = [];

        foreach ($extras as $key => $val) {
            $data[$key] = $val;
        }

        $data['result'] = 1;
        $data['message'] = $message;

        return Response()->json($data);
    }

    public function respondWithError($extras, $message = "")
    {
        $data = [];

        foreach ($extras as $key => $val) {
            $data[$key] = $val;
        }

        $data['result'] = 0;
        $data['message'] = $message;

        return Response()->json($data);
    }

    public function respondWithWarning($extras, $message = "")
    {
        $data = [];

        foreach ($extras as $key => $val) {
            $data[$key] = $val;
        }

        $data['result'] = 2;
        $data['message'] = $message;

        return Response()->json($data);
    }
}
