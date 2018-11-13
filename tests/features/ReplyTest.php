<?php

use Tests\TestCase;
use LaravelEnso\Core\app\Models\User;
use LaravelEnso\Discussions\app\Models\Reply;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\Discussions\app\Models\Discussion;

class ReplyTest extends TestCase
{
    use RefreshDatabase;

    private $testModel;

    protected function setUp()
    {
        parent::setUp();

        //$this->withoutExceptionHandling();

        $this->seed()
            ->actingAs(User::first());

        $this->testModel = $this->model();

        $this->postParams = $this->postParams();
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

        $this->assertEquals($this->testModel->fresh()->body, 'edited');
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
    }

    private function model()
    {
        return factory(Reply::class)->create([
            'discussion_id' => factory(Discussion::class)->create()->id
        ]);
    }

    private function postParams()
    {
        return factory(Reply::class)->make([
            'discussion_id' => factory(Discussion::class)->create()->id
        ]);
    }

    private function anotherUser()
    {
        return factory(User::class)->create([
            'is_active' => true,
        ]);
    }
}
