Ntfy Notifier
=============

[![Build Status](https://github.com/mikaelkael/ntfy-notifier/workflows/Build/badge.svg)](https://github.com/mikaelkael/ntfy-notifier/actions)
[![License](https://poser.pugx.org/mikaelkael/ntfy-notifier/license.png)](https://packagist.org/packages/mikaelkael/ntfy-notifier)

Provides [Ntfy](https://docs.ntfy.sh/) integration for Symfony Notifier. The component should be introduced in Symfony 6.4 with this [PR #50131](https://github.com/symfony/symfony/pull/50131). This bundle provides same functionalities for Symfony 5.4.x to 6.3.x.

DSN example
-----------

```
# .env
NTFY_DSN=ntfy://[USER:PASSWORD]@default[:PORT]/TOPIC?[secureHttp=[on]]
```

where:
- `URL` is the ntfy server which you are using
    - if `default` is provided, this will default to the public ntfy server hosted on [ntfy.sh](https://ntfy.sh/).
- `TOPIC` is the topic on this ntfy server.
- `PORT` is an optional specific port.
- `USER`and `PASSWORD` are username and password in case of access control supported by the server

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