
# Passta

Simple Temporary Token Manager Library that works with split-token based strategy.
This strategy helps us to mitigate side channel timing attack on token verification system.

Inspired by: https://paragonie.com/blog/2017/02/split-tokens-token-based-authentication-protocols-without-side-channels

## Install
 *Please note that PHP 8.1 is required.*

Via Composer

``` bash
composer require falgunphp/passta
```

## Usage
```php
<?php
use Falgun\Passta;
use Falgun\Passta\Hash\DefaultHashDriver;
use Falgun\Passta\Random\DefaultRandomGenerator;

$passta = new Passta(
    new DefaultHashDriver(),
    new DefaultRandomGenerator(),
);

$token = $passta->generate();

/**
* $token object will contain similar to below content
*
* Falgun\Passta\Token\Token Object
* (
*    [selector] => 971ee944fec51494dfa82133a4358989
*    [verifierHash] => 13e726abb996a3605883e312af1e5b2d97c5d9372927e65896ced931d0bb309c
*    [token] => 971ee944fec51494dfa82133a4358989e2f89abe7a7f91ae878f703831852ac0
* )
*
* We need to store both selector & verifierHash in some storage (database) for later usage
* send [token] string to user via mail or other media.
*/



// When user clicks on the link with their [token]
$splitToken = $passta->convertToSplitToken($userProvidedToken);
// $userProvidedToken is the token that we sent to them in previous step

/*
* $splitToken contains a selector and a verifier
* use selector to find verifierHash from storage (database)
* Then attempt to verify the verifierHash with $splitToken
*/

if ($passta->verify($splitToken, $verifierHash)) {
	// user provided token is valid
	// we can proceed to our domain logic
	// don't forget to delete select/verifierHash from storage
} else {
	// invalid token
}
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

