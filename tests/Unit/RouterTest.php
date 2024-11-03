<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use App\Router;
use App\Exception\RouteNotFoundException;

class RouterTest extends TestCase
{
    /**
     * @var Router
     */
    private Router $router;

    public function setUp(): void
    {
        parent::setUp();

        // given that we have a router object
        $this->router = new Router();
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function is_registers_a_route(): void
    {
        // when we call a register  method
        $this->router->register('/users',  ['Users', 'index'], 'get' );

        // then we asset router was register
        $expected = [
                'get' => [
                        '/users' => ['Users', 'index']
                    ]
            ];
        $this->AssertEquals($expected, $this->router->routes());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function is_registers_a_get_route(): void
    {
        // when we call a register  method
        $this->router->get('/users',  ['Users', 'index']);

        // then we asset router was register
        $expected = [
            'get' => [
                    '/users' => ['Users', 'index']
                ]
        ];
        $this->AssertEquals($expected, $this->router->routes());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function is_registers_a_post_route(): void
    {
       // when we call a pos  method
       $this->router->post('/users',  ['Users', 'index']);

       // then we asset router was pos
       $expected = [
           'post' => [
                   '/users' => ['Users', 'index']
               ]
       ];
       $this->AssertEquals($expected, $this->router->routes());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function there_are_no_routes_when_router_is_created(): void
    {
        // then we asset routes
        $this->assertEmpty($this->router->routes());
    }

    
    #[DataProvider('routeNotFoundCases')]
    #[\PHPUnit\Framework\Attributes\Test]
    public function it_throws_route_not_found_exception(
        string $requestUri,
        string $requestMethod
    ): void
    {
        $users = new class()
        {
            public function delete()
            {
                return true;
            }
        };
        $this->router->post('/users', [$users::class, 'store']);
        $this->router->get('/users', [$users::class, 'index']);

        $this->expectException(RouteNotFoundException::class);
        $this->router->resolve($requestUri, $requestMethod);
    }

    public static function routeNotFoundCases(): array
    {
        return [
            ['/Users', 'put'],
            ['/Users', 'get'],
            ['/Users', 'post'],
            ['/Invoice', 'post'],
        ];
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_resolves_route_from_a_closure(): void
    {
        
        $this->router->get('/Users', fn() =>[1, 2, 3]);

        $this->assertEquals(
            [1, 2, 3],
            $this->router->resolve('/Users', 'get')
        );


    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function it_resolves_route(): void
    {
        $users = new class()
        {
            public function index()
            {
                return [1, 2, 3];
            }
        };
        $this->router->get('/Users', [$users::class, 'index']);

        $this->assertEquals(
            [1, 2, 3],
            $this->router->resolve('/Users', 'get')
        );


    }

}