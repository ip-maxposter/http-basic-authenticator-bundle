<?php

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\Factory\AuthenticationFailure;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

/**
 * Interface FailureResponseFactoryInterface
 */
interface FailureResponseFactoryInterface
{
    /**
     * @param AuthenticationException $exception
     *
     * @return Response
     */
    public function createFromException(AuthenticationException $exception): Response;
}
