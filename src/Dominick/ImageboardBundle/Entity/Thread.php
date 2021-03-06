<?php

namespace Dominick\ImageboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\Table(name="threads")
 * @ORM\HasLifecycleCallbacks
 */
class Thread
{
	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @var integer
	 */
	protected $id;

	/**
	 * @ORM\ManyToOne(targetEntity="User", inversedBy="threads")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 * @var User
	 */
	protected $user;

	/**
	 * @Assert\NotBlank()
	 * @Assert\Length(max="255")
	 * @ORM\Column(type="string", length=255)
	 * @var string
	 */
	protected $image;

	/**
	 * @Assert\Length(max="255")
	 * @ORM\Column(type="string", length=255)
	 * @var string
	 */
	protected $thumbnail;


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
	 * @Assert\NotBlank()
	 * @Assert\Length(max="60")
	 * @ORM\Column(type="string", length=60)
	 * @var string
	 */
	protected $subject;

	/**
	 * @Assert\NotBlank()
	 * @Assert\Length(max="1024")
	 * @ORM\Column(type="string", length=1024)
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

	/**
	 * @ORM\OneToMany(targetEntity="Reply", mappedBy="thread", cascade="remove")
	 * @var ArrayCollection
	 */
	protected $replies;

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
     * Set subject
     *
     * @param string $subject
     * @return Thread
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    
        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Thread
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
     * @return Thread
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
     * @return Thread
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
     * @return Thread
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
     * Set image
     *
     * @param string $image
     * @return Thread
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
     * Add replies
     *
     * @param \Dominick\ImageboardBundle\Entity\Reply $replies
     * @return Thread
     */
    public function addReplies(\Dominick\ImageboardBundle\Entity\Reply $replies)
    {
        $this->replies[] = $replies;
    
        return $this;
    }

    /**
     * Remove replies
     *
     * @param \Dominick\ImageboardBundle\Entity\Reply $replies
     */
    public function removeReplies(\Dominick\ImageboardBundle\Entity\Reply $replies)
    {
        $this->replies->removeElement($replies);
    }

    /**
     * Get replies
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReplies()
    {
        return $this->replies;
    }


    /**
     * Add replies
     *
     * @param \Dominick\ImageboardBundle\Entity\Reply $replies
     * @return Thread
     */
    public function addReplie(\Dominick\ImageboardBundle\Entity\Reply $replies)
    {
        $this->replies[] = $replies;
    
        return $this;
    }

    /**
     * Remove replies
     *
     * @param \Dominick\ImageboardBundle\Entity\Reply $replies
     */
    public function removeReplie(\Dominick\ImageboardBundle\Entity\Reply $replies)
    {
        $this->replies->removeElement($replies);
    }

    /**
     * Set thumbnail
     *
     * @param string $thumbnail
     * @return Thread
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

    /**
     * Set size
     *
     * @param string $size
     * @return Thread
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
     * @return Thread
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
}