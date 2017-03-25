<?php

declare (strict_types = 1);

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\Tests\CredentialChecker;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
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
     * @var ChainChecker
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
        $fakeChecker1 = $this->createMock(CredentialCheckerInterface::class);

        $fakeChecker1->expects(self::once())
            ->method('check')
            ->with($this->user, $this->credentials);

        $fakeChecker2 = $this->createMock(CredentialCheckerInterface::class);

        $fakeChecker2->expects(self::once())
            ->method('check')
            ->with($this->user, $this->credentials);

        $this->checker->addChecker($fakeChecker1);
        $this->checker->addChecker($fakeChecker2);

        $this->checker->check($this->user, $this->credentials);
    }

    /**
     * Check negative scenarios.
     */
    public function testNegative()
    {
        self::expectException(AuthenticationException::class);

        $fakeChecker1 = $this->createMock(CredentialCheckerInterface::class);

        $fakeChecker1->expects(self::once())
            ->method('check')
            ->with($this->user, $this->credentials)
            ->willThrowException(new AuthenticationException());

        $fakeChecker2 = $this->createMock(CredentialCheckerInterface::class);

        $fakeChecker2->expects(self::never())
            ->method('check')
            ->with($this->user, $this->credentials);

        $this->checker->addChecker($fakeChecker1);
        $this->checker->addChecker($fakeChecker2);

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
        $this->checker = new ChainChecker();
    }
}
