<?php

namespace App\Enums;

enum StatusEnum: string
{
	case Success = 'success';
	case Error = 'error';
	case Warning = 'warning';

}
