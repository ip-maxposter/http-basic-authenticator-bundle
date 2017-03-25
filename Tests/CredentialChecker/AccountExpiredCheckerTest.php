<?php

declare (strict_types = 1);

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\Tests\CredentialChecker;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Email;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Password;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Credentials;
use SymfonyNotes\HttpBasicAuthenticatorBundle\CredentialChecker\AccountExpiredChecker;

/**
 * Class AccountExpiredCheckerTest
 */
class AccountExpiredCheckerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AccountExpiredChecker
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
            ->method('isAccountNonExpired')
            ->willReturn(true);

        $this->checker->check($this->user, $this->credentials);
    }

    /**
     * Check exception throwing.
     */
    public function testNegative()
    {
        self::expectException(AuthenticationException::class);
        self::expectExceptionMessage('Account has expired.');

        $this->user->expects(self::once())
            ->method('isAccountNonExpired')
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
        $this->checker = new AccountExpiredChecker();
    }
}
