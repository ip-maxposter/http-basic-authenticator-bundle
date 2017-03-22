<?php

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();
        $builder->root('notes_http_basic_authenticator')
            ->children()
                ->booleanNode('supports_remember_me')
                    ->defaultFalse()
                ->end()
                ->scalarNode('realm_message')
                    ->defaultValue('Realm')
                ->end()
                ->scalarNode('failure_response')
                    ->defaultValue('notes.authenticator_failure_response.plain')
                ->end()
            ->end();

        return $builder;
    }
}
