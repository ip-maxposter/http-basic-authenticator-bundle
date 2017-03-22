<?php

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Email;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Password;
use SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject\Credentials;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;
use SymfonyNotes\HttpBasicAuthenticatorBundle\CredentialChecker\ChainChecker;
use SymfonyNotes\HttpBasicAuthenticatorBundle\Security\HttpBasicAuthenticator;
use SymfonyNotes\HttpBasicAuthenticatorBundle\CredentialChecker\PasswordChecker;
use SymfonyNotes\HttpBasicAuthenticatorBundle\CredentialChecker\CredentialCheckerInterface;
use SymfonyNotes\HttpBasicAuthenticatorBundle\Factory\AuthenticationFailure\JsonResponseFactory;
use SymfonyNotes\HttpBasicAuthenticatorBundle\Factory\AuthenticationFailure\PlainResponseFactory;
use SymfonyNotes\HttpBasicAuthenticatorBundle\Factory\AuthenticationFailure\FailureResponseFactoryInterface;

/**
 * Class HttpBasicAuthenticatorExtension
 */
class HttpBasicAuthenticatorExtension extends ConfigurableExtension
{
    /**
     * {@inheritdoc}
     */
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container)
    {
        $container->setAlias('notes.authenticator_failure_response', $mergedConfig['failure_response']);
        $container->setParameter('notes_authenticator_realm_message', $mergedConfig['realm_message']);
        $container->setParameter('notes_authenticator_supports_remember_me', $mergedConfig['supports_remember_me']);

        $this->addClassesToCompile([
            Email::class,
            Password::class,
            Credentials::class,
            ChainChecker::class,
            PasswordChecker::class,
            JsonResponseFactory::class,
            PlainResponseFactory::class,
            HttpBasicAuthenticator::class,
            CredentialCheckerInterface::class,
            FailureResponseFactoryInterface::class,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'notes_http_basic_authenticator';
    }
}
