Ntfy Notifier
==================

Provides [Ntfy](https://docs.ntfy.sh/) integration for Symfony Notifier.

DSN example
-----------

```
NTFY_DSN=ntfy://[NTFY_USER:NTFY_PASSWORD]@NTFY_URL[:NTFY_PORT]/NTFY_TOPIC?[secureHttp=[on]]
```

where:
- `NTFY_URL` is the ntfy server which you are using
    - if `default` is provided, this will default to the public ntfy server hosted on [ntfy.sh](https://ntfy.sh/).
- `NTFY_TOPIC` is the topic on this ntfy server.
- `NTFY_PORT` is an optional specific port.
- `NTFY_USER`and `NTFY_PASSWORD` are username and password in case of access control supported by the server

In case of a non-secure server, you can disable https by setting `secureHttp=off`.
