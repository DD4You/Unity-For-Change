<?php

namespace Tests\Feature\Dpanel;

use App\Enums\UserRole;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser();
        $this->admin = $this->createUser(userRole: UserRole::ADMIN);
    }

    public function test_category_contains_empty_table(): void
    {
        $response = $this->actingAs($this->admin)->get('dpanel/category');

        $response->assertOk();
        $response->assertSeeText('Data Not Found');
    }

    public function test_category_contains_not_empty_table(): void
    {
        Category::factory()->create();

        $response = $this->actingAs($this->admin)->get('dpanel/category');

        $response->assertOk();
        $response->assertDontSeeText('Data Not Found');
    }

    public function test_category_create_successful(): void
    {
        $category = ['name' => 'Education'];

        $response = $this->actingAs($this->admin)->post('dpanel/category', $category);

        $response->assertStatus(302);
        $response->assertSessionHas('success');
        $response->assertRedirect(session()->previousUrl());

        $this->assertDatabaseHas('categories', $category);

        $lastCategory = Category::latest()->first();
        $this->assertEquals($category['name'], $lastCategory->name);
    }

    public function test_category_update_validation_error_redirect_back_to_form(): void
    {
        $category = Category::factory()->create();

        $response = $this->actingAs($this->admin)->put('dpanel/category/'. $category->id, [
            'name'=>''
        ]);

        $response->assertStatus(302);
        $response->assertInvalid('name');
    }

    public function test_category_delete_successful(): void
    {
        $category = Category::factory()->create();

        $response = $this->actingAs($this->admin)->delete('dpanel/category/'. $category->id);

        $response->assertStatus(302);
        $response->assertRedirect(session()->previousUrl());

        $this->assertDatabaseMissing('categories', $category->toArray());
        $this->assertDatabaseCount('categories', 0);
    }

    private function createUser(UserRole $userRole = UserRole::USER): User
    {
        return User::factory()->create([
            'role' => $userRole
        ]);
    }
}
