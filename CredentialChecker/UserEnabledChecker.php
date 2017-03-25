<?php

declare (strict_types = 1);

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\CredentialChecker;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\Exception\DisabledException;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Credentials;

/**
 * Class UserEnabledChecker.
 */
class UserEnabledChecker implements CredentialCheckerInterface
{
    /**
     * {@inheritdoc}
     */
    public function check(AdvancedUserInterface $user, Credentials $credentials)
    {
        if (!$user->isEnabled()) {
            throw new DisabledException('Account is disabled.');
        }
    }
}
