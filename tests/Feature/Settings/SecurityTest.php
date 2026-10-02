<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\AssertableInertia as Assert;

test('guests cannot access the security settings', function () {
    $this->get(route('security.edit'))->assertRedirect(route('login'));
    $this->put(route('user-password.update'))->assertRedirect(route('login'));
});

test('users can view their security settings', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->withSession(['auth.password_confirmed_at' => time()])
        ->get(route('security.edit'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('settings/Security')
            ->where('twoFactorEnabled', false)
        );
});

test('users can update their password', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->from(route('security.edit'))
        ->put(route('user-password.update'), [
            'current_password' => 'password',
            'password' => 'New-Passw0rd!2026',
            'password_confirmation' => 'New-Passw0rd!2026',
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('security.edit'));

    expect(Hash::check('New-Passw0rd!2026', $user->refresh()->password))->toBeTrue();
});

test('password update requires the current password', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->put(route('user-password.update'), [
            'current_password' => 'wrong-password',
            'password' => 'New-Passw0rd!2026',
            'password_confirmation' => 'New-Passw0rd!2026',
        ])
        ->assertSessionHasErrors('current_password');

    expect(Hash::check('password', $user->refresh()->password))->toBeTrue();
});
