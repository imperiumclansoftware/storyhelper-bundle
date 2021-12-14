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
class Chapter
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
    private $title;
    /**
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $number;
    /**
     * @ORM\ManyToOne(targetEntity=Book::class,inversedBy="chapters")
     *
     * @var Book
     */
    private $book;

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
     * Get the value of number
     *
     * @return  int
     */ 
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set the value of number
     *
     * @param  int  $number
     *
     * @return  self
     */ 
    public function setNumber(int $number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get the value of book
     *
     * @return  Book
     */ 
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Set the value of book
     *
     * @param  Book  $book
     *
     * @return  self
     */ 
    public function setBook(Book $book)
    {
        $this->book = $book;

        return $this;
    }
}