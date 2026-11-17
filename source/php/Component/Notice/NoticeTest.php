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

        $notice = new Notice(
            $data,
            new \ComponentLibrary\Cache\StaticCache(),
            new \ComponentLibrary\Helper\TagSanitizer(),
        );
        $data = $notice->getData();

        $this->assertEquals($data['message']['title'], 'Title');
        $this->assertEquals($data['message']['message'], 'Message');
    }

    /**
     * @testdox init() - Should add a state class for supported types and fall back to info.
     * @dataProvider typeProvider
     */
    public function testAddsStateClassForType(?string $type, string $expectedClass)
    {
        $this->assertContains($expectedClass, $this->createNotice(['type' => $type])['classList']);
    }

    public static function typeProvider(): array
    {
        return [
            'danger' => ['danger', 'c-notice--danger'],
            'unknown falls back to info' => ['danger-dark', 'c-notice--info'],
        ];
    }

    /**
     * @testdox init() - Should add the alt modifier when altColor is true.
     */
    public function testAddsAltModifierWhenAltColorIsTrue()
    {
        $classList = $this->createNotice(['type' => 'danger', 'altColor' => true])['classList'];

        $this->assertContains('c-notice--danger', $classList);
        $this->assertContains('c-notice--alt', $classList);
    }

    /**
     * @testdox init() - Should not add the alt modifier by default.
     */
    public function testDoesNotAddAltModifierByDefault()
    {
        $this->assertNotContains('c-notice--alt', $this->createNotice(['type' => 'danger'])['classList']);
    }

    private function createNotice(array $data): array
    {
        $data = [
            ...['type' => null, 'stretch' => null, 'message' => [], 'action' => null, 'dismissable' => null],
            ...$data,
        ];

        $notice = new Notice(
            $data,
            new \ComponentLibrary\Cache\StaticCache(),
            new \ComponentLibrary\Helper\TagSanitizer(),
        );

        return $notice->getData();
    }
}
