<?php
namespace App\DtoJs;

use App\Entity\User;

/**
 * User {
 *  id: number;
 *  username: string;
 *  password: string;
 *  firstName: string;
 *  lastName: string;
 *  email: string;
 *  token: string;
 * }
 */
class UserDtoJs {

    public $id;
    public $userName;
    public $password;
    public $firstName;
    public $lastName;
    public $email;
    public $token;

    public function __construct (User $user) {
        $this->id = $user->getId();
        $this->username = $user->getUsername();
        $this->email = $user->getEmail();
    }
}