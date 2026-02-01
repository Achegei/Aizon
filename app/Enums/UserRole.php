<?php
// app/Enums/UserRole.php
namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case CREATOR = 'creator';
    case EMPLOYER = 'employer';
    case BUYER = 'buyer';
}
