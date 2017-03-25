<?php

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\CredentialChecker;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Credentials;

/**
 * Interface CredentialCheckerInterface
 */
interface CredentialCheckerInterface
{
    /**
     * @param AdvancedUserInterface $user
     * @param Credentials           $credentials
     *
     * @throws AuthenticationException
     */
    public function check(AdvancedUserInterface $user, Credentials $credentials);
}
