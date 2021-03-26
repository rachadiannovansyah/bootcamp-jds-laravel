<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // provide data for mocking
        $this->user = User::factory()->create();
        $this->author = Author::factory()->create();
    }

    /**
     * [testIndex render authors]
     * @test
     * @return void
     */
    public function test_index_author()
    {
        // 1. Call a mock data
        $user = $this->user;

        // 2. Hit api endpoint for testing
        $response = $this->actingAs($user)->get(route('authors.index'));

        // 3. Assertion
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * [testIndex render authors per page by 50]
     * @test
     * @return void
     */
    public function test_index_author_using_perpage()
    {
        // 1. Mock data
        $user = $this->user;
        // 2. Hit Api Endpoint
        $response = $this->actingAs($user)->get(route('authors.index', ['perPage' => 50]));
        // 3. Verify and Assertion
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * [testIndex render authors search by name]
     * @test
     * @return void
     */
    public function index_author_filter_by_name()
    {
        // 1. Mock data
        $user = $this->user;
        // 2. Hit Api Endpoint
        $response = $this->actingAs($user)->get(route('authors.index', ['name' => 'sedekahcode']));
        // 3. Verify and Assertion
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * [testStore a new author]
     * @test
     * @return void
     */
    public function test_store_author()
    {
        // 1. Call a mock data
        $user = $this->user;
        $data = [
            'name' => 'Novansyah'
        ];

        // 2. Hit api endpoint for testing
        $response = $this->actingAs($user)->post(route('authors.store'), $data);

        // 3. Assertion
        $response->assertStatus(Response::HTTP_CREATED);
    }

    /**
     * [testShow render an author]
     * @test
     * @return void
     */
    public function test_show_author()
    {
        // 1. Call a mock data
        $user = $this->user;

        // 2. Hit api endpoint for testing
        $response = $this->actingAs($user)->get(route('authors.show', $this->author));

        // 3. Assertion
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * [testUpdate an author]
     * @test
     * @return void
     */
    public function test_update_author()
    {
        // 1. Call a mock data
        $user = $this->user;
        $data = [
            'name' => 'Inyourdream'
        ];

        // 2. Hit api endpoint for testing
        $response = $this->actingAs($user)->put(route('authors.update', $this->author), $data);

        // 3. Assertion
        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * [testDestroy an author]
     * @test
     * @return void
     */
    public function test_destroy_author()
    {
        // 1. Call a mock data
        $user = $this->user;

        // 2. Hit api endpoint for testing
        $response = $this->actingAs($user)->delete(route('authors.destroy', $this->author));

        // 3. Assertion
        $response->assertStatus(Response::HTTP_OK);
    }
}
