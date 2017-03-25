<?php

declare (strict_types = 1);

namespace SymfonyNotes\HttpBasicAuthenticatorBundle\ValueObject;

/**
 * Email value object.
 */
class Email
{
    /**
     * @var string
     */
    private $email;

    /**
     * @param string $email
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(string $email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('The email address is incorrect.');
        }
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->email;
    }
}
