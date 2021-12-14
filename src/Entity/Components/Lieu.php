<?php
namespace ICS\StoryhelperBundle\Entity\Components;

use ICS\SsiBundle\Annotation\Log;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @ORM\Table(schema="storyhelper")
 */
class Lieu
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
    private $name;
    /**
     * @ORM\Column(type="text")
     *
     * @var string
     */
    private $description;
    /**
     * @ORM\ManyToOne(targetEntity=Lieu::class, inversedBy="childs")
     *
     * @var Lieu
     */
    private $parent;
    /**
     * @ORM\OneToMany(targetEntity=Lieu::class, mappedBy="parent")
     *
     * @var Array|Lieu[]
     */
    private $childs;

    public function __construct()
    {
        $this->childs = new ArrayCollection();
    }

    public function getLogMessage()
    {
        return $this->name;
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
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param  string  $description
     *
     * @return  self
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of parent
     *
     * @return  Lieu
     */ 
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set the value of parent
     *
     * @param  Lieu  $parent
     *
     * @return  self
     */ 
    public function setParent(Lieu $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get the value of childs
     *
     * @return  Array|Lieu[]
     */ 
    public function getChilds()
    {
        return $this->childs;
    }

    /**
     * Set the value of childs
     *
     * @param  Array|Lieu[]  $childs
     *
     * @return  self
     */ 
    public function setChilds($childs)
    {
        $this->childs = $childs;

        return $this;
    }
}