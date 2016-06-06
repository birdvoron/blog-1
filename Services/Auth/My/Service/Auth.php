<?php

namespace My\Service;

use My\Model\User;

class Auth {

    public function login($user, $password) {
        $hash = hash('sha256', $password);
        $user = User::findBy([
            'login' => $user,
            'password' => $hash
        ]);
        if (!empty($user)) {
            $user = current($user);
            $user['token'] = bin2hex(random_bytes(30));
            User::save($user);
            return $user['token'];
        } else {
            throw new \Exception('Not found user');
        }
    }
}