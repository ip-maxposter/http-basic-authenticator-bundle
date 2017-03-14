<?php

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;
use SymfonyNotes\HttpBasicAuthenticatorBundle\CredentialChecker\ChainChecker;
use SymfonyNotes\HttpBasicAuthenticatorBundle\Security\HttpBasicAuthenticator;

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
        $credentialChecker = new Definition(ChainChecker::class);

        $container->setDefinition('notes.authenticator_credential_checker.chain_checker', $credentialChecker);

        $authenticator = new Definition(HttpBasicAuthenticator::class);

        $authenticator->setArguments([
            $container->getDefinition('notes.authenticator_credential_checker.chain_checker'),
            $mergedConfig['supports_remember_me'],
            $mergedConfig['realm_message'],
        ]);

        $container->setDefinition('notes.http_basic_authenticator', $authenticator);
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias()
    {
        return 'notes_http_basic_authenticator';
    }
}
