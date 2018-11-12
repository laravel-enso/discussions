<?php

use Faker\Factory;
use Tests\TestCase;
use LaravelEnso\Core\app\Models\User;
use Illuminate\Database\Eloquent\Model;
use LaravelEnso\RoleManager\app\Models\Role;
use LaravelEnso\Discussions\app\Models\Reply;
use LaravelEnso\Discussions\app\Enums\Reactions;
use LaravelEnso\Discussions\app\Models\Reaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\Discussions\app\Models\Discussion;
use LaravelEnso\Discussions\app\Traits\Discussable;

class DiscussionsTest extends TestCase
{
    use RefreshDatabase;

    private $testModel;

    protected function setUp()
    {
        parent::setUp();

        $this->faker = Factory::create();

        //$this->withoutExceptionHandling();

        $this->seed()
            ->actingAs(User::first());

        $this->testModel = $this->model();
    }

    /** @test */
    public function can_get_discussions_index()
    {
        $this->get(route('core.discussions.index', [
            'discussable_type' => get_class($this->testModel),
            'discussable_id' => $this->testModel->id
        ], false))->assertStatus(200);
    }

    /** @test */
    public function can_store_discussion()
    {
        $discussion = factory(Discussion::class)->make([
            'discussable_id' => $this->testModel->id,
            'discussable_type' => DiscussionTestModel::class,
        ]);

        $this->post(route('core.discussions.store'), $discussion->toArray() + [
                'path' => $this->faker->url
        ])->assertStatus(201);
    }

    /** @test */
    public function can_update_discussion()
    {
        $discussion = factory(Discussion::class)->create([
            'discussable_id' => $this->testModel->id,
            'discussable_type' => DiscussionTestModel::class,
        ]);

        $discussion->body = 'edited';

        $this->patch(
            route('core.discussions.update', $discussion->id, false),
            $discussion->toArray() + [
                'path' => $this->faker->url,
            ]
        )->assertStatus(200);

        $this->assertEquals($discussion->fresh()->body, 'edited');
    }
    
    /** @test */
    public function can_delete_discussion()
    {
        $discussion = factory(Discussion::class)->create([
            'discussable_id' => $this->testModel->id,
            'discussable_type' => DiscussionTestModel::class,
        ]);

        $this->delete(route('core.discussions.destroy', $discussion->id, false))
            ->assertStatus(200);
    }

    /** @test */
    public function can_only_act_on_allowed_discussion()
    {
        $discussion = factory(Discussion::class)->create([
            'discussable_id' => $this->testModel->id,
            'discussable_type' => DiscussionTestModel::class,
        ]);

        $this->actingAs($this->createForeignUser());

        $this->delete(route('core.discussions.destroy', $discussion->id, false))
            ->assertStatus(403);
        
        $discussion->body = 'edited';

        $this->patch(
            route('core.discussions.update', $discussion->id, false),
            $discussion->toArray() + [
                'path' => $this->faker->url,
            ]
        )->assertStatus(403);
    }

    /** @test */
    public function can_store_reply_to_discussion()
    {
        $reply = Reply::make([
            'discussion_id' => factory(Discussion::class)->create([
                    'discussable_id' => $this->testModel->id,
                    'discussable_type' => DiscussionTestModel::class,
                ])->id,
            'body' =>  $this->faker->text
        ]);

        $this->post(route('core.discussions.storeReply'), $reply->toArray())->assertStatus(201);
    }

    /** @test */
    public function can_update_reply_to_discussion()
    {
        $reply = Reply::create([
            'discussion_id' => factory(Discussion::class)->create([
                    'discussable_id' => $this->testModel->id,
                    'discussable_type' => DiscussionTestModel::class,
                ])->id,
            'body' =>  $this->faker->text
        ]);

        $reply->body = 'edited';

        $this->patch(
            route('core.discussions.updateReply', $reply->id, false),
            $reply->toArray()
        )->assertStatus(200);

        $this->assertEquals($reply->fresh()->body, 'edited');
    }

    /** @test */
    public function can_delete_reply_to_discussion()
    {
        $reply = Reply::create([
            'discussion_id' => factory(Discussion::class)->create([
                    'discussable_id' => $this->testModel->id,
                    'discussable_type' => DiscussionTestModel::class,
                ])->id,
            'body' =>  $this->faker->text
        ]);

        $this->delete(route('core.discussions.destroyReply', $reply->id, false))
            ->assertStatus(200);
    }

    /** @test */
    public function can_only_act_on_own_reply()
    {
        $reply = Reply::create([
            'discussion_id' => factory(Discussion::class)->create([
                    'discussable_id' => $this->testModel->id,
                    'discussable_type' => DiscussionTestModel::class,
                ])->id,
            'body' =>  $this->faker->text
        ]);

        $this->actingAs($this->createForeignUser());

        $this->delete(route('core.discussions.destroyReply', $reply->id, false))
            ->assertStatus(403);
        
        $reply->body = 'edited';

        $this->patch(
            route('core.discussions.updateReply', $reply->id, false),
            $reply->toArray()
        )->assertStatus(403);
    }

    /** @test */
    public function can_toggle_reaction()
    {
        $reactionParams = collect([
            'reactableId' => factory(Discussion::class)->create([
                    'discussable_id' => $this->testModel->id,
                    'discussable_type' => DiscussionTestModel::class,
                ])->id,
            'reactableType' => 'discussion',
            'type' => Reactions::Clap,
            'userId' => auth()->user()->id,
        ]);

        $this->post(route('core.discussions.react'), $reactionParams->toArray())->assertStatus(200);
    }

    private function model()
    {
        $this->createTestTable();

        return DiscussionTestModel::create(['name' => 'discussable']);
    }

    private function createTestTable()
    {
        Schema::create('discussion_test_models', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        return $this;
    }

    private function createForeignUser()
    {
        return factory(User::class)->create([
            'role_id' => function () {
                return factory(Role::class)->create()->id;
            },
            'is_active' => true,
        ]);
    }
}

class DiscussionTestModel extends Model
{
    use Discussable;

    protected $fillable = ['name'];
}
