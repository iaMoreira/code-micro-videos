<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use PHPUnit\Framework\TestCase;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends TestCase
{

    use DatabaseMigrations;

    private $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->category = new Category();
    }
    
    public function testFillableAtributte()
    {
        $fillable = ['name', 'description', 'is_active'];
        $this->assertEquals($fillable, $this->category->getFillable());
    }

    public function testUseTraitsAtributte() 
    {
        $categoryTraits = array_keys(class_uses(Category::class));
        $traits = [SoftDeletes::class, Uuid::class];
        $this->assertEquals($traits, $categoryTraits);
    }

    public function testUseDatesAtributte() 
    {
        $categoryDates = $this->category->getDates();
        $dates = ['deleted_at', 'created_at', 'updated_at'];
        foreach($dates as $date) {
            $this->assertContains($date, $categoryDates);
        }
        $this->assertCount(count($dates), $categoryDates);
    }

    public function testCastsAtributte() 
    {
        $casts = ['id' => 'string'];
        $this->assertEquals($casts, $this->category->getCasts());
    }

    public function testIncrementingAtributte() 
    {
        $this->assertFalse($this->category->incrementing);
    }


}
