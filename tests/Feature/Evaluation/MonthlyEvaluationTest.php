<?php

namespace Tests\Feature\Evaluation;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MonthlyEvaluationTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }
    /**
     * Test supervisor can store evaluation
     *
     * @test 
     */
    public function supervisor_can_store_evaluation()
    {
        
        // $response = $this->json('POST','/api/store/evaluation', [          
        //     'user_id' => 13,
        //     'employee_id' => 2,
        //     'key_result_area' => "key result area test task",
        //     'month_of_evaluation' => date('Y-d-m',strtotime('2021-04-12'))
        // ]);
      
        // $response->assertStatus(200);
    }
     /**
     * Test supervisor can update evaluation
     *
     * @test 
     */
    public function supervisor_can_update_evaluation()
    {
        
        // $response = $this->json('POST','/api/update/evaluation', [ 
        //     'id' => 3,     
        //     'key_result_area' => "update key result area test",
        //     'month_of_evaluation' => date('Y-d-m',strtotime('2021-04-12'))
        // ]);
      
        // $response->assertStatus(200);
    }
     /**
     * Test supervisor can delete evaluation
     *
     * @test 
     */
    public function supervisor_can_delete_evaluation()
    {
        // $id = 12;
        // $response = $this->deleteJson("/api/delete/evaluation/{$id}");
        // $response->assertStatus(200)->assertJson(['message' => 'Record has been deleted']);
    }
     /**
     * Test employee can get his/her evaluation
     *
     * @test 
     */
    public function employee_can_get_evaluation()
    {
        $response = $this->json('GET','/api/evaluation');
        $response->assertStatus(200);
    }
     /**
     * Test employee can get his/her evaluation
     *
     * @test 
     */
    public function can_get_particular_evaluation()
    {
        $response = $this->json('GET','api/monthlyevaluations/kpi/34');
        $response->assertStatus(200);
    }

    
}
