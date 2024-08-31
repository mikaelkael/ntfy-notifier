<?php

namespace Mkk\NtfyBundle\Tests;

use Mkk\NtfyBundle\Transport\NtfyTransportFactory;
use Symfony\Component\Notifier\Test\TransportFactoryTestCase;
use Symfony\Component\Notifier\Transport\TransportFactoryInterface;

class NtfyTransportFactoryTest extends TransportFactoryTestCase
{

    public function createFactory(): TransportFactoryInterface
    {
        return new NtfyTransportFactory();
    }

    public static function createProvider(): iterable
    {
        yield [
            'ntfy://ntfy.sh/test',
            'ntfy://user:password@default/test',
        ];
        yield [
            'ntfy://ntfy.sh/test',
            'ntfy://:password@default/test',
        ];
        yield [
            'ntfy://ntfy.sh:8888/test',
            'ntfy://user:password@default:8888/test?secureHttp=off',
        ];
    }

    public static function supportsProvider(): iterable
    {
        yield [true, 'ntfy://default/test'];
        yield [false, 'somethingElse://default/test'];
    }

    public static function unsupportedSchemeProvider(): iterable
    {
        yield ['somethingElse://default/test'];
    }
}
