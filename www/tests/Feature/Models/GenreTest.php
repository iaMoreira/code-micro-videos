<?php

namespace Tests\Feature\Models;

use App\Models\Genre;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class GenreTest extends TestCase
{
    use DatabaseMigrations;

    public function testList()
    {
        factory(Genre::class, 1)->create();

        $genres = Genre::all();
        $this->assertCount(1, $genres);
        $genreKeys = array_keys($genres->first()->getAttributes());
        $this->assertEqualsCanonicalizing(['id', 'name', 'is_active', 'created_at', 'deleted_at', 'updated_at'], $genreKeys);
    }

    public function testCreate() {
        $genre = Genre::create([
            'name' => 'John',
        ]);
        $genre->refresh();   

        $this->assertEquals(36, strlen($genre->id));
        $this->assertEquals('John', $genre->name);
        $this->assertTrue($genre->is_active);
        
        $genreDesactive = Genre::create([
            'name' => 'John',
            'is_active' => false
        ]);

        $this->assertFalse($genreDesactive->is_active);
    }

    public function testUpdate() {
        $genre = factory(Genre::class)->create([
            'is_active' => false
        ])->first();

        $data = [
            'name' => 'John',
            'is_active' => true
        ];

        $genre->update($data);

        foreach($data as $key => $value) {
             $this->assertEquals($value, $genre->{$key});
        }
    }

    public function testDelete() {
        $genre = factory(Genre::class)->create();
        $genre->delete();
        $this->assertNull(Genre::find($genre->id));

        $genre->restore();
        $this->assertNotNull(Genre::find($genre->id));

    }

}
