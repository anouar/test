<?php

namespace App\Tests\Controller;

use PHPUnit\Framework\TestCase;
class PageControllerTest extends TestCase
{
    public function setUp(): void
    {
        $this->url = 'http://test.dev:8000';
        parent::setUp();
    }

    public function testHomePage()
    {
        $this->assertEquals(true, strpos(get_headers($this->url)[0],'200'));
    }

    public function testLoginPage()
    {
        $this->assertEquals(true, strpos(get_headers($this->url)[0] . '/login','200'));
    }

    public function testMainPage()
    {
        $this->assertEquals(true, strpos(get_headers($this->url)[0]. '/main','200'));
    }

}
