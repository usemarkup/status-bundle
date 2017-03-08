# Markup Status Bundle

[![CircleCI](https://circleci.com/gh/usemarkup/status-bundle/tree/master.svg?style=svg)](https://circleci.com/gh/usemarkup/status-bundle/tree/master)

Allows for 'checks' to be created to ensure services are working e.g. redis, mysql & rabbitmq.
The configuration allows for groups of checks to be performed by a runner and reported back.

## Similar Projects

- [ZendDiagnostics](https://github.com/zendframework/ZendDiagnostics)
- [LiipMonitorBundle](https://github.com/liip/LiipMonitorBundle)

## Example Configuration
The following example shows how you can create a group of checks called 'basic', its made
up of two checks (redis & rabbitmq). This group also passes an option to be used within the
controller to cache the response within Varnish.

The idea of caching the result of a status check in Varnish can be very useful if multiple
services and provides are all using the same status page. You don't want to spam services anymore
than is required.

Cloudflare health checks for example against a server runs from each edge side location, as of witting this
it would lead to over 80 HEAD requests for a single health check.

```
markup_status:
    groups:
        basic:
            checks:
                - redis.check
                - rabbitmq.check
            options:
                shared_max_age: 20

```

## Visual Status Pages
TBC
