<?php

declare (strict_types = 1);

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Class AuthenticatorCheckerPass
 */
class AuthenticatorCheckerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('notes.authenticator_credential_checker.chain_checker')) {
            return;
        }

        $definition = $container->findDefinition('notes.authenticator_credential_checker.chain_checker');

        foreach ($container->findTaggedServiceIds('authenticator.checker') as $id => $tags) {
            $definition->addMethodCall('addChecker', [new Reference($id)]);
        }
    }
}
