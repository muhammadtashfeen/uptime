<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Karlmonson\Ping\Ping;
use App\Server;


class PingServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:pingservers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command pings servers in the servers table every minute.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $servers = Server::all();

        $servers->each(function($server){

            $status = $this->isUp($server->server_url);
            
            $message = "Server: " . $server->name . ' with address: ' 
            . $server->server_url. 
            ' is ' . $status . "\n";
        
            $this->info($message);
        

        });
    }

    public function isUp($serverName)
    {
        $health = new Ping();
        $health = $health->check($serverName);

        if($health == 200) {
            return 'up';
        } else {
            return 'down';
        }
    }
}
