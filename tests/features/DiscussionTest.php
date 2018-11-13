<?php

use Faker\Factory;
use Tests\TestCase;
use LaravelEnso\Core\app\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\Discussions\app\Models\Discussion;
use LaravelEnso\Discussions\app\Traits\Discussable;

class DiscussionTest extends TestCase
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
        
        $this->createTestTable();

        $this->testModel = $this->discussionModel();

        $this->postParams = $this->postParams();
    }

    /** @test */
    public function can_get_discussions_index()
    {
        $this->get(route('core.discussions.index', $this->testModel->toArray(), false))
            ->assertStatus(200)
            ->assertJsonStructure([['body']]);
    }

    /** @test */
    public function can_store_discussion()
    {
        $this->post(route('core.discussions.store'), $this->postParams->toArray() + [
                'path' => $this->faker->url
        ])->assertStatus(201);
    }

    /** @test */
    public function can_update_discussion()
    {
        $this->testModel->body = 'edited';

        $this->patch(
            route('core.discussions.update', $this->testModel->id, false),
            $this->testModel->toArray() + [
                'path' => $this->faker->url,
            ]
        )->assertStatus(200);

        $this->assertEquals($this->testModel->fresh()->body, 'edited');
    }
    
    /** @test */
    public function can_delete_discussion()
    {
        $this->delete(route('core.discussions.destroy', $this->testModel->id, false))
            ->assertStatus(200);
    }

    /** @test */
    public function can_only_act_on_allowed_discussion()
    {
        $this->actingAs($this->anotherUser());

        $this->delete(route('core.discussions.destroy', $this->testModel->id, false))
            ->assertStatus(403);
        
        $this->testModel->body = 'edited';

        $this->patch(
            route('core.discussions.update', $this->testModel->id, false),
            $this->testModel->toArray() + [
                'path' => $this->faker->url,
            ]
        )->assertStatus(403);
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

    private function discussionModel()
    {
        return factory(Discussion::class)->create([
            'discussable_id' => DiscussionTestModel::create([
                    'name' => 'discussable'
                ])->id,
            'discussable_type' => DiscussionTestModel::class,
        ]);
    }

    private function postParams()
    {
        return factory(Discussion::class)->make([
            'discussable_id' => DiscussionTestModel::create([
                    'name' => 'discussable'
                ])->id,
            'discussable_type' => DiscussionTestModel::class,
        ]);
    }

    private function anotherUser()
    {
        return factory(User::class)->create([
            'is_active' => true,
        ]);
    }
}
class DiscussionTestModel extends Model
{
    use Discussable;

    protected $fillable = ['name'];
}
