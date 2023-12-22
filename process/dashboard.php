<?php

use Core\Page;

if(!auth()->id)
{
    header('location:'.routeTo('auth/login'));
    die();
}

Page::set_title(__("crud.label.home"));
Page::setActive("crud.label.home");

return view('donasi/views/dashboard');