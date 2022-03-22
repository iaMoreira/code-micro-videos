<?php

namespace Tests\Unit\Models;

use App\Models\Genre;
use PHPUnit\Framework\TestCase;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class GenreTest extends TestCase
{

    use DatabaseMigrations;

    private $genre;

    protected function setUp(): void
    {
        parent::setUp();
        $this->genre = new Genre();
    }
    
    public function testFillableAtributte()
    {
        $fillable = ['name', 'is_active'];
        $this->assertEquals($fillable, $this->genre->getFillable());
    }

    public function testUseTraitsAtributte() 
    {
        $genreTraits = array_keys(class_uses(Genre::class));
        $traits = [SoftDeletes::class, Uuid::class];
        $this->assertEquals($traits, $genreTraits);
    }

    public function testUseDatesAtributte() 
    {
        $genreDates = $this->genre->getDates();
        $dates = ['deleted_at', 'created_at', 'updated_at'];
        foreach($dates as $date) {
            $this->assertContains($date, $genreDates);
        }
        $this->assertCount(count($dates), $genreDates);
    }

    public function testCastsAtributte() 
    {
        $casts = ['id' => 'string', 'is_active' => 'boolean'];
        $this->assertEquals($casts, $this->genre->getCasts());
    }

    public function testIncrementingAtributte() 
    {
        $this->assertFalse($this->genre->incrementing);
    }

}
