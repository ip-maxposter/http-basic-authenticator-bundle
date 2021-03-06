<?php

declare (strict_types = 1);

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\Tests\CredentialChecker;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Email;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Password;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Credentials;
use SymfonyNotes\HttpBasicAuthenticatorBundle\CredentialChecker\UserEnabledChecker;

/**
 * Class UserEnabledCheckerTest
 */
class UserEnabledCheckerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var UserEnabledChecker
     */
    private $checker;

    /**
     * @var AdvancedUserInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $user;

    /**
     * @var Credentials
     */
    private $credentials;

    /**
     * Check positive scenarios.
     */
    public function testPositive()
    {
        $this->user->expects(self::once())
            ->method('isEnabled')
            ->willReturn(true);

        $this->checker->check($this->user, $this->credentials);
    }

    /**
     * Check exception throwing.
     */
    public function testNegative()
    {
        self::expectException(AuthenticationException::class);
        self::expectExceptionMessage('Account is disabled.');

        $this->user->expects(self::once())
            ->method('isEnabled')
            ->willReturn(false);

        $this->checker->check($this->user, $this->credentials);
    }

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->user = $this->createMock(AdvancedUserInterface::class);
        $this->credentials = new Credentials(new Email('test@test.com'), new Password('test'));
        $this->checker = new UserEnabledChecker();
    }
}
