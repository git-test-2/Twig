<?php
include "../../config.php";

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

try {
    Capsule::schema()->dropIfExists('users');

    Capsule::schema()->create('users', function (Blueprint $table) {
        $table->increments('id');
        $table->string('email');
        $table->string('password');
        $table->string('name');
        $table->date('created_at');
    });

    Capsule::schema()->dropIfExists('messages');

    Capsule::schema()->create('messages', function (Blueprint $table) {
        $table->increments('id');
        $table->string('text');
        $table->date('created_at');
        $table->integer('author_id');
    });

    Capsule::schema()->dropIfExists('categories');

    Capsule::schema()->create('categories', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');

        $table->string('description');

        $table->timestamps();
    });

    Capsule::schema()->dropIfExists('products');

    Capsule::schema()->create('products', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('category_id');
        $table->timestamps();
    });



    echo 'Success!';
} catch (Exception $e) {
    echo 'Fail!', PHP_EOL, $e;
    }



