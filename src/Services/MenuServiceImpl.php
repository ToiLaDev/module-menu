<?php

namespace ToiLaDev\Menu\Services;


interface MenuServiceImpl
{
    public function sortFromRequest($request);
    public function widget($name);
}