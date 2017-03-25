<?php

declare (strict_types = 1);

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\CredentialChecker;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Credentials;

/**
 * Class ChainChecker
 */
class ChainChecker implements CredentialCheckerInterface
{
    /**
     * @var CredentialCheckerInterface[]
     */
    private $checkers = [];

    /**
     * @param CredentialCheckerInterface $checker
     *
     * @return ChainChecker
     */
    public function addChecker(CredentialCheckerInterface $checker): self
    {
        $this->checkers[] = $checker;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function check(AdvancedUserInterface $user, Credentials $credentials)
    {
        foreach ($this->checkers as $checker) {
            $checker->check($user, $credentials);
        }
    }
}
