<?php

namespace Dominick\ImageboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\Table(name="replies")
 * @ORM\HasLifecycleCallbacks
 */
class Reply
{
	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @var integer
	 */
	protected $id;

	/**
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="replies")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 * @var User
	 */
	protected $user;

	/**
	 * @Assert\Length(max="255")
	 * @ORM\Column(type="string", length=255, nullable=true)
	 * @var string
	 */
	protected $size;

	/**
	 * @Assert\Length(max="255")
	 * @ORM\Column(type="string", length=255, nullable=true)
	 * @var string
	 */
	protected $md5;

	/**
	 * @ORM\ManyToOne(targetEntity="Thread", inversedBy="replies")
	 * @ORM\JoinColumn(name="thread_id", referencedColumnName="id")
	 * @var Thread
	 */
	protected $thread;

	/**
	 * @Assert\Length(max="255")
	 * @ORM\Column(type="string", length=255, nullable=true)
	 * @var string
	 */
	protected $thumbnail;

	/**
	 * @Assert\Length(max="255")
	 * @ORM\Column(type="string", length=255, nullable=true)
	 * @var string
	 */
	protected $image;

	/**
	 * @Assert\Length(max="1024")
	 * @ORM\Column(type="string", length=1024, nullable=true))
	 * @var string
	 */
	protected $message;

	/**
	 * @ORM\Column(name="created", type="datetime", nullable=false)
	 * @var \DateTime
	 */
	protected $created;

	/**
	 * @ORM\Column(name="updated", type="datetime", nullable=false)
	 * @var \DateTime
	 */
	protected $updated;

	public function __construct()
	{
		$this->created = new \DateTime("now");
		$this->updated = new \DateTime("now");
	}

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
     * Set image
     *
     * @param string $image
     * @return Reply
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Reply
     */
    public function setMessage($message)
    {
        $this->message = $message;
    
        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Reply
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Reply
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set user
     *
     * @param \Dominick\ImageboardBundle\Entity\User $user
     * @return Reply
     */
    public function setUser(\Dominick\ImageboardBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Dominick\ImageboardBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set thread
     *
     * @param \Dominick\ImageboardBundle\Entity\Thread $thread
     * @return Reply
     */
    public function setThread(\Dominick\ImageboardBundle\Entity\Thread $thread = null)
    {
        $this->thread = $thread;
    
        return $this;
    }

    /**
     * Get thread
     *
     * @return \Dominick\ImageboardBundle\Entity\Thread 
     */
    public function getThread()
    {
        return $this->thread;
    }

    /**
     * Set size
     *
     * @param string $size
     * @return Reply
     */
    public function setSize($size)
    {
        $this->size = $size;
    
        return $this;
    }

    /**
     * Get size
     *
     * @return string 
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set md5
     *
     * @param string $md5
     * @return Reply
     */
    public function setMd5($md5)
    {
        $this->md5 = $md5;
    
        return $this;
    }

    /**
     * Get md5
     *
     * @return string 
     */
    public function getMd5()
    {
        return $this->md5;
    }

    /**
     * Set thumbnail
     *
     * @param string $thumbnail
     * @return Reply
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
    
        return $this;
    }

    /**
     * Get thumbnail
     *
     * @return string 
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }
}