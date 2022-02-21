#!/usr/bin/env bash

cd "$(dirname "$0")"

docker run --rm -it -v "$(pwd -P):/app" composer "$@"
