<?php

namespace Tests\Feature\Evaluation;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MonthlyEvaluationCategoryTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }
    /**
     * Test can store evaluation category
     *
     * @test 
     */
    public function can_store_evaluation_category()
    {
        $response = $this->json('POST','/api/store/evaluation/category', [          
            'monthly_evaluation_id' => 1,
            'task' => "catogery of key result area test task"
        ]);
      
        $response->assertStatus(200);
    }
     /**
     * Test can update evaluation category
     *
     * @test 
     */
    public function can_update_evaluation_category()
    {
        
        $response = $this->json('POST','/api/update/evaluation/category', [ 
            'id' => 3,     
            'task' => "update of key result area test task"
        ]);
      
        $response->assertStatus(200);
    }

     /**
     * Test can delete evaluation category
     *
     * @test 
     */
    public function can_delete_evaluation_category()
    {
        // $id = 2;
        // $response = $this->deleteJson("/api/delete/evaluation/{$id}");
        // $response->assertStatus(200)->assertJson(['message' => 'Record has been deleted']);
    }
}
