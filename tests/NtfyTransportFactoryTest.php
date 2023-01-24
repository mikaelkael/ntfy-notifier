<?php

namespace Mkk\Component\Notifier\Bridge\Ntfy;

use Symfony\Component\Notifier\Test\TransportFactoryTestCase;

class NtfyTransportFactoryTest extends TransportFactoryTestCase
{

    public function createFactory(): NtfyTransportFactory
    {
        return new NtfyTransportFactory();
    }

    public function createProvider(): iterable
    {
        yield [
            'ntfy://ntfy.sh/test',
            'ntfy://user:password@default/test',
        ];
        yield [
            'ntfy://ntfy.sh:8888/test',
            'ntfy://user:password@default:8888/test?secureHttp=off',
        ];
    }

    public function supportsProvider(): iterable
    {
        yield [true, 'ntfy://default/test'];
        yield [false, 'somethingElse://default/test'];
    }

    public function unsupportedSchemeProvider(): iterable
    {
        yield ['somethingElse://default/test'];
    }
}
