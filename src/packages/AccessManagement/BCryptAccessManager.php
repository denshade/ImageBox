<?php

namespace packages\AccessManagement;

/**
 * Description of AuthenticationManager
 *
 * @author Lieven
 */
class BCryptAccessManager
{
    /**
     * Check if a user is authenticated.
     * @param $password string the original password
     * @param $storedHash
     * @return bool check if user is authenticated.
     */
    public function isAuthenticated($password, $storedHash)
    {
        return password_verify($password, $storedHash);
    }

    /**
     *
     * @param $password string original password.
     * @return string
     */
    public function getPasswordHash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Check if a user is authorized to use a package.
     * @param $user
     * @param $password
     */
    public function isAuthorized($user, $password, $package)
    {
        
    }
}
