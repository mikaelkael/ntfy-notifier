<?php

namespace Mkk\Component\Notifier\Bridge\Ntfy;

use PHPUnit\Framework\TestCase;

class NtfyOptionsTest extends TestCase
{
    public function testNtfyOptions()
    {
        $ntfyOptions = (new NtfyOptions())
            ->setMessage('test message')
            ;

        $this->assertSame([
            'message' => 'test message',
        ], $ntfyOptions->toArray());
    }
}
