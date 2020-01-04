<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 4/4/2019
 * Time: 9:07 PM
 */

namespace Entity;


/**
 * @Entity
 * @Table(name="users")
 */
class User
{
    /**
     * @var integer $id
     *
     * @Column(type="integer")
     * @Id
     * @GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @var string $name
     *
     * @Column(type="string", length=191)
     */
    public $username;

    /**
     * @var string $email
     *
     * @Column(type="string", length=191)
     */
    public $email;

    /**
     * @var string $password
     *
     * @Column(type="string", length=191)
     */
    public $password;

    /**
     * @var string $Coutnry
     *
     * @Column(type="string", length=191)
     */
    public $country;

    /**
     * @var string $role
     *
     * @Column(type="string", length=191)
     */
    public $role;


    /**
     * @var datetime $created_at
     *
     * @Column(name="created_at", type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    public $created_at;

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password);
    }

    /**
     * @param datetime $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }



    /**
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
}