<?php

declare (strict_types = 1);

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\CredentialChecker;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Credentials;

/**
 * Class AccountExpiredChecker.
 */
class AccountExpiredChecker implements CredentialCheckerInterface
{
    /**
     * {@inheritdoc}
     */
    public function check(AdvancedUserInterface $user, Credentials $credentials)
    {
        if (!$user->isAccountNonExpired()) {
            throw new AccountExpiredException('Account has expired.');
        }
    }
}
