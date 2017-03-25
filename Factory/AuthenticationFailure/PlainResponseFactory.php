<?php

declare (strict_types = 1);

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\Factory\AuthenticationFailure;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

/**
 * Class PlainResponseFactory
 */
class PlainResponseFactory implements FailureResponseFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createFromException(AuthenticationException $exception): Response
    {
        return new Response($exception->getMessage(), Response::HTTP_FORBIDDEN);
    }
}
