<?php

class LoginTest extends TestCase
{
    public function testGetLogin()
    {
        $this->visit('/axe/login')
            ->see("LAY-user-login")
            ->see(csrf_token());
    }
}