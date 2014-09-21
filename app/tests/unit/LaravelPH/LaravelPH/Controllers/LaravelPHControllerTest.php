<?php namespace Tests\Unit\LaravelPH\LaravelPH\Controllers;

use TestCase;

class LaravelPHControllerTest extends TestCase
{
    public function testShowHome()
    {
        $crawler = $this->client->request('GET', route('laravelph.showHomePage'));
        $this->assertTrue($this->client->getResponse()->isOk());
    }

}