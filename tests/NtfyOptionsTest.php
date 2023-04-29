<?php

namespace Mkk\NtfyBundle\Tests;

use Mkk\NtfyBundle\Message\NtfyOptions;
use PHPUnit\Framework\TestCase;

class NtfyOptionsTest extends TestCase
{
    public function testNtfyOptions(): void
    {
        $delay = (new \DateTime())->add(new \DateInterval('PT1M'));
        $ntfyOptions = (new NtfyOptions())
            ->setMessage('test message')
            ->setTitle('message title')
            ->setPriority(NtfyOptions::PRIORITY_URGENT)
            ->setTags(['tag1', 'tag2'])
            ->addTag('tag3')
            ->setDelay($delay)
            ->setActions([['action' => 'view', 'label' => 'View', 'url' => 'https://test.com']])
            ->addAction(['action' => 'http', 'label' => 'Open', 'url' => 'https://test2.com'])
            ->setClick('https://test3.com')
            ->setAttachment('https://filesrv.lan/space.jpg')
            ->setFilename('diskspace.jpg')
            ->setEmail('me@mail.com')
            ->setCache(false)
            ->setFirebase(false)
        ;

        $this->assertSame([
            'message' => 'test message',
            'title' => 'message title',
            'priority' => NtfyOptions::PRIORITY_URGENT,
            'tags' => ['tag1', 'tag2', 'tag3'],
            'delay' => (string) $delay->getTimestamp(),
            'actions' => [
                ['action' => 'view', 'label' => 'View', 'url' => 'https://test.com'],
                ['action' => 'http', 'label' => 'Open', 'url' => 'https://test2.com'],
            ],
            'click' => 'https://test3.com',
            'attach' => 'https://filesrv.lan/space.jpg',
            'filename' => 'diskspace.jpg',
            'email' => 'me@mail.com',
            'cache' => 'no',
            'firebase' => 'no',
        ], $ntfyOptions->toArray());
    }
}
