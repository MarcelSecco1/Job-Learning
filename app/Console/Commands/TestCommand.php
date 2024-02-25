<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $executed = RateLimiter::attempt(
            'test:command',
            $maxTries = 3,
            function () {
                $this->info('Command executed');
            },
            $decaySeconds = 120
        );

        if (!$executed) {
            $seconds = RateLimiter::availableIn('test:command');
            $this->info('Command not executed. Try again in ' . $seconds . ' seconds.');
        }
    }
}
