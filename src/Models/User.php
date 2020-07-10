<?php

namespace App\Models;

class User extends Base
{
    public function get($email)
    {
        $result = $this->microBlogTable->newQuery()->select()->where('email', '=', $email)->get()->toArray();
        return $result[0];
    }

    public function add($user)
    {
        $this->microBlogTable->email = $user["email"];
        $this->microBlogTable->password = password_hash($user["password"], PASSWORD_BCRYPT);
        $this->microBlogTable->name = $user["name"];
        $this->microBlogTable->created_at = date("y.m.d");
        $this->microBlogTable->save();
    }



}