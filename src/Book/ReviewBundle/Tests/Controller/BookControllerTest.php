<?php

namespace Book\ReviewBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookControllerTest extends WebTestCase
{
    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/book/create');
    }

    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/book/show');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/book/edit');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/delete');
    }

}
