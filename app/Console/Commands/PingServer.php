<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Karlmonson\Ping\Ping;
use App\Mail\NotifyUser;
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

            
            if ($server->is_up) {
                // Usecase 1
                // If is_up is true then ping server    
                $isUp = $this->isUp($server->server_url);
                
                if(!$isUp) {
                    
                    $server->is_up = false;
                    $server->save();

                    $message = "Server: " . $server->name . ' with address: ' 
                    . $server->server_url. " is down! \n";
                    $this->info($message);
                    \Mail::to('muhammad.tashfeen.amin@gmail.com')->send(new NotifyUser($server));

                } 

            } else {
                // Usecase 2
                // If is_up is false then ping server again
                $isUp = $this->isUp($server->server_url);
                if($isUp) {

                    $server->is_up = true;
                    $server->save();      
                    
                    $message = "Server: " . $server->name . ' with address: ' 
                    . $server->server_url. " is up again! \n";
                    $this->info($message);  
                    \Mail::to('muhammad.tashfeen.amin@gmail.com')->send(new NotifyUser($server));

                }    
            }            
        
        });
    
    }

    public function isUp($serverName)
    {
        $health = new Ping();
        $health = $health->check($serverName);

        if($health == 200) {
            return true;
        } 
        return false;    
    }
}
