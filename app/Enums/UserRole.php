<?php
// app/Enums/UserRole.php

namespace App\Enums;

enum UserRole: string
{
    // Admin levels
    case SUPER_ADMIN = 'super_admin';
    case ADMIN       = 'admin';
    case STAFF       = 'staff';

    // Platform users
    case MEMBER      = 'member';   // universal base user
    case CREATOR     = 'creator';  // upgraded member
    case EMPLOYER    = 'employer'; // upgraded member
}
