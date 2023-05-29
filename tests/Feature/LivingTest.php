<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LivingTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_listed_living()
    {
        $response = $this->get('api/living');
        $response->assertStatus(200);
    }
    public function test_listed_material()
    {
        $response = $this->get('api/material');
        $response->assertStatus(200);
    }
    public function test_listed_Decoration()
    {
        $response = $this->get('api/decoration');
        $response->assertStatus(200);
    }
    public function test_listed_categorieLiving()
    {
        $response = $this->get('api/categorie_living');
        $response->assertStatus(200);
    }
    public function test_listed_categorieMaterial()
    {
        $response = $this->get('api/categorie_material');
        $response->assertStatus(200);
    }
    public function test_listed_categorieDecoration()
    {
        $response = $this->get('api/categorie_decoration');
        $response->assertStatus(200);
    }
    // public function test_add_project()
    // {
    //     $response = $this->post('api/project', [
    //         'title_project' => 'Project Unit',
    //         'start_project' => '2023-12-05',
    //     ]);
    //     $response->assertStatus(200);
    // }
    // public function test_add_decoration()
    // {
    //     $response = $this->post('api/decoration', [
    //         'name_decoration' => 'test Unit',
    //         'description_decoration' => 'du texte',
    //         'price_decoration' => '50',
    //         'categorie_decoration_id' => '6',
    //         'picture_decoration' => 'image.jpg',
    //         'quantity_editable_decoration' => '0',
    //     ]);
    //     $response->assertStatus(200);
    // }
    // public function test_add_living()
    // {
    //     $response = $this->post('api/living', [
    //         'name_living' => 'test Unit',
    //         'description_living' => 'du texte',
    //         'price_living' => '50',
    //         'categorie_living_id' => '7',
    //         'quantity_editable_living' => '0',
    //         'picture_living' => 'image.jpg',
    //         'liter_min' => '10',
    //         'number_max' => '10',
    //         'number_min' => '10',
    //         'unique_living_category' => '0',
    //     ]);
    //     $response->assertStatus(200);
    // }
    // public function test_add_material()
    // {
    //     $response = $this->post('api/material', [
    //         'name_material' => 'Project Unit',
    //         'description_material' => '2023-12-05',
    //         'price_material' => '50',
    //         'categorie_material_id' => '14',
    //         'quantity_editable_material' => '0',
    //         'picture_material' => 'image.jpg',
    //         'kit' => '0',
    //         'liter' => '50',
    //         'content_kit' => '1,2,3',
    //     ]);
    //     $response->assertStatus(200);
    // }
}
