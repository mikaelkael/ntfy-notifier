<?php

declare(strict_types=1);

namespace Mkk\NtfyBundle\Transport;

use Symfony\Component\Notifier\Exception\UnsupportedSchemeException;
use Symfony\Component\Notifier\Transport\AbstractTransportFactory;
use Symfony\Component\Notifier\Transport\Dsn;
use Symfony\Component\Notifier\Transport\TransportInterface;

final class NtfyTransportFactory extends AbstractTransportFactory
{
    public function create(Dsn $dsn): TransportInterface
    {
        if ('ntfy' !== $dsn->getScheme()) {
            throw new UnsupportedSchemeException($dsn, 'ntfy', $this->getSupportedSchemes());
        }

        $host = 'default' === $dsn->getHost() ? null : $dsn->getHost();
        $topic = \substr($dsn->getPath(), 1);

        if (\in_array($dsn->getOption('secureHttp', true), [0, false, 'false', 'off', 'no'])) {
            $secureHttp = false;
        } else {
            $secureHttp = true;
        }

        $transport = (new NtfyTransport($topic, $secureHttp))->setHost($host);
        if (!empty($port = $dsn->getPort())) {
            $transport->setPort($port);
        }

        if (!empty($user = $dsn->getUser()) && !empty($password = $dsn->getPassword())) {
            $transport->setUser($user);
            $transport->setPassword($password);
        }

        return $transport;
    }

    protected function getSupportedSchemes(): array
    {
        return ['ntfy'];
    }
}
