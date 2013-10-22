<?php
namespace Test\Model;

use Zizaco\FactoryMuff\Facade\FactoryMuff;
class MessageTest extends \Test\TestCase
{
    protected $useDatabase = true;

    public function testRelationWithUser()
    {
        // Instantiate, fill with values, save and return
        $message = FactoryMuff::create('\Model\Message');

        // Thanks to FactoryMuff, this $post have an author
        $this->assertEquals($message->user_id, $message->user->id);
    }
}
