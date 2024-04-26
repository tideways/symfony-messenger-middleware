# Tideways Middleware for Symfony Messenger

This middleware for Symfony Messenger starts a Tideways trace for every
processed message, names the trace after the message class and implements
integration with Tideways exception tracking.

If you want to see traces for processed messages, then the INI setting `tideways.enable_cli=1` must be set.

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

## Configuration for TYPO3

TYPO3 uses the Symfony Messenger under the hood and using this middleware
requires just a slightly different configuration:

```yaml
# YOUR_EXTENSION/Configuration/Services.yaml
services:
  Tideways\SymfonyMessenger\TidewaysOnlyConsumedByWorkerMiddleware:
    tags:
      - name: 'messenger.middleware'
        before: 'Symfony\Component\Messenger\Middleware\SendMessageMiddleware'
  ```
