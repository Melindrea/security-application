<?php
namespace Test\Controller;

class HomeTest extends \Test\TestCase
{

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $crawler = $this->get('/');

        $this->assertTrue($this->client->getResponse()->isOk());
    }
}
