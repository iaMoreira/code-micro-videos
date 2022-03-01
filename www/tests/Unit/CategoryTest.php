<?php

namespace Tests\Unit;

use App\Models\Category;
use PHPUnit\Framework\TestCase;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryTest extends TestCase
{

    public function testFillableAtributte()
    {
        $category = new Category();
        $fillable = ['name', 'description', 'is_active'];
        $this->assertEquals($fillable, $category->getFillable());
    }

    public function testUseTraitsAtributte() 
    {
        $categoryTraits = array_keys(class_uses(Category::class));
        $traits = [SoftDeletes::class, Uuid::class];
        $this->assertEquals($traits, $categoryTraits);
    }

    public function testUseDatesAtributte() 
    {
        $category = new  Category();
        $categoryDates = $category->getDates();
        $dates = ['deleted_at', 'created_at', 'updated_at'];
        foreach($dates as $date) {
            $this->assertContains($date, $categoryDates);
        }
        $this->assertCount(count($dates), $categoryDates);
    }

    public function testCastsAtributte() 
    {
        $category = new Category();
        $casts = ['id' => 'string'];
        $this->assertEquals($casts, $category->getCasts());
    }

    public function testIncrementingAtributte() 
    {
        $category = new Category();
        $this->assertFalse($category->incrementing);
    }


}
