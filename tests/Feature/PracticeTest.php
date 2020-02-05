<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PracticeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = new \App\User;
        $user->name = "テスト太郎";
        $user->email = "taro@test.com";
        $user->password = \Hash::make('test_password');
        $user->save();

        $readUser = \App\User::where('name','テスト太郎')->first();
        $this->assertNotNull($readUser);
        $this->assertTrue(\Hash::check('test_password', $readUser->password));

        \App\User::where('email', 'taro@test.com')->delete();
    }
}
