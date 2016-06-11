<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SurveyControllerTest extends WebTestCase
{
    public function testAllsurvey()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/allSurvey');
    }

}
