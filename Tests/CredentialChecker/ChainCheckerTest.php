<?php

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\Tests\CredentialChecker;

use Symfony\Component\Security\Core\User\UserInterface;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Email;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Password;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Credentials;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use SymfonyNotes\HttpBasicAuthenticatorBundle\CredentialChecker\ChainChecker;
use SymfonyNotes\HttpBasicAuthenticatorBundle\CredentialChecker\CredentialCheckerInterface;

/**
 * Class ChainCheckerTest
 */
class ChainCheckerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Check positive scenarios.
     */
    public function testPositive()
    {
        $chine = new ChainChecker();
        $user = $this->createMock(UserInterface::class);
        $credentials = new Credentials(new Email('test@test.com'), new Password('test'));

        $fakeChecker1 = $this->createMock(CredentialCheckerInterface::class);

        $fakeChecker1->expects(self::once())
            ->method('check')
            ->with($user, $credentials);

        $fakeChecker2 = $this->createMock(CredentialCheckerInterface::class);

        $fakeChecker2->expects(self::once())
            ->method('check')
            ->with($user, $credentials);

        $chine->addChecker($fakeChecker1);
        $chine->addChecker($fakeChecker2);

        $chine->check($user, $credentials);
    }

    /**
     * Check negative scenarios.
     */
    public function testNegative()
    {
        self::expectException(AuthenticationException::class);

        $chine = new ChainChecker();
        $user = $this->createMock(UserInterface::class);
        $credentials = new Credentials(new Email('test@test.com'), new Password('test'));

        $fakeChecker1 = $this->createMock(CredentialCheckerInterface::class);

        $fakeChecker1->expects(self::once())
            ->method('check')
            ->with($user, $credentials)
            ->willThrowException(new AuthenticationException());

        $fakeChecker2 = $this->createMock(CredentialCheckerInterface::class);

        $fakeChecker2->expects(self::never())
            ->method('check')
            ->with($user, $credentials);

        $chine->addChecker($fakeChecker1);
        $chine->addChecker($fakeChecker2);

        $chine->check($user, $credentials);
    }
}
