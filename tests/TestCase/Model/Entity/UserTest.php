<?php
namespace App\Test\TestCase\Model\Entity;

use App\Model\Entity\User;
use Cake\Auth\DefaultPasswordHasher;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Entity\User Test Case
 */
class UserTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Entity\User
     */
    public $User;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->User = new User();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->User);

        parent::tearDown();
    }

    /**
     * @test
     *
     * @return void
     */
    public function setPassword_ハッシュ化されたパスワードが設定されること()
    {
        $rawPass = 'password';
        $this->User->password = $rawPass;
        $hashedPass = $this->User->password;

        $this->assertNotSame($rawPass, $hashedPass);
        $hasher = new DefaultPasswordHasher();
        $this->assertTrue($hasher->check($rawPass, $hashedPass));
    }
}
