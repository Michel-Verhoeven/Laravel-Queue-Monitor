<?php

namespace romanzipp\QueueMonitor\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class CheckIfQueueWorkerIsRunningCommand extends Command
{
    protected $signature = 'queue-monitor:worker-status';

    protected $description = 'Checks if queue worker is running or not';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $process = Process::fromShellCommandline('ps -aux | grep queue');

        $processOutput = '';

        $captureOutput = function ($type, $line) use (&$processOutput) {
            $processOutput .= $line;
        };

        $process->setTimeout(null)->run($captureOutput);

        if (str_contains($processOutput, 'queue:work') || str_contains($processOutput, 'queue:listen')) {
            $this->info('Queue worker is running.');

            return Command::SUCCESS;
        } else {
            $this->error('Queue worker is not running.');

            return Command::FAILURE;
        }
    }
}
