<?php

namespace App\Console\Commands;

use App\Models\Books;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-books';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        $expiration = Books::whereDate('due_date', '<', $today)->where('active', true)->get();

        foreach($expiration as $book)
        {
            $book->active = false;
            $book->save();
        }

        $this->info('Se desactivaron ' .$expiration->count() . ' los siguientes libros');


    }
}
