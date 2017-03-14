<?php

namespace SymfonyNotes\HttpBasicAuthenticatorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use SymfonyNotes\HttpBasicAuthenticatorBundle\DependencyInjection\HttpBasicAuthenticatorExtension;

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
}
