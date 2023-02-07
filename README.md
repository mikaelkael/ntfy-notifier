Ntfy Notifier
=============

[![Build Status](https://github.com/mikaelkael/ntfy-notifier/workflows/Build/badge.svg)](https://github.com/mikaelkael/ntfy-notifier/actions)
[![License](https://poser.pugx.org/mikaelkael/ntfy-notifier/license.png)](https://packagist.org/packages/mikaelkael/ntfy-notifier)

Provides [Ntfy](https://docs.ntfy.sh/) integration for Symfony Notifier.

DSN example
-----------

```
# .env
NTFY_DSN=ntfy://[NTFY_USER:NTFY_PASSWORD]@NTFY_URL[:NTFY_PORT]/NTFY_TOPIC?[secureHttp=[on]]
```

where:
- `NTFY_URL` is the ntfy server which you are using
    - if `default` is provided, this will default to the public ntfy server hosted on [ntfy.sh](https://ntfy.sh/).
- `NTFY_TOPIC` is the topic on this ntfy server.
- `NTFY_PORT` is an optional specific port.
- `NTFY_USER`and `NTFY_PASSWORD` are username and password in case of access control supported by the server

In case of a non-secure server, you can disable https by setting `secureHttp=off`.

Enable texter
-------------

```
# config/packages/notifier.yaml
framework:
    notifier:
        texter_transports:
            nfty: '%env(NTFY_DSN)%'
```

Send push message
-----------------

```
// src/Controller/TestController.php
namespace App\Controller;

use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\TexterInterface;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    /**
     * @Route("/test")
     */
    public function test(TexterInterface $texter)
    {
        $pushMessage = new PushMessage(
            'Title',
            'Message content',
            new NtfyOptions(['tags' => ['warning'], 'priority' => 5])
        );
        $result = $texter->send($pushMessage);

        // ...
    }
}
```