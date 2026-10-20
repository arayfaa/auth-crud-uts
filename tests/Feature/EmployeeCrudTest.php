<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_access_employee_pages(): void
    {
        $response = $this->get(route('employees.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_view_employee_list(): void
    {
        $user = User::factory()->create();
        $department = Department::create([
            'name' => 'IT Department',
            'description' => 'Information Technology',
        ]);

        $employee = Employee::create([
            'department_id' => $department->id,
            'name' => 'John Doe',
            'position' => 'Backend Developer',
            'salary' => 8500000,
            'joined_at' => '2023-01-15',
        ]);

        $response = $this->actingAs($user)->get(route('employees.index'));

        $response->assertStatus(200);
        $response->assertSee('John Doe');
        $response->assertSee('Backend Developer');
        $response->assertSee('IT Department');
        $response->assertSee('8.500.000');
    }

    public function test_authenticated_user_can_create_employee(): void
    {
        $user = User::factory()->create();
        $department = Department::create([
            'name' => 'Finance',
        ]);

        $response = $this->actingAs($user)->post(route('employees.store'), [
            'department_id' => $department->id,
            'name' => 'Jane Smith',
            'position' => 'Financial Analyst',
            'salary' => 9000000,
            'joined_at' => '2023-05-10',
        ]);

        $response->assertRedirect(route('employees.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('employees', [
            'department_id' => $department->id,
            'name' => 'Jane Smith',
            'position' => 'Financial Analyst',
        ]);
    }

    public function test_create_employee_validation(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('employees.store'), [
            'name' => '',
            'position' => '',
            'salary' => 'invalid',
        ]);

        $response->assertSessionHasErrors(['name', 'department_id', 'position', 'salary', 'joined_at']);
    }

    public function test_authenticated_user_can_update_employee(): void
    {
        $user = User::factory()->create();
        $dept1 = Department::create(['name' => 'Divisi A']);
        $dept2 = Department::create(['name' => 'Divisi B']);

        $employee = Employee::create([
            'department_id' => $dept1->id,
            'name' => 'Pegawai Lama',
            'position' => 'Junior Staff',
            'salary' => 5000000,
            'joined_at' => '2022-01-01',
        ]);

        $response = $this->actingAs($user)->put(route('employees.update', $employee), [
            'department_id' => $dept2->id,
            'name' => 'Pegawai Promosi',
            'position' => 'Senior Staff',
            'salary' => 8000000,
            'joined_at' => '2022-01-01',
        ]);

        $response->assertRedirect(route('employees.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('employees', [
            'id' => $employee->id,
            'department_id' => $dept2->id,
            'name' => 'Pegawai Promosi',
            'position' => 'Senior Staff',
            'salary' => 8000000,
        ]);
    }

    public function test_authenticated_user_can_delete_employee(): void
    {
        $user = User::factory()->create();
        $dept = Department::create(['name' => 'Divisi X']);

        $employee = Employee::create([
            'department_id' => $dept->id,
            'name' => 'Pegawai Dihapus',
            'position' => 'Magang',
            'salary' => 3000000,
            'joined_at' => '2023-01-01',
        ]);

        $response = $this->actingAs($user)->delete(route('employees.destroy', $employee));

        $response->assertRedirect(route('employees.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('employees', [
            'id' => $employee->id,
        ]);
    }

    public function test_dashboard_displays_counts_and_links(): void
    {
        $user = User::factory()->create();
        $dept = Department::create(['name' => 'Divisi Utama']);

        Employee::create([
            'department_id' => $dept->id,
            'name' => 'Andi Wijaya',
            'position' => 'Manajer',
            'salary' => 15000000,
            'joined_at' => '2020-01-01',
        ]);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Divisi Utama');
        $response->assertSee('Andi Wijaya');
        $response->assertSee('15.000.000');
    }
}
