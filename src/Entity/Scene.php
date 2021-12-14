<?php
namespace ICS\StoryhelperBundle\Entity;

use ICS\StoryhelperBundle\Entity\Components\Personnage;
use ICS\StoryhelperBundle\Entity\Components\Lieu;
use ICS\StoryhelperBundle\Entity\Components\Artefact;
use ICS\SsiBundle\Annotation\Log;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity()
 * @ORM\Table(schema="storyhelper")
 * @Log(actions={"all"},property="logMessage")
 */
class Scene
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
     * @ORM\Column(type="text")
     *
     * @var string
     */
    private $resume;
    /**
     * @ORM\Column(type="text")
     *
     * @var string
     */
    private $text;
    /**
     * @ORM\ManyToMany(targetEntity=Personnage::class)
     * @ORM\JoinTable(schema="storyhelper")
     * 
     * @var ArrayCollection|Personnage[]
     */
    private $personnages;
    /**
     * @ORM\ManyToMany(targetEntity=Lieu::class)
     * @ORM\JoinTable(schema="storyhelper")
     * 
     * @var ArrayCollection|Lieu[]
     */
    private $lieux;
    /**     
     * @ORM\ManyToMany(targetEntity=Artefact::class)
     * @ORM\JoinTable(schema="storyhelper")
     * 
     * @var ArrayCollection|Artefact[]
     */
    private $artefacts;

    
    public function __construct()
    {
        $this->personnages = new ArrayCollection();
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
     * Get the value of resume
     *
     * @return  string
     */ 
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set the value of resume
     *
     * @param  string  $resume
     *
     * @return  self
     */ 
    public function setResume(string $resume)
    {
        $this->resume = $resume;

        return $this;
    }

    /**
     * Get the value of text
     *
     * @return  string
     */ 
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the value of text
     *
     * @param  string  $text
     *
     * @return  self
     */ 
    public function setText(string $text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the value of personnages
     *
     * @return  string
     */ 
    public function getPersonnages()
    {
        return $this->personnages;
    }

    /**
     * Set the value of personnages
     *
     * @param  string  $personnages
     *
     * @return  self
     */ 
    public function setPersonnages(string $personnages)
    {
        $this->personnages = $personnages;

        return $this;
    }

    /**
     * Get the value of lieux
     *
     * @return  ArrayCollection|Lieu[]
     */ 
    public function getLieux()
    {
        return $this->lieux;
    }

    /**
     * Set the value of lieux
     *
     * @param  ArrayCollection|Lieu[]  $lieux
     *
     * @return  self
     */ 
    public function setLieux($lieux)
    {
        $this->lieux = $lieux;

        return $this;
    }

    /**
     * Get the value of artefacts
     *
     * @return  ArrayCollection|Artefact[]
     */ 
    public function getArtefacts()
    {
        return $this->artefacts;
    }

    /**
     * Set the value of artefacts
     *
     * @param  ArrayCollection|Artefact[]  $artefacts
     *
     * @return  self
     */ 
    public function setArtefacts($artefacts)
    {
        $this->artefacts = $artefacts;

        return $this;
    }
}