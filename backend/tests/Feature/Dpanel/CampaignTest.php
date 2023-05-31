<?php

namespace Tests\Feature\Dpanel;

use App\Enums\UserRole;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CampaignTest extends TestCase
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

    public function test_campaign_contains_empty_table(): void
    {
        $response = $this->actingAs($this->admin)->get('dpanel/campaign');

        $response->assertOk();
        $response->assertSeeText('Data Not Found');
    }

    public function test_campaign_contains_not_empty_table(): void
    {
        $category = Category::factory()->create();

        $campaign = Campaign::create([
            'category_id' => $category->id,
            'name' => 'Campaign 1',
            'goal' => 1000,
            'description' => 'Campaign Desc'
        ]);

        $response = $this->actingAs($this->admin)->get('dpanel/campaign');

        $response->assertOk();
        $response->assertSeeText('Campaign 1');
        $response->assertViewHas('campaigns', fn ($collection) => $collection->contains($campaign));
    }


    public function test_campaign_create_successful(): void
    {
        $category = Category::factory()->create();
        $campaign = [
            'category_id' => $category->id,
            'name' => 'Campaign 1',
            'goal' => 1000,
            'description' => 'Campaign Desc'
        ];

        $response = $this->actingAs($this->admin)->post('dpanel/campaign', $campaign);

        $response->assertStatus(302);
        $response->assertSessionHas('success');
        $response->assertRedirect(session()->previousUrl());


        $lastCampaign = Campaign::latest()->first();
        $this->assertEquals($campaign['category_id'], $lastCampaign->category_id);
        $this->assertEquals($campaign['name'], $lastCampaign->name);
        $this->assertEquals($campaign['goal'], $lastCampaign->goal);
        $this->assertEquals($campaign['description'], $lastCampaign->description);
    }

    public function test_campaign_edit_successful(): void
    {
        $campaign = Campaign::factory()->create();

        $response = $this->actingAs($this->admin)->get('dpanel/campaign/' . $campaign->slug . '/edit');

        $response->assertOk();
        $response->assertSee('value="' . $campaign->name . '"', false);
        $response->assertViewHas('campaign', $campaign);
    }

    public function test_campaign_update_validation_error_redirect_back_to_form(): void
    {
        $campaign = Campaign::factory()->create();

        $response = $this->actingAs($this->admin)->put('dpanel/campaign/'. $campaign->slug, [
            'name'=>''
        ]);

        $response->assertStatus(302);
        $response->assertInvalid('name');
    }


    private function createUser(UserRole $userRole = UserRole::USER): User
    {
        return User::factory()->create([
            'role' => $userRole
        ]);
    }
}
