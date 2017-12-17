<?php

namespace Book\ReviewBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CoverControllerTest extends WebTestCase
{
    public function testUploadbookcover()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/uploadBookCover');
    }

    public function testEditbookcover()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editBookCover');
    }

}
