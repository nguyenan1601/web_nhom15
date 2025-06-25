<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CheckUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check users table structure and data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Users table columns:');
        $columns = Schema::getColumnListing('users');
        foreach ($columns as $column) {
            $this->line("- $column");
        }

        $this->info("\nUsers table structure:");
        $structure = DB::select('DESCRIBE users');
        foreach ($structure as $col) {
            $this->line("- {$col->Field}: {$col->Type} ({$col->Null}) {$col->Key}");
        }

        $userCount = DB::table('users')->count();
        $this->info("\nNumber of users: $userCount");

        if ($userCount > 0) {
            $this->info("\nRecent users:");
            $users = DB::table('users')->latest()->take(5)->get(['id', 'name', 'email', 'phone', 'created_at']);
            foreach ($users as $user) {
                $this->line("- ID: {$user->id}, Name: {$user->name}, Email: {$user->email}, Phone: {$user->phone}, Created: {$user->created_at}");
            }
        }
    }
}
