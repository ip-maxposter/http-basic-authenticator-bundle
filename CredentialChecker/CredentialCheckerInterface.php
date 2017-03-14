<?php

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\CredentialChecker;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Credentials;

/**
 * Interface CredentialCheckerInterface
 */
interface CredentialCheckerInterface
{
    /**
     * @param UserInterface $user
     * @param Credentials   $credentials
     *
     * @throws AuthenticationException
     */
    public function check(UserInterface $user, Credentials $credentials);
}
