<?php

declare (strict_types = 1);

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\CredentialChecker;

use Symfony\Component\Security\Core\Exception\LockedException;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Credentials;

/**
 * Class UserLockedChecker.
 */
class UserLockedChecker implements CredentialCheckerInterface
{
    /**
     * {@inheritdoc}
     */
    public function check(AdvancedUserInterface $user, Credentials $credentials)
    {
        if (!$user->isAccountNonLocked()) {
            throw new LockedException('Account is locked.');
        }
    }
}
