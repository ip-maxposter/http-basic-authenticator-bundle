# Symfony Http Basic Authenticator Bundle
This bundle will help you to add `http basic authentication`, with custom credentials checkers and custom response, in to you project.

[![SensioLabsInsight][sensiolabs-insight-image]][sensiolabs-insight-link]

[![License][license-image]][license-link]
[![Build Status][build-image]][build-link]

Installation
------------
* Require the bundle with composer:

``` bash
composer require symfony-notes/http-basic-authenticator-bundle
```

* Enable the bundle in the kernel:

``` php
public function registerBundles()
{
    $bundles = [
        // ...
        new SymfonyNotes\HttpBasicAuthenticatorBundle\SymfonyNotesHttpBasicAuthenticatorBundle(),
        // ...
    ];
    ...
}
```

* Enable the authenticator in `security.yml`

``` yml
security:
    ...
    firewalls:
        ...
        default:
            guard:
                authenticators:
                    - notes.http_basic_authenticator
```

Configuration
-------------
Default bundle configuration:

``` yml
notes_http_basic_authenticator:
    realm_message: Realm
    supports_remember_me: false
    failure_response: notes.authenticator_failure_response.plain
```

**realm_message** configuration allow you change http header `WWW-Authenticate: Basic realm="{you_text}"`.

**supports_remember_me** enable|disable Symfony "Remember Me" functionality.

**failure_response** allow you to set you own service, that will return response for authentication fail.
 
[license-link]: https://github.com/symfony-notes/http-basic-authenticator-bundle/blob/master/LICENSE
[license-image]: https://img.shields.io/dub/l/vibe-d.svg
[sensiolabs-insight-link]: https://insight.sensiolabs.com/projects/c485965b-e866-41fd-a583-9780ac9f024b
[sensiolabs-insight-image]: https://insight.sensiolabs.com/projects/c485965b-e866-41fd-a583-9780ac9f024b/big.png
[build-image]: https://travis-ci.org/symfony-notes/http-basic-authenticator-bundle.svg?branch=master
[build-link]: https://travis-ci.org/symfony-notes/http-basic-authenticator-bundle
