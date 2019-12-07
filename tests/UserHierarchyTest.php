<?php

use PHPUnit\Framework\TestCase;

/**
 * @author Ravi Sharma <me@rvish.com>
 *
 * Class UserHierarchyTest
 */
class UserHierarchyTest extends TestCase
{
    // Getting fixture from files
    const JSON_ROLES = 'fixtures/roles.json';
    const JSON_USERS = 'fixtures/users.json';
    const TEST_FILE = 'UserHierarchy.php';

    /**
     * UserHierarchyTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        require_once static::TEST_FILE;

        $this->userHierarchy = new UserHierarchy();

        $this->userHierarchy->setRoles(static::JSON_ROLES);
        $this->userHierarchy->setUsers(static::JSON_USERS);
    }

    /**
     * @author Ravi Sharma <me@rvish.com>
     *
     * Method testReturn
     */
    public function testGetSubOrdinates()
    {
        // asserting happy case with role 3
        $this->assertEquals($this->userHierarchy->getSubOrdinates(3), $this->getStaticSubOrdinates(3));

        // asserting unhappy case with role 3
        $this->assertNotEquals($this->userHierarchy->getSubOrdinates(3), $this->getStaticSubOrdinates(1));

        // asserting unhappy case with role 5
        $this->assertEquals($this->userHierarchy->getSubOrdinates(1), $this->getStaticSubOrdinates(1));

        // asserting unhappy case with role 5
        $this->assertNotEquals($this->userHierarchy->getSubOrdinates(1), $this->getStaticSubOrdinates(3));
    }

    /**
     * @author Ravi Sharma <me@rvish.com>
     *
     * Method testGetSubOrdinatesByRoles
     */
    public function testGetByRoles()
    {
        // asserting happy case with role 3
        $this->assertEquals($this->userHierarchy->getSubOrdinatesByRoles()[3], $this->getStaticSubOrdinates(3));

        // asserting unhappy case with role 3
        $this->assertNotEquals($this->userHierarchy->getSubOrdinatesByRoles()[3], $this->getStaticSubOrdinates(1));

        // asserting unhappy case with role 5
        $this->assertEquals($this->userHierarchy->getSubOrdinatesByRoles()[1], $this->getStaticSubOrdinates(1));

        // asserting unhappy case with role 5
        $this->assertNotEquals($this->userHierarchy->getSubOrdinatesByRoles()[1], $this->getStaticSubOrdinates(3));
    }

    /**
     * @author Ravi Sharma <me@rvish.com>
     *
     * Method getStaticSubOrdinates
     * @param integer $role
     * @return string
     */
    private function getStaticSubOrdinates($role)
    {
        switch ($role) {
            case 4:
                return '[{"Id":5,"Name":"Steve Trainer","Role":5}]';
                break;
            case 3:
                return '[{"Id":2,"Name":"Emily Employee","Role":4},{"Id":5,"Name":"Steve Trainer","Role":5}]';
                break;
            case 2:
                return '[{"Id":2,"Name":"Emily Employee","Role":4},{"Id":3,"Name":"Sam Supervisor","Role":3},{"Id":5,"Name":"Steve Trainer","Role":5}]';
                break;
            case 1:
                return '[{"Id":2,"Name":"Emily Employee","Role":4},{"Id":3,"Name":"Sam Supervisor","Role":3},{"Id":4,"Name":"Mary Manager","Role":2},{"Id":5,"Name":"Steve Trainer","Role":5}]';
                break;
            case 0:
                return '[{"Id":1,"Name":"Adam Admin","Role":1},{"Id":2,"Name":"Emily Employee","Role":4},{"Id":3,"Name":"Sam Supervisor","Role":3},{"Id":4,"Name":"Mary Manager","Role":2},{"Id":5,"Name":"Steve Trainer","Role":5}]';
                break;
        }

        return '[]';
    }
}