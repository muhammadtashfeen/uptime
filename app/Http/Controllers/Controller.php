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
            return ['status' => 'up' ];
        } else {
            return ['status' => 'down' ];
        }
    }

    public function create(Request $request)
    {
        $serverName  = $request->get('name');
        $serverUrl = $request->get('server_url');

        $server = new Server();
        $server->name = $serverName;
        $server->server_url = $serverUrl;
        $status =  $server->save();

        return [
            'isSaved' => $status
        ];
    }

    public function update(Request $request)
    {
        $serverName  = $request->get('name');
        $serverUrl = $request->get('server_url');

        $server = Server::find($request->get('id'));

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
    public function delete(Request $request)
    {
        $server = Server::find($request->get('id'));
        return [
            'isDeleted' => $server->delete()
        ];
    }

}
