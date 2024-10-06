<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponseTrait;
use App\Traits\LogTrait;

abstract class Controller
{
    use ApiResponseTrait, LogTrait;
}
