<?php

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\Tests\Factory\AuthenticationFailure;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use SymfonyNotes\HttpBasicAuthenticatorBundle\Factory\AuthenticationFailure\PlainResponseFactory;
use SymfonyNotes\HttpBasicAuthenticatorBundle\Factory\AuthenticationFailure\FailureResponseFactoryInterface;

/**
 * Class PlainResponseFactoryTest
 */
class PlainResponseFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PlainResponseFactory
     */
    private $responseFactory;

    /**
     * @test
     */
    public function shouldInstanceOfFailureResponseFactoryInterface()
    {
        self::assertInstanceOf(FailureResponseFactoryInterface::class, $this->responseFactory);
    }

    /**
     * Test response creating.
     */
    public function testPositive()
    {
        $exceptionMessage = 'TEST TEST';
        $response = $this->responseFactory->createFromException(new AuthenticationException($exceptionMessage));

        self::assertInstanceOf(Response::class, $response);
        self::assertEquals($exceptionMessage, $response->getContent());
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->responseFactory = new PlainResponseFactory();
    }
}
