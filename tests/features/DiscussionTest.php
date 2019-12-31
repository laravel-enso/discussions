<?php

use Faker\Factory;
use Tests\TestCase;
use LaravelEnso\Core\App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\Discussions\App\Models\Discussion;
use LaravelEnso\Discussions\App\Traits\Discussable;

class DiscussionTest extends TestCase
{
    use RefreshDatabase;

    private $testModel;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = Factory::create();

        // $this->withoutExceptionHandling();

        $this->seed()
            ->actingAs(User::first());

        $this->createTestTable();

        $this->testModel = $this->postParams();
        $this->testModel->save();
    }

    /** @test */
    public function can_get_discussions_index()
    {
        $this->get(route('core.discussions.index', $this->testModel->toArray(), false))
            ->assertStatus(200)
            ->assertJsonFragment(['body' => $this->testModel->body]);
    }

    /** @test */
    public function can_store_discussion()
    {
        $this->post(
            route('core.discussions.store'),
            $this->postParams()->toArray() + ['path' => $this->faker->url]
        )->assertStatus(201);
    }

    /** @test */
    public function can_update_discussion()
    {
        $this->testModel->body = 'edited';

        $this->patch(
            route('core.discussions.update', $this->testModel->id, false),
            $this->testModel->toArray() + ['path' => $this->faker->url]
        )->assertStatus(200);

        $this->assertEquals($this->testModel->fresh()->body, 'edited');
    }

    /** @test */
    public function can_delete_discussion()
    {
        $this->assertNotNull($this->testModel);

        $this->delete(route('core.discussions.destroy', $this->testModel->id, false))
            ->assertStatus(200);

        $this->assertNull($this->testModel->fresh());
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
            $this->testModel->toArray() + ['path' => $this->faker->url]
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

    private function postParams()
    {
        return factory(Discussion::class)
            ->make([
                'discussable_id' => DiscussionTestModel::create(['name' => 'discussable'])->id,
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
