<?php
namespace Serato\SwsApp\Test\Slim\Controller\Traits;

use Serato\SwsApp\Test\TestCase;
use Serato\SwsApp\Slim\Controller\Traits\ControllerTraitJsonResponse;
use ReflectionClass;
use Slim\Http\Response;

/**
 * Unit tests for Serato\SwsApp\Slim\Controller\Traits\ControllerTraitJsonResponse
 */
class ControllerTraitJsonResponseTest extends TestCase
{
    public function testSmokeTest()
    {
        $args = ['var1' => 'val1', 'var2' => 'val2'];

        $mock = $this->getMockForTrait(ControllerTraitJsonResponse::class);

        $reflection = new ReflectionClass(get_class($mock));

        $appendJsonBodyMethod = $reflection->getMethod('appendJsonBody');
        $appendJsonBodyMethod->setAccessible(true);
        $appendJsonBodyMethod->invokeArgs($mock, [$args]);
        $this->assertTrue(true);

        $writeJsonBodyMethod = $reflection->getMethod('writeJsonBody');
        $writeJsonBodyMethod->setAccessible(true);
        $response = $writeJsonBodyMethod->invokeArgs($mock, [new Response]);
        $this->assertTrue(is_a($response, 'Slim\Http\Response'));
        $this->assertEquals(200, $response->getStatusCode());
        $response = $writeJsonBodyMethod->invokeArgs($mock, [new Response(401)]);
        $this->assertEquals(401, $response->getStatusCode());
    }
}
