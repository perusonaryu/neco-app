<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Cat;

use Illuminate\Http\UploadedFile;

class CatTest extends TestCase
{
    use RefreshDatabase;


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCatRegister()
    {
        $dummyImage = UploadedFile::fake()->image('test.jpg');
        $user = factory(User::class)->create();
        // dd($dummyImage);
        $cat = [
            'name' => 'テスト猫',
            'age' => '10',
            'gender' => 'おす',
            'personality' => 'おとなしい',
            'image' => $dummyImage,
            'userId' => $user->id,
        ];

        $response = $this->post(route('cat.register'), $cat);
        $response->assertStatus(200);
    }


    public function testMyCatdataGet()
    {
        $cat = factory(Cat::class)->create();
        $response = $this->get(route('cat.get', ['id' => 1]));

        $response ->assertStatus(200);
    }

    public function testCatEdit()
    {
        $cat = factory(Cat::class)->create();

        $response = $this->get(route('cat.get', ['id' => $cat->id]));

        $response ->assertStatus(200);
    }

    public function testCatUpdate()
    {
        $cat = factory(Cat::class)->create();

        $cat = [
            'id' => $cat->id,
            'name' => 'テスト猫',
            'age' => '10',
            'gender' => 'おす',
            'personality' => 'おとなしい',
            'image' => 'test.jpg',
        ];


        $response = $this->put(route('cat.update'), $cat);

        $response ->assertStatus(200);
    }

    public function testCatDelete()
    {
        $cat = factory(Cat::class)->create();

        $response = $this->delete(route('cat.delete', ['cat_id'=> $cat->id]));

        $response ->assertStatus(200);
    }

    
}
