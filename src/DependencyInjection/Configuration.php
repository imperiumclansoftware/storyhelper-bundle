<?php
namespace ICS\StoryhelperBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {

        $treeBuilder = new TreeBuilder('storyhelper');
        //$treeBuilder->getRootNode()->children()
        //    ->scalarNode('path')->defaultValue('medias')->end()
        //;

        return $treeBuilder;
    }

}
