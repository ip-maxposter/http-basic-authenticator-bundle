<?php

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject;

/**
 * Value object for credentials data
 */
class Credentials
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @param Email    $email
     * @param Password $password
     */
    public function __construct(Email $email, Password $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return Password
     */
    public function getPassword(): Password
    {
        return $this->password;
    }
}
