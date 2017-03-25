<?php

declare (strict_types = 1);

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\CredentialChecker;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Credentials;
use Symfony\Component\Security\Core\Exception\CredentialsExpiredException;

/**
 * Class CredentialsExpiredChecker.
 */
class CredentialsExpiredChecker implements CredentialCheckerInterface
{
    /**
     * {@inheritdoc}
     */
    public function check(AdvancedUserInterface $user, Credentials $credentials)
    {
        if (!$user->isCredentialsNonExpired()) {
            throw new CredentialsExpiredException('Credentials have expired.');
        }
    }
}
