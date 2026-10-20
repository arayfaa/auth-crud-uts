<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DepartmentCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_access_department_pages(): void
    {
        $response = $this->get(route('departments.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_view_department_list(): void
    {
        $user = User::factory()->create();
        $department = Department::create([
            'name' => 'Divisi Riset',
            'description' => 'Penelitian dan Inovasi',
        ]);

        $response = $this->actingAs($user)->get(route('departments.index'));

        $response->assertStatus(200);
        $response->assertSee('Divisi Riset');
    }

    public function test_authenticated_user_can_create_department(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('departments.store'), [
            'name' => 'Divisi Pemasaran',
            'description' => 'Menangani promosi dan kampanye digital',
        ]);

        $response->assertRedirect(route('departments.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('departments', [
            'name' => 'Divisi Pemasaran',
        ]);
    }

    public function test_authenticated_user_can_update_department(): void
    {
        $user = User::factory()->create();
        $department = Department::create([
            'name' => 'Divisi Lama',
            'description' => 'Deskripsi lama',
        ]);

        $response = $this->actingAs($user)->put(route('departments.update', $department), [
            'name' => 'Divisi Baru',
            'description' => 'Deskripsi baru yang diperbarui',
        ]);

        $response->assertRedirect(route('departments.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('departments', [
            'id' => $department->id,
            'name' => 'Divisi Baru',
        ]);
    }

    public function test_cannot_delete_department_with_assigned_employees(): void
    {
        $user = User::factory()->create();
        $department = Department::create([
            'name' => 'Divisi Operasional',
        ]);

        Employee::create([
            'department_id' => $department->id,
            'name' => 'Budi Santoso',
            'position' => 'Staff Operasional',
            'salary' => 6000000,
            'joined_at' => '2023-01-01',
        ]);

        $response = $this->actingAs($user)->delete(route('departments.destroy', $department));

        $response->assertSessionHas('error');
        $this->assertDatabaseHas('departments', [
            'id' => $department->id,
        ]);
    }

    public function test_can_delete_empty_department(): void
    {
        $user = User::factory()->create();
        $department = Department::create([
            'name' => 'Divisi Kosong',
        ]);

        $response = $this->actingAs($user)->delete(route('departments.destroy', $department));

        $response->assertRedirect(route('departments.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('departments', [
            'id' => $department->id,
        ]);
    }
}
