<?php

declare (strict_types = 1);

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\Tests\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use SymfonyNotes\HttpBasicAuthenticatorBundle\Security\HttpBasicAuthenticator;
use SymfonyNotes\HttpBasicAuthenticatorBundle\CredentialChecker\CredentialCheckerInterface;
use SymfonyNotes\HttpBasicAuthenticatorBundle\Factory\AuthenticationFailure\FailureResponseFactoryInterface;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Credentials;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Email;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Password;

/**
 * Class HttpBasicAuthenticatorTest
 */
class HttpBasicAuthenticatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var HttpBasicAuthenticator
     */
    private $authenticator;

    /**
     * @var CredentialCheckerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $credentialChecker;

    /**
     * @var FailureResponseFactoryInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $failureResponseFactory;

    /**
     * @var string
     */
    private $realmMessage;

    /**
     * @var bool
     */
    private $isSupportsRememberMe;

    /**
     * @var Request
     */
    private $request;

    /**
     * @see HttpBasicAuthenticator::supportsRememberMe()
     */
    public function testIsSupportsRememberMe()
    {
        self::assertInternalType('bool', $this->authenticator->supportsRememberMe());
        self::assertEquals($this->isSupportsRememberMe, $this->authenticator->supportsRememberMe());
    }

    /**
     * @see HttpBasicAuthenticator::start()
     */
    public function testStart()
    {
        $response = $this->authenticator->start($this->request);

        self::assertInstanceOf(Response::class, $response);
        self::assertTrue($response->headers->has('WWW-Authenticate'));
        self::assertEquals(sprintf('Basic realm="%s"', $this->realmMessage), $response->headers->get('WWW-Authenticate'));
    }

    /**
     * @see HttpBasicAuthenticator::getCredentials()
     */
    public function testGetCredentialsNegative()
    {
        $credentials = $this->authenticator->getCredentials($this->request);

        self::assertNull($credentials);
    }

    /**
     * @see HttpBasicAuthenticator::getCredentials()
     */
    public function testGetCredentialsPositive()
    {
        $email = 'test@test.com';
        $password = 'password';

        $this->request->headers->set('PHP_AUTH_USER', $email);
        $this->request->headers->set('PHP_AUTH_PW', $password);

        $credentials = $this->authenticator->getCredentials($this->request);

        self::assertInstanceOf(Credentials::class, $credentials);
        self::assertEquals($email, (string) $credentials->getEmail());
        self::assertEquals($password, (string) $credentials->getPassword());
    }

    /**
     * @see HttpBasicAuthenticator::getUser()
     */
    public function testGetUser()
    {
        $email = 'test@test.com';
        $password = 'password';
        $credentials = new Credentials(new Email($email), new Password($password));

        $userProvider = $this->createMock(UserProviderInterface::class);
        $userProvider->expects(self::once())
            ->method('loadUserByUsername')
            ->with($email);

        $this->authenticator->getUser($credentials, $userProvider);
    }

    /**
     * @see HttpBasicAuthenticator::checkCredentials()
     */
    public function testCheckCredentials()
    {
        $email = 'test@test.com';
        $password = 'password';
        $credentials = new Credentials(new Email($email), new Password($password));

        $user = $this->createMock(AdvancedUserInterface::class);
        $this->credentialChecker->expects(self::once())
            ->method('check')
            ->with($user, $credentials);

        $this->authenticator->checkCredentials($credentials, $user);
    }

    /**
     * @see HttpBasicAuthenticator::onAuthenticationFailure()
     */
    public function testOnAuthenticationFailure()
    {
        $exception = new AuthenticationException();

        $this->failureResponseFactory->expects(self::once())
            ->method('createFromException')
            ->with($exception);

        $this->authenticator->onAuthenticationFailure($this->request, $exception);
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->realmMessage = 'TEST Realm Message';
        $this->isSupportsRememberMe = false;
        $this->credentialChecker = $this->createMock(CredentialCheckerInterface::class);
        $this->failureResponseFactory = $this->createMock(FailureResponseFactoryInterface::class);
        $this->request = new Request();

        $this->authenticator = new HttpBasicAuthenticator(
            $this->credentialChecker,
            $this->failureResponseFactory,
            $this->isSupportsRememberMe,
            $this->realmMessage
        );
    }
}
