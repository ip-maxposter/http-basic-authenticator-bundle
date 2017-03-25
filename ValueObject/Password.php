<?php

declare (strict_types = 1);

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject;

/**
 * Password value object.
 */
class Password
{
    /**
     * @var string
     */
    private $password;

    /**
     * @param string $password
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(string $password)
    {
        $password = trim($password);

        if (empty($password)) {
            throw new \InvalidArgumentException('Password can\'t be blank.');
        }

        $this->password = $password;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->password;
    }
}
