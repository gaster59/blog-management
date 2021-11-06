<?php

namespace Tests\Unit\Service;

use PHPUnit\Framework\TestCase;
use Illuminate\Http\Request;
use App\Service\CommonService;
use Mockery;
use Mockery\MockInterface;

class CommonServiceTest extends TestCase
{
    

    public function setUp() : void
    {
        parent::setUp();
        $this->commonService = new CommonService();
    }

    public function testSum()
    {
        $expect = 3;
        
        // $result = 3;
        // Mockery::mock(CommonService::class)->shouldReceive('sum')->with($a =2, $b = 2)->andReturn($result);
        
        $result = $this->commonService->sum(1,2);
        $this->assertEquals($expect, $result);
    }
}
