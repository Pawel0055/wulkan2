<?php

namespace App\Event;

use App\Entity\Booking;
use Symfony\Contracts\EventDispatcher\Event;

class BookingConfirmedEvent extends Event
{

    /**
     * Booking $booking
     */
    private $booking;

    const NAME = "booking.confirmed";

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function getBooking()
    {
        return $this->booking;
    }

    public function getReceptionHour()
    {
        return $this->booking->getReceptionHours();
    }
}