<?php
namespace Test\Controller;

class UsersTest extends \Test\TestCase
{

    public function __construct()
    {
        // We have no interest in testing Eloquent
        // $this->mock = \Mockery::mock('Eloquent', '\Model\User');
    }

    public function tearDown()
    {
        \Mockery::close();
    }
    /**
     * Tests that the index has users.
     *
     * @return void
     */
    public function testIndex()
    {
        // $this->mock
        //    ->shouldReceive('all')
        //    ->once()
        //    ->andReturn('foo');

        // $this->app->instance('\Model\User', $this->mock);

        $this->call('GET', 'users');

        $this->assertViewHas('users');
    }
}
