<?php

use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use LaravelEnso\Core\App\Models\User;
use LaravelEnso\Discussions\App\Enums\Reactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\Discussions\App\Models\Discussion;

class ReactionTest extends TestCase
{
    use RefreshDatabase;

    const ReactableType = 'discussion';

    protected function setUp(): void
    {
        parent::setUp();

        //$this->withoutExceptionHandling();

        $this->seed()
            ->actingAs(User::first());

        $this->postParams = $this->postParams();
    }

    /** @test */
    public function can_toggle_reaction()
    {
        $this->post(route('core.discussions.react'), $this->postParams)
            ->assertStatus(200);
    }

    private function postParams()
    {
        return [
            'reactableId' => factory(Discussion::class)->create()->id,
            'reactableType' => self::ReactableType,
            'type' => Reactions::Clap,
            'userId' => Auth::user()->id,
        ];
    }
}
