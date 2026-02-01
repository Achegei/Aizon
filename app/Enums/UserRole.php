<?php
// app/Enums/UserRole.php
namespace App\Enums;

enum UserRole: string
{
    // Admin levels
    case SUPER_ADMIN = 'super_admin';
    case ADMIN       = 'admin';
    case STAFF       = 'staff'; // regular admin user with limited permissions

    // Platform users
    case CREATOR     = 'creator';
    case EMPLOYER    = 'employer';
    case BUYER       = 'buyer';
}
