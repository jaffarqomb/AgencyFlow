<?php

use App\Models\User;

test('agency showcase homepage renders successfully', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('AGENCYFLOW');
    $response->assertSee('IDENTIFY');
    $response->assertSee('CREATE');
    $response->assertSee('COMMUNICATE');
    $response->assertSee('CAPTURE');
});

test('client portal renders with projects, deliverables, and financial ledger', function () {
    $response = $this->get('/portal');

    $response->assertStatus(200);
    $response->assertSee('Client Portal');
    $response->assertSee('Deliverables');
    $response->assertSee('Invoices');
});

test('admin login page renders correctly', function () {
    $response = $this->get('/admin/login');

    $response->assertStatus(200);
});

test('authorized users can access admin panel', function () {
    $user = User::factory()->create([
        'role' => 'agency_owner',
        'status' => 'active',
    ]);

    $response = $this->actingAs($user)->get('/admin');

    $response->assertStatus(200);
});
