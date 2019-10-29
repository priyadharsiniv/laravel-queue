<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendMail;
use Carbon\Carbon;


class HomeController extends Controller
{

    /**
     * Send mail using queue
     * 
     * @param object $request
     * 
     * @return string $response
     */
    public function index(Request $request)
    { 
        //create array of data to pass in queue function that is need for mail or you can get data from blade using $request
        $data = array(
                'name' => 'Priya',
                'email' => 'priya@sparkouttech.com',
                'subject' => 'Welcome using Queue',
                'content' => 'Sent mail using laravel queue with time delay'    
            );

        //initiate job class with required details
        $job = (new SendMail($data))->delay(Carbon::now()->addSeconds(60));
        dispatch($job);

        echo "job dispatched";
    }
}
