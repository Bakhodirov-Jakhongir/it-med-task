<?php

namespace Tests\Feature;

use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PatientsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_patient_test()
    {
        $response = $this->postJson('api/patients', [
            'name' => 'patient name',
            'phone_number' => '998931000101',
            'address' => 'address-patient'
        ]);
        $response->assertStatus(201);
    }

    public function test_validation_patient_test()
    {
        $response = $this->postJson('api/patients', [
            'name' => 'patient name',
            'phone_number' => '+998931000101',
            'address' => 'address-patient'
        ]);
        $response->assertStatus(422);
    }

    public function test_delete_patient_test()
    {
        $patient = Patient::create([
            'name' => 'test name',
            'phone_number' => '998931234567',
            'address' => 'test address'
        ]);
        $response = $this->deleteJson(route('patients.destroy', [$patient->id]));
        $response->assertStatus(204);
        $this->assertModelMissing($patient);
    }
}
