<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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
        // $servers = Server::all();

        // $servers->each(function($server){
        //     echo $server->server_url . "\n";
        // });

        $server = new Server();
        $server->name = 'Test';
        $server->server_url = 'http://test.com';
        $status = $server->save();

        $this->info('The server: ' . $server->name . ' is created!');
    }
}
