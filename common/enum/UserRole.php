<?php

namespace common\enum;

enum UserRole: string
{
    case ROLE_ADMIN = 'admin';
    case ROLE_CLIENT = 'client';
}
