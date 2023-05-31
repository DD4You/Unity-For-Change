<?php

namespace Tests\Feature\Api\v1;

use App\Models\Campaign;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CampaignTest extends TestCase
{
    use RefreshDatabase;
    private $campaign;

    protected function setUp(): void
    {
        parent::setUp();

        $this->campaign = Campaign::factory()->create();
        $this->campaign->addMediaFromUrl('https://picsum.photos/200/300.jpg')
            ->usingName('testimg.jpg')
            ->usingFileName('testimg.jpg')
            ->toMediaCollection('campaign-images');
    }

    public function test_returns_campaigns_list(): void
    {
        $response = $this->getJson('/api/campaigns');

        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has('result')
                ->has('data')
                ->has(
                    'data.0',
                    fn (AssertableJson $json) =>
                    $json->where('id', $this->campaign->id)
                        ->where('slug', $this->campaign->slug)
                        ->where('name', $this->campaign->name)
                        ->where('description', $this->campaign->description)
                        ->where('goal', $this->campaign->goal)
                        ->where('raise_funds_sum_amount', $this->campaign->raise_funds_sum_amount ?? 0)
                        ->where('category_name', $this->campaign->category->name)
                        ->where('images', $this->campaign->images[0]->original_url)
                        ->etc()
                )

        );
    }

    public function test_returns_campaigns_detail(): void
    {
        $response = $this->getJson('/api/campaigns/' . $this->campaign->slug);

        $response->assertJson(
            fn (AssertableJson $json) =>
            $json->has('result')
                ->has(
                    'data',
                    fn (AssertableJson $json) =>
                    $json->where('id', $this->campaign->id)
                        ->where('slug', $this->campaign->slug)
                        ->where('name', $this->campaign->name)
                        ->where('description', $this->campaign->description)
                        ->where('goal', $this->campaign->goal)
                        ->where('raise_funds_sum_amount', $this->campaign->raise_funds_sum_amount ?? 0)
                        ->where('category_name', $this->campaign->category->name)
                        ->where('images', $this->campaign->images->pluck('original_url'))
                )

        );
    }
}
