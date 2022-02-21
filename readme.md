# Pizza Test

## Requirements

- Docker Engine

## Getting started

```
# Install dependencies
$ sh composer.sh install

# Launch application
$ docker compose up -d --build
```
        
## Visit the Pizza Test website

- http://localhost:8133

You should see a skeleton website with the message:

    Nice! You're set, good luck with the test.

## Execute unit tests

```
$ sh phpunit.sh tests
```
