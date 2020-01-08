<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use LaravelEnso\Core\App\Models\User;
use LaravelEnso\Discussions\App\Models\Discussion;
use LaravelEnso\Discussions\App\Models\Reply;
use LaravelEnso\Discussions\App\Traits\Discussable;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    private $testModel;

    protected function setUp(): void
    {
        parent::setUp();

        // $this->withoutExceptionHandling();

        $this->seed()
            ->actingAs(User::first());

        $this->createTestTable();
        $this->testModel = $this->model();

        $this->postParams = factory(Reply::class)->make([
            'discussion_id' => factory(Discussion::class)->create($this->postParams())->id
        ]);
    }

    /** @test */
    public function can_store_reply_to_discussion()
    {
        $this->post(route('core.discussions.storeReply'), $this->postParams->toArray())
            ->assertStatus(201);
    }

    /** @test */
    public function can_update_reply_to_discussion()
    {
        $this->testModel->body = 'edited';

        $this->patch(
            route('core.discussions.updateReply', $this->testModel->id, false),
            $this->testModel->toArray()
        )->assertStatus(200);

        $this->assertEquals($this->testModel->body, $this->testModel->fresh()->body);
    }

    /** @test */
    public function can_delete_reply_to_discussion()
    {
        $this->delete(route('core.discussions.destroyReply', $this->testModel->id, false))
            ->assertStatus(200);
    }

    /** @test */
    public function can_only_act_on_own_reply()
    {
        $this->actingAs($this->anotherUser());

        $this->delete(route('core.discussions.destroyReply', $this->testModel->id, false))
            ->assertStatus(403);

        $this->testModel->body = 'edited';

        $this->patch(
            route('core.discussions.updateReply', $this->testModel->id, false),
            $this->testModel->toArray()
        )->assertStatus(403);

        $this->assertNotEquals($this->testModel->body, $this->testModel->fresh()->body);
    }

    private function model()
    {
        return factory(Reply::class)->create([
            'discussion_id' => factory(Discussion::class)
                ->create($this->postParams())->id
        ]);
    }

    private function postParams()
    {
     return [
         'discussable_id' => factory(Discussion::class)->create([
            'discussable_id' => DiscussionReplyTestModel::create(['name' => 'discussable'])->id,
            'discussable_type' => DiscussionReplyTestModel::class,
        ])->id,
        'discussable_type' => DiscussionReplyTestModel::class,
         ];
    }

    private function anotherUser()
    {
        return factory(User::class)->create(['is_active' => true]);
    }

    private function createTestTable()
    {
        Schema::create('discussion_reply_test_models', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        return $this;
    }
}

class DiscussionReplyTestModel extends Model
{
    use Discussable;

    protected $fillable = ['name'];
}
