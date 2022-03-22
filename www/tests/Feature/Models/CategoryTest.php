<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    public function testList()
    {
        factory(Category::class, 1)->create();

        $categories = Category::all();
        $this->assertCount(1, $categories);
        $categoryKeys = array_keys($categories->first()->getAttributes());
        $this->assertEqualsCanonicalizing(['id', 'name', 'description', 'is_active', 'created_at', 'deleted_at', 'updated_at'], $categoryKeys);
    }

    public function testCreate() {
        $category = Category::create([
            'name' => 'John',
        ]);
        $category->refresh();   

        $this->assertEquals(36, strlen($category->id));
        $this->assertEquals('John', $category->name);
        $this->assertNull($category->description);
        $this->assertTrue($category->is_active);

        $categoryWithoutDescription = Category::create([
            'name' => 'John',
        ]);   

        $this->assertNull($categoryWithoutDescription->description);

        $categoryWithDescription = Category::create([
            'name' => 'John',
            'description' => 'default text'
        ]);

        $this->assertEquals('default text', $categoryWithDescription->description);
        
        $categoryDesactive = Category::create([
            'name' => 'John',
            'is_active' => false
        ]);

        $this->assertFalse($categoryDesactive->is_active);
    }

    public function testUpdate() {
        $category = factory(Category::class)->create([
            'description' => 'default',
            'is_active' => false
        ])->first();

        $data = [
            'name' => 'John',
            'description' => 'default text',
            'is_active' => true
        ];

        $category->update($data);

        foreach($data as $key => $value) {
             $this->assertEquals($value, $category->{$key});
        }
    }

    public function testDelete() {
        $category = factory(Category::class)->create();
        $category->delete();
        $this->assertNull(Category::find($category->id));

        $category->restore();
        $this->assertNotNull(Category::find($category->id));

    }

}
