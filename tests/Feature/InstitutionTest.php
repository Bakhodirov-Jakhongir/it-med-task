<?php

namespace Tests\Feature;

use App\Models\Institution;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InstitutionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_institution_test()
    {
        $response = $this->postJson('api/institutions', [
            'name' => 'institution name',
            'address' => 'address institutions'
        ]);
        $response->assertStatus(201);
    }

    public function test_validation_institution_test()
    {
        $response = $this->postJson('api/institutions', [
            'name' => 'institution name',
            'address' => 12
        ]);
        $response->assertStatus(422);
    }

    public function test_delete_institution_test()
    {
        $institution = Institution::create([
            'name' => 'test institution name',
            'address' => 'test institutions address'
        ]);
        $response = $this->deleteJson(route('institutions.destroy', [$institution->id]));
        $response->assertStatus(204);
        $this->assertModelMissing($institution);
    }
}
