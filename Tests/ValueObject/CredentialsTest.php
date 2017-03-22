<?php

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\Tests\ValueObject;

use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Email;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Password;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Credentials;

/**
 * Class CredentialsTest
 */
class CredentialsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test success object creating & getters.
     */
    public function test()
    {
        $password = new Password('test');
        $email = new Email('test@test.com');
        $credentials = new Credentials($email, $password);

        self::assertInstanceOf(Email::class, $credentials->getEmail());
        self::assertInstanceOf(Password::class, $credentials->getPassword());
    }
}
