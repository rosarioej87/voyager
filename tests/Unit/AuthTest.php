<?php

namespace Voyager\Admin\Tests\Unit;

use Illuminate\Support\Facades\Auth;
use Voyager\Admin\Tests\Unit\TestCase;

class AuthTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_can_login()
    {
        $this->get(route('voyager.dashboard'));
        $res = $this->postJson(route('voyager.login'), [
            'email'     => 'admin@admin.com',
            'password'  => 'password',
        ])
        ->assertRedirect(route('voyager.dashboard'));
    }

    public function test_can_not_login_with_wrong_credentials()
    {
        $this->postJson(route('voyager.login'), [
            'email'     => 'user@user.com',
            'password'  => 'wrong',
        ])
        ->assertRedirect(route('voyager.login'))
        ->assertSessionHas('error', __('voyager::auth.login_failed'));
    }

    public function test_can_not_login_without_credentials()
    {
        $this->postJson(route('voyager.login'), [])
        ->assertSessionHas('error', __('voyager::auth.error_field_empty'));
    }
}
