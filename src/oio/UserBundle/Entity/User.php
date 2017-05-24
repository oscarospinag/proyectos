<?php

namespace oio\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;





/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="oio\UserBundle\Entity\UserRepository")
 *@UniqueEntity("username")
 *@UniqueEntity("email")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="user_username", type="string", length=50)
     */
    private $username;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="user_lastName", type="string", length=50)
     */
    private $lastName;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="user_firstName", type="string", length=50)
   
     */
     private $firstName;
     

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="user_email", type="string", length=50)
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="user_password", type="string", length=50)
     */
    private $password;

    /**
     * @var string
     * @ORM\Column(name="user_role", type="string", columnDefinition="ENUM('ROLE_ADMIN', 'ROLE_USER')", length=50)
     * @Assert\NotBlank()
     * @Assert\Choice(choices = {"ROLE_ADMIN", "ROLE_USER"})
     */
    private $role;

    /**
     * @var boolean
     * @Assert\NotBlank()
     * @ORM\Column(name="user_isActive", type="boolean")
     */
    private $isActive;

    /**
     * @var \DateTime
     * @ORM\Column(name="user_createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_updatedAt", type="datetime")
     */
    private $updatedAt;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
 /**
 * @ORM\PrePersist
 */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }
 /**
 * @ORM\PrePersist
 * @ORM\PreUpdate
 */ 
public function setUpdatedAtValue()
{
    $this->updatedAt = new \DateTime();
}

   
    public function getRoles() {
        
    }

    public function getSalt() {
        
    }
    public function eraseCredentials() {
        
    }


}
