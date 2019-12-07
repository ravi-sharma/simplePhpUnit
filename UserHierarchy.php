<?php

/**
 * @author Ravi Sharma <me@rvish.com>
 *
 * Class UserHierarchy
 */
class UserHierarchy
{
    private $roles;

    /**
     * @author Ravi Sharma <me@rvish.com>
     *
     * Method setRoles
     * @param String $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $this->getJson($roles);
    }

    /**
     * @author Ravi Sharma <me@rvish.com>
     *
     * Method getSubOrdinates
     * @param integer $selectedRole
     * @return false|string
     */
    public function getSubOrdinates($selectedRole)
    {
        $result = [];

        if ($selectedRole > 0)
        {
            foreach ($this->roles as $role)
            {
                if ($role->Role > $selectedRole)
                {
                    $result[] = $role;
                }
            }
        }

        return $this->encode($result);
    }

    /**
     * @author Ravi Sharma <me@rvish.com>
     *
     * Method encode
     * @param array $result
     * @return false|string
     */
    private function encode($result)
    {
        return json_encode($result);
    }

    /**
     * @author Ravi Sharma <me@rvish.com>
     *
     * Method decode
     * @param String $result
     * @return mixed
     */
    private function decode($result)
    {
        return json_decode($result);
    }

    /**
     * @author Ravi Sharma <me@rvish.com>
     *
     * Method getJson
     * @param String $input
     * @return mixed
     */
    private function getJson($input)
    {
        return file_exists($input) ? $this->decode(file_get_contents($input)) : $this->decode($input);
    }
}

