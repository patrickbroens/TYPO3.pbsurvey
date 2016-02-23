<?php
namespace PatrickBroens\Pbsurvey\Domain\Model;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Frontend user
 */
class FrontendUser extends AbstractModel
{
    /**
     * The address
     *
     * @var string
     */
    protected $address;

    /**
     * The city
     *
     * @var string
     */
    protected $city;

    /**
     * The company
     *
     * @var string
     */
    protected $company;

    /**
     * The country
     *
     * @var string
     */
    protected $country;

    /**
     * The email address
     *
     * @var string
     */
    protected $email;

    /**
     * The fax number
     *
     * @var string
     */
    protected $fax;

    /**
     * The first name
     *
     * @var string
     */
    protected $firstName;

    /**
     * The last name
     *
     * @var string
     */
    protected $lastName;

    /**
     * The middle name
     *
     * @var string
     */
    protected $middleName;

    /**
     * The name
     *
     * @var string
     */
    protected $name;

    /**
     * The telephone number
     *
     * @var string
     */
    protected $telephone;

    /**
     * The title
     *
     * @var string
     */
    protected $title;

    /**
     * The user name
     *
     * @var string
     */
    protected $username;

    /**
     * The website url
     *
     * @var string
     */
    protected $www;

    /**
     * The zip code
     *
     * @var string
     */
    protected $zip;

    /**
     * Get the address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the address
     *
     * @param string $address The address
     */
    public function setAddress($address)
    {
        $this->address = (string)$address;
    }

    /**
     * Get the city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the city
     *
     * @param string $city The city
     */
    public function setCity($city)
    {
        $this->city = (string)$city;
    }

    /**
     * Get the company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set the company
     *
     * @param string $company The company
     */
    public function setCompany($company)
    {
        $this->company = (string)$company;
    }

    /**
     * Get the country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the country
     *
     * @param string $country The country
     */
    public function setCountry($country)
    {
        $this->country = (string)$country;
    }

    /**
     * Get the email address
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the email address
     *
     * @param string $email The email address
     */
    public function setEmail($email)
    {
        $this->email = (string)$email;
    }

    /**
     * Get the fax number
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set the fax number
     *
     * @param string $fax The fax number
     */
    public function setFax($fax)
    {
        $this->fax = (string)$fax;
    }

    /**
     * Get the first name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the first name
     *
     * @param string $firstName The first name
     */
    public function setFirstName($firstName)
    {
        $this->firstName = (string)$firstName;
    }

    /**
     * Get the last name
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the last name
     *
     * @param string $lastName The last name
     */
    public function setLastName($lastName)
    {
        $this->lastName = (string)$lastName;
    }

    /**
     * Get the middle name
     *
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * Set the middle name
     *
     * @param string $middleName The middle name
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = (string)$middleName;
    }

    /**
     * Get the name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the name
     *
     * @param string $name The name
     */
    public function setName($name)
    {
        $this->name = (string)$name;
    }

    /**
     * Get the telephone number
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set the telephone number
     *
     * @param string $telephone The telephone number
     */
    public function setTelephone($telephone)
    {
        $this->telephone = (string)$telephone;
    }

    /**
     * Get the title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the title
     *
     * @param string $title The title
     */
    public function setTitle($title)
    {
        $this->title = (string)$title;
    }

    /**
     * Get the user name
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the user name
     *
     * @param string $username The user name
     */
    public function setUsername($username)
    {
        $this->username = (string)$username;
    }

    /**
     * Get the website url
     *
     * @return string
     */
    public function getWww()
    {
        return $this->www;
    }

    /**
     * Set the website url
     *
     * @param string $www The website url
     */
    public function setWww($www)
    {
        $this->www = (string)$www;
    }

    /**
     * Get the zip code
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set the zip code
     *
     * @param string $zip The zip code
     */
    public function setZip($zip)
    {
        $this->zip = (string)$zip;
    }
}