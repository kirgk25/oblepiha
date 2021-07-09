<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Composer\Util\Http\Response;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store()
    {
        $this->postJson('/api/products', [
                "name" => "spider-man",
                "cost" => 123.45,
                "description" => "marvel",
                "photos"=> [
                    ["url" => "photo-1"],
                    ["url" => "photo-2"],
                    ["url" => "photo-3"],
                ],
            ])
            ->assertStatus(\Illuminate\Http\Response::HTTP_CREATED)
            ->assertJson([
                'data' => [
                    'id' => true,
                ]
            ]);
    }
}
