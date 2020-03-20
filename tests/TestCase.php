<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function loginAsApi(?User $user = null): User
    {
        $user = $user ?: factory(User::class)->create();

        $this->actingAs($user, 'api');

        return $user;
    }
}
