<?php

class LoginTest extends TestCase
{
    public function testGetLogin()
    {
        $this->visit('/axe/login')
            ->see("axe后台管理系统")
            ->see(csrf_token());
    }
}