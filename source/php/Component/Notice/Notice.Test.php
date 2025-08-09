<?php

namespace ComponentLibrary\Component\Notice;

use ComponentLibrary\Component\BaseController;
use Mockery;

class NoticeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @testdox init() - Should convert $message to array if is object.
     */
    public function testConvertsMessageToArrayIfIsObject()
    {   
        $baseControllerMock = Mockery::mock(BaseController::class)->makePartial();
        $baseControllerMock->shouldReceive('__construct')->once();
        $message = (object) ['title' => 'Title', 'message' => 'Message'];
        $data = ['type' => null, 'stretch' => null, 'message' => $message, 'action' => null, 'dismissable' => null];

        $notice = new Notice($data, new \ComponentLibrary\Cache\StaticCache(), new \ComponentLibrary\Helper\TagSanitizer());
        $data = $notice->getData();

        $this->assertEquals($data['message']['title'], 'Title');
        $this->assertEquals($data['message']['message'], 'Message');
    }
}
