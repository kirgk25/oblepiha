<?php

declare(strict_types=1);

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        Http::preventStrayRequests();

        $this->user = User::factory()->createOne();

        App::setLocale('ru');
        $this->actingAs($this->user);
    }
}
