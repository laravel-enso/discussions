<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use LaravelEnso\Core\Models\User;
use LaravelEnso\Discussions\Enums\Reactions;
use LaravelEnso\Discussions\Models\Discussion;
use LaravelEnso\Discussions\Traits\Discussable;
use Tests\TestCase;

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

        $this->createTestTable();

        $this->postParams = $this->postParams();
    }

    /** @test */
    public function can_toggle_reaction()
    {
        $this->post(route('core.discussions.reactions.toggle'), $this->postParams)
            ->assertStatus(200);
    }

    private function postParams()
    {
        return [
            'reactableId' => Discussion::factory()->create([
                'discussable_id' => Discussion::factory()->create([
                    'discussable_id' => DiscussionReactionTestModel::create(['name' => 'discussable'])->id,
                    'discussable_type' => DiscussionReactionTestModel::class,
                ])->id,
                'discussable_type' => DiscussionReactionTestModel::class,
            ])->id,
            'reactableType' => self::ReactableType,
            'type' => Reactions::Clap,
            'userId' => Auth::user()->id,
        ];
    }

    private function createTestTable()
    {
        Schema::create('discussion_reaction_test_models', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        return $this;
    }
}

class DiscussionReactionTestModel extends Model
{
    use Discussable;

    protected $fillable = ['name'];
}
