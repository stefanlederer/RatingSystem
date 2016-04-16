<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BewertungControllerTest extends WebTestCase
{
    public function testBewertung()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/bewertung');
    }

}
