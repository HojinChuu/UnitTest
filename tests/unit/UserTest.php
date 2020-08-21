<?php

class UserTest extends \PHPUnit\Framework\TestCase
{
    protected $user;

    public function setUp(): void
    {
        $this->user = new \App\Models\User;
    }

    public function testThatWeCanGetTheFirstName()
    {
        $this->user->setFirstName('Hojin');

        $this->assertEquals($this->user->getFirstName(), 'Hojin');
    }

    public function testThatWeCanGetTheLastName()
    {
        $this->user->setLastName('Chu');

        $this->assertEquals($this->user->getLastName(), 'Chu');
    }

    public function testFullNameIsReturned()
    {
        $this->user->setFirstName('Hojin');
        $this->user->setLastName('Chu');

        $this->assertEquals($this->user->getFullName(), 'Hojin Chu');
    }

    public function testFirstAndLastNameAreTrimmed()
    {
        $this->user->setFirstName('   Hojin     ');
        $this->user->setLastName('   Chu        ');

        $this->assertEquals($this->user->getFirstName(), 'Hojin');
        $this->assertEquals($this->user->getLastName(), 'Chu');
    }

    public function testEmailAddressCanBeSet()
    {
        $this->user->setEmail('chuhojin@gmail.com');

        $this->assertEquals($this->user->getEmail(), 'chuhojin@gmail.com');
    }

    public function testEmailVariablesContainCorrectValues()
    {
        $this->user->setFirstName('Hojin');
        $this->user->setLastName('Chu');
        $this->user->setEmail('chuhojin@gmail.com');

        $emailVariables = $this->user->getEmailVariables();

        $this->assertArrayHasKey('full_name', $emailVariables);
        $this->assertArrayHasKey('email', $emailVariables);

        $this->assertEquals($emailVariables['full_name'], 'Hojin Chu');
        $this->assertEquals($emailVariables['email'], 'chuhojin@gmail.com');
    }
}