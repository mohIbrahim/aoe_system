<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use App\Mail\SendDbBackup;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command backup database.';

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
        $dbUser = env('DB_USERNAME');
        $dbPass = env('DB_PASSWORD');
        $dbName = env('DB_DATABASE');
        $backupName = 'backup'.now()->format('d-m-Y_h-i').'.sql';
        $command = "mysqldump --user=\"$dbUser\" --password=\"$dbPass\" $dbName > ./$backupName";
        // logger($command);
        // dd($dbName);
        $runMysqlCommand = new Process($command);
        $runMysqlCommand->start();
        \Mail::to('moh@moh.com')->send(new SendDbBackup($backupName));
        $process2 = new Process("rm ./$backupName");
        $process2->start();
        

        // logger($command);
    }
}
