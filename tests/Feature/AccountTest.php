<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountTest extends TestCase
{

    public function getToken()
    {
        $response = $this->post('/api/login', [
            'email' => 'admin@admin.com',
            'password' => 'password',
        ]);
        $response->assertStatus(200);
        $token = $response->json('access_token');
        return $token;
    }

    public function testAllAcount()
    {
        $response = $this->get('/api/accounts', [
            'Authorization' => 'Bearer ' . $this->getToken()
        ]);
        $response->assertStatus(200);
    }

    public function testSingleAccount($id = 1)
    {
        $response = $this->get('/api/accounts/' . $id, [
            'Authorization' => 'Bearer ' . $this->getToken()
        ]);
        $response->assertStatus(200);
    }

    public function testCreateAccount()
    {
        $token = $this->getToken();
        // parse token
        $response = $this->post('/api/accounts', [
            'account_name' => 'Customer 5',
        ], [
            'Authorization' => 'Bearer ' . $token,
        ]);
        $response->assertStatus(200);
    }

    public function testUpdateAccount($id = 3)
    {
        $token = $this->getToken();
        // parse token

        $response = $this->post('/api/accounts/' . $id, [
            'account_name' => 'Customer 5',
        ], [
            'Authorization' => 'Bearer ' . $token,
        ]);

        if ($response->status() == 200) {
            $response->assertStatus(200);
        } else {
            $response->assertStatus(404);
        }
    }

    public function testDeleteAccount($id = 3)
    {
        $token = $this->getToken();
        // parse token
        $response = $this->delete('/api/accounts/' . $id, [
            'Authorization' => 'Bearer ' . $token,
        ]);
        if ($response->status() == 200) {
            $response->assertStatus(200);
        } else {
            $response->assertStatus(404);
        }
    }
}
