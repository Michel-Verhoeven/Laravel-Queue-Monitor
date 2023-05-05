<?php

namespace romanzipp\QueueMonitor\Tests;

use romanzipp\QueueMonitor\Tests\TestCases\DatabaseTestCase;

class QueueWorkerStatusCommandTest extends DatabaseTestCase
{
    public function testQueueWorkerIsRunning(): void
    {
        exec('php artisan queue:work > /dev/null &');

        $respCodeActive = $this->artisan('queue-monitor:worker-status');
        $this->assertEquals(0, $respCodeActive);

        exec('pkill -f "php artisan queue:work"');

        $respCodeInactive = $this->artisan('queue-monitor:worker-status');
        $this->assertEquals(1, $respCodeInactive);
    }

    public function testQueueWorkerIsNotRunning(): void
    {
        $respCode = $this->artisan('queue-monitor:worker-status');

        $this->assertEquals(1, $respCode);
    }
}
