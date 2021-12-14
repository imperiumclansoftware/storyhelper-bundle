<?php
namespace ICS\StoryhelperBundle\Entity\Components;

use ICS\StoryhelperBundle\Entity\Scene;
use ICS\SsiBundle\Annotation\Log;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity()
 * @ORM\Table(schema="storyhelper")
 */
class Personnage
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
     * @ORM\Column(type="string", length=7)
     *
     * @var string
     */
    private $color='#000000';
    /**
     * @ORM\Column(type="text")
     *
     * @var string
     */
    private $physicalDescription;
    /**
     * @ORM\Column(type="text")
     *
     * @var string
     */
    private $psychologicalDescription;
    /**
     * @ORM\ManyToMany(targetEntity=Scene::class)
     * @ORM\JoinTable(schema="storyhelper")
     * 
     * @var ArrayCollection|Scene[]
     */
    private $scenes;

    public function __construct()
    {
        $this->scenes = new ArrayCollection();
    }

}
