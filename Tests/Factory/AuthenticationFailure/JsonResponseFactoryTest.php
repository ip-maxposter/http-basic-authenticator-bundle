<?php

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\Tests\Factory\AuthenticationFailure;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use SymfonyNotes\HttpBasicAuthenticatorBundle\Factory\AuthenticationFailure\JsonResponseFactory;
use SymfonyNotes\HttpBasicAuthenticatorBundle\Factory\AuthenticationFailure\FailureResponseFactoryInterface;

/**
 * Class JsonResponseFactoryTest
 */
class JsonResponseFactoryTest extends \PHPUnit_Framework_TestCase
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

        self::assertInstanceOf(JsonResponse::class, $response);
        self::assertJson($response->getContent());
        self::assertEquals(json_encode(['message' => 'Authentication fail.', 'errors' => $exceptionMessage]), $response->getContent());
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->responseFactory = new JsonResponseFactory();
    }
}
