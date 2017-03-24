<?php

namespace SymfonyNotes\HttpBasicAuthenticatorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use SymfonyNotes\HttpBasicAuthenticatorBundle\DependencyInjection\HttpBasicAuthenticatorExtension;
use SymfonyNotes\HttpBasicAuthenticatorBundle\DependencyInjection\Compiler\AuthenticatorCheckerPass;

/**
 * Class SymfonyNotesHttpBasicAuthenticatorBundle
 */
class SymfonyNotesHttpBasicAuthenticatorBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        return new HttpBasicAuthenticatorExtension();
    }

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new AuthenticatorCheckerPass());
    }
}
