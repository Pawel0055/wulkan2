<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookingControllerTest extends WebTestCase
{
    public function testGetBookings()
    {
        $client = static::createClient();
        $client->request('GET', '/booking/get');

        $this->assertResponseIsSuccessful();
    }

    public function testAddBooking()
    {
        $client = static::createClient();
        $client->request('POST', '/booking/add', [
            'json' => [
                'receptionHours' => '9:00',
                'registrationNumber' => 'ZS2121',
                'date' => '2022-02-02'
            ]
        ]);

        $this->assertResponseIsSuccessful();
    }
}