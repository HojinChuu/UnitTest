<?php

class UserTest extends \PHPUnit\Framework\TestCase
{
    public function testThatWeCanGetTheFirstName()
    {
        $user = new \App\Models\User;

        $user->setFirstName('Hojin');

        $this->assertEquals($user->getFirstName(), 'Hojin');
    }

    public function testThatWeCanGetTheLastName()
    {
        $user = new \App\Models\User;

        $user->setLastName('Chu');

        $this->assertEquals($user->getLastName(), 'Chu');
    }

    public function testFullNameIsReturned()
    {
        $user = new \App\Models\User;
        
        $user->setFirstName('Hojin');
        $user->setLastName('Chu');

        $this->assertEquals($user->getFullName(), 'Hojin Chu');
    }

    public function testFirstAndLastNameAreTrimmed()
    {
        $user = new \App\Models\User;

        $user->setFirstName('   Hojin     ');
        $user->setLastName('   Chu        ');

        $this->assertEquals($user->getFirstName(), 'Hojin');
        $this->assertEquals($user->getLastName(), 'Chu');
    }

    public function testEmailAddressCanBeSet()
    {
        $user = new \App\Models\User;

        $user->setEmail('chuhojin@gmail.com');

        $this->assertEquals($user->getEmail(), 'chuhojin@gmail.com');
    }

    public function testEmailVariablesContainCorrectValues()
    {
        $user = new \App\Models\User;
        
        $user->setFirstName('Hojin');
        $user->setLastName('Chu');
        $user->setEmail('chuhojin@gmail.com');

        $emailVariables = $user->getEmailVariables();

        $this->assertArrayHasKey('full_name', $emailVariables);
        $this->assertArrayHasKey('email', $emailVariables);

        $this->assertEquals($emailVariables['full_name'], 'Hojin Chu');
        $this->assertEquals($emailVariables['email'], 'chuhojin@gmail.com');
    }
}