<?php

namespace EXS\ErrorBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ErrorControllerTest extends WebTestCase
{
    public function testBadpageAction()
    {
        $client = static::createClient();

        // Verify the controller action exists
        $crawler = $client->request('GET', '/_test/error/http/500');
        $this->assertTrue($crawler->filter('html:contains("500 Test")')->count() > 0);
    }
}
