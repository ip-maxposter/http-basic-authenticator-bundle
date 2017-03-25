<?php

declare (strict_types = 1);

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\Tests\ValueObject;

use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Password;

/**
 * Class PasswordTest
 */
class PasswordTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test success create object and convert to string.
     */
    public function testPositive()
    {
        $password = 'test';
        $object = new Password($password);

        self::assertEquals($password, (string) $object);
    }

    /**
     * Test object creating with invalid parameter.
     */
    public function testNegative()
    {
        self::expectException(\InvalidArgumentException::class);
        self::expectExceptionMessage('Password can\'t be blank.');

        new Password('');
    }
}
