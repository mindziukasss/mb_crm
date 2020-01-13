<?php

namespace App\Utils;

use Symfony\Component\Console\Exception\InvalidArgumentException;

/**
 * Class Validator
 */
class Validator
{

    /**
     * @param string|null $email
     *
     * @return string
     */
    public function validateEmail(?string $email): string
    {
        if (empty($email)) {
            throw new InvalidArgumentException('The email can not be empty.');
        }

        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('The email should look like a real email.');
        }

        return $email;
    }

    /**
     * @param string|null $name
     *
     * @return string
     */
    public function validateName(?string $name): string
    {
        if (empty($name)) {
            throw new InvalidArgumentException('The name can not be empty.');
        }

        return $name;
    }

    /**
     * @param string|null $lastName
     *
     * @return string
     */
    public function validateLastName(?string $lastName): string
    {
        if (empty($lastName)) {
            throw new InvalidArgumentException('The last name can not be empty.');
        }

        return $lastName;
    }

    /**
     * @param string|null $plainPassword
     *
     * @return string
     */
    public function validatePassword(?string $plainPassword): string
    {
        if (empty($plainPassword)) {
            throw new InvalidArgumentException('The password can not be empty.');
        }

        if (strlen($plainPassword) < 6) {
            throw new InvalidArgumentException('The password must be at least 6 characters long.');
        }

        return $plainPassword;
    }


    /**
     * @param $role
     *
     * @return mixed
     */
    public function validateRole($role)
    {
        if (empty($role)) {
            throw new InvalidArgumentException('The full role can not be empty.');
        }

        return $role;
    }
}