<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountTest extends TestCase
{
    public function testAllAcount()
    {
        $response = $this->get('/api/accounts');
        $response->assertStatus(200);
    }

    public function testSingleAccount($id = 1)
    {
        $response = $this->get('/api/accounts/' . $id);
        $response->assertStatus(200);
    }
}
