<?php

namespace Mkk\NtfyBundle\Tests;

use Mkk\NtfyBundle\Message\NtfyOptions;
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
