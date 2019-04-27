<?php

namespace App\Http\Controllers;

use App\Server;
use App\Ping\Ping;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

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

    public function pingDetails($url = 'http://www.google.com')
    {
        $health = new Ping();
        $health = $health->pingWithResponseTime($url);

        if($health['code'] == 200) {
            return [
                'status' => 'up',
                'responseTime' => $health['responseTime'],
                'serverType'   => $health['serverType'],
            ];
        } else {
            return [
                'status' => 'down',
                'responseTime' => $health['responseTime'],
                'serverType'   => $health['serverType'],
            ];
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

    public function findById($id)
    {
        $server = Server::where('id', $id)->first();
        return $server;
    }

    public function delete(Request $request)
    {
        $server = Server::find($request->get('id'));
        return [
            'isDeleted' => $server->delete()
        ];
    }

}
