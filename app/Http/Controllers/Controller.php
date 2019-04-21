<?php

namespace App\Http\Controllers;

use App\Server;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Karlmonson\Ping\Ping;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function ping(Request $request)
    {
        $health = new Ping();
        $health = $health->check($request->get('serverUrl'));

        if($health == 200) {
            return ['status' => 'Active' ];
        } else {
            return ['status' => 'Down' ];
        }
    }

    public function create(Request $request)
    {
        $serverUrl  = $request->get('name');
        $serverName = $request->get('server_url');

        $server = new Server();
        $server->name = $serverName;
        $server->server_url = $serverUrl;
        $status =  $server->save();

        return [
            'isSaved' => $status
        ];
    }

    public function all()
    {
        $servers = Server::all();
        return $servers;
    }
}
