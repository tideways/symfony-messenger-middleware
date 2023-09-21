# Tideways Middleware for Symfony Messenger

This package is currently under development and might be moved into the
Tideways PHP Extension or stay independent. Consider it as prototype.

This middleware for Symfony Messenger starts a Tideways trace for every
processed message, names the trace after the message class and implements
integration with Tideways exception tracking.

[Tideways](https://tideways.com) is a monitoring, profiling and exception tracking combo for PHP.

## Installation

```
composer require tideways/symfony-messenger-middleware
```

## Configuration for Symfony

```yaml
framework:
  messenger:
    buses:
      default:
        middleware:
          - "Tideways\\SymfonyMessenger\\TidewaysOnlyConsumedByWorkerMiddleware"

services:
  "Tideways\\SymfonyMessenger\\TidewaysOnlyConsumedByWorkerMiddleware": ~
```

## Configuration for Shopware 6.5

Shopware uses the Symfony Messenger under the hood and using this middleware
requires just a slightly different configuration:

```yaml
# config/packages/messenger.yaml
framework:
  messenger:
    # here are other sections "transport", "routing" already configured by Shopware.

    buses:
      messenger.bus.default:
        middleware:
          - "Tideways\\SymfonyMessenger\\TidewaysOnlyConsumedByWorkerMiddleware"

services:
  "Tideways\\SymfonyMessenger\\TidewaysOnlyConsumedByWorkerMiddleware": ~
```

## Configuration for Shopware 6.4

Shopware uses the Symfony Messenger under the hood and using this middleware
requires just a slightly different configuration:

```yaml
# config/packages/messenger.yaml
framework:
  messenger:
    # here might be other config values already "transports" and "routing".

    buses:
      messenger.bus.shopware:
        middleware:
          - "Shopware\\Core\\Framework\\MessageQueue\\Middleware\\RetryMiddleware"
          - "Tideways\\SymfonyMessenger\\TidewaysOnlyConsumedByWorkerMiddleware"

services:
  "Tideways\\SymfonyMessenger\\TidewaysOnlyConsumedByWorkerMiddleware": ~
```
