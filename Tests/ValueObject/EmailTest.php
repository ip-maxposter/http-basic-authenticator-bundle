<?php

declare (strict_types = 1);

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\Tests\ValueObject;

use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Email;

/**
 * Class EmailTest
 */
class EmailTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test success create object and convert to string.
     */
    public function testPositive()
    {
        $email = 'test@test.com';
        $object = new Email($email);

        self::assertEquals($email, (string) $object);
    }

    /**
     * Test object creating with invalid parameter.
     *
     * @dataProvider invalidEmailProvider
     */
    public function testNegative($email)
    {
        self::expectException(\InvalidArgumentException::class);
        self::expectExceptionMessage('The email address is incorrect.');

        new Email($email);
    }

    /**
     * @return array
     */
    public function invalidEmailProvider()
    {
        return [
            [''],
            ['test'],
            ['test#test.com'],
        ];
    }
}
