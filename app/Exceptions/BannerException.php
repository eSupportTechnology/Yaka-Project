<?php

namespace App\Exceptions;

use Exception;

class BannerException extends Exception
{
    /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report()
    {
        \Log::error('Banner Exception: ' . $this->getMessage());
    }
}
