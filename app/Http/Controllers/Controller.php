<?php

namespace App\Http\Controllers;

use App\Actions\ManagerActions;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param ManagerActions $manager
     * @param null $success_message
     * @return \App\Http\Response\RestResponse
     */
    protected function run(ManagerActions $manager, $success_message = null)
    {
        $passes = $manager->run();

        if ($passes) {

            return rest_response([
                'message' => $success_message
            ]);
        }

        return rest_response($manager->errors(), 422);
    }
}
