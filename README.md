# PHP MusicBrainz API Wrapper

### This package is being actively developed. Only the lookup method has been completely implemented.

[![Build Status](https://travis-ci.org/chrismou/php-musicbrainz-wrapper.svg?branch=master)](https://travis-ci.org/chrismou/php-musicbrainz-wrapper)
[![Test Coverage](https://codeclimate.com/github/chrismou/php-musicbrainz-wrapper/badges/coverage.svg)](https://codeclimate.com/github/chrismou/php-musicbrainz-wrapper/coverage)
[![Code Climate](https://codeclimate.com/github/chrismou/php-musicbrainz-wrapper/badges/gpa.svg)](https://codeclimate.com/github/chrismou/php-musicbrainz-wrapper)
[![Buy me a beer](https://img.shields.io/badge/donate-PayPal-019CDE.svg)](https://www.paypal.me/chrismou)

A simple wrapper class for the MusicBrainz API.

## Installation

Once the library is stable, it'll be added to packagist. Until then, you can access it by setting a custom repository in your composer.json.

First, add a reference to the package:

```
"require": {
    "chrismou/musicbrainz": "dev-master"
}
```

Next, add a custom repository:

```
"repositories": [
    {
        "type": "vcs",
        "name": "chrismou/musicbrainz",
        "url": "https://github.com/chrismou/php-musicbrainz-wrapper"
    }
]
```

Now, running `composer update` should pull in the development package

## Usage

Docs to followw

## Tests

To run the unit test suite:

```
curl -s https://getcomposer.org/installer | php
php composer.phar install
./vendor/bin/phpunit
```

If you use docker, you can also run the test suite against all supported PHP versions:
```
./vendor/bin/dunit
```

## License

Released under the MIT License. See [LICENSE](LICENSE.md).
