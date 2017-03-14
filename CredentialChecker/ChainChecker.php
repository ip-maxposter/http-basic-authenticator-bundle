<?php

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\CredentialChecker;

use Symfony\Component\Security\Core\User\UserInterface;
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
    public function check(UserInterface $user, Credentials $credentials)
    {
        foreach ($this->checkers as $checker) {
            $checker->check($user, $credentials);
        }
    }
}
