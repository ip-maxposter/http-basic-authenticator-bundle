<?php

declare (strict_types = 1);

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\Factory\AuthenticationFailure;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

/**
 * Class JsonResponseFactory
 */
class JsonResponseFactory implements FailureResponseFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createFromException(AuthenticationException $exception): Response
    {
        $response = new JsonResponse(
            [
                'message' => 'Authentication fail.',
                'errors' => [
                    $exception->getMessage(),
                ],
            ],
            Response::HTTP_FORBIDDEN,
            ['Content-Type' => 'application/vnd.error+json']
        );

        return $response;
    }
}
