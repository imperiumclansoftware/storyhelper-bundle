<?php
namespace ICS\StoryhelperBundle\Entity;

use ICS\SsiBundle\Annotation\Log;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @ORM\Table(schema="storyhelper")
 * @Log(actions={"all"},property="logMessage")
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $projectTitle;
    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $title;
    /**
     * @ORM\ManyToOne(targetEntity=Author::class)
     *
     * @var Author
     */
    private $author;
    /**
     * @ORM\OneToMany(targetEntity=Chapter::class,mappedBy="book")
     *
     * @var ArrayCollection
     */
    private $chapters;

    public function __construct()
    {
        $this->chapters = new ArrayCollection();
    }

    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of projectTitle
     *
     * @return  string
     */ 
    public function getProjectTitle()
    {
        return $this->projectTitle;
    }

    /**
     * Set the value of projectTitle
     *
     * @param  string  $projectTitle
     *
     * @return  self
     */ 
    public function setProjectTitle(string $projectTitle)
    {
        $this->projectTitle = $projectTitle;

        return $this;
    }

    /**
     * Get the value of title
     *
     * @return  string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  string  $title
     *
     * @return  self
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of author
     *
     * @return  Author
     */ 
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @param  Author  $author
     *
     * @return  self
     */ 
    public function setAuthor(Author $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get the value of chapters
     *
     * @return  Array|Chapter[]
     */ 
    public function getChapters()
    {
        return $this->chapters;
    }

    /**
     * Set the value of chapters
     *
     * @param  Array|Chapter[]  $chapters
     *
     * @return  self
     */ 
    public function setChapters($chapters)
    {
        $this->chapters = $chapters;

        return $this;
    }

    public function getLogMessage()
    {
        return 'Book '.$this->__toString();
    }

    public function __toString()
    {
        if($this->getTitle() != "")
        {
            return $this->getTitle();
        }

        return $this->getProjectTitle();
    }
}