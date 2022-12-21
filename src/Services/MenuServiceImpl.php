<?php

namespace ToiLaDev\Menu\Services;


interface MenuServiceImpl
{
    public function allMenus();
    public function sortFromRequest($request);
    public function widget($name);
}