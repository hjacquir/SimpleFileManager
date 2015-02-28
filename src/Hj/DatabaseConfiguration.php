<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj;

use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Load database configuration located on yaml file
 *
 * Class DatabaseConfiguration
 * @package Hj
 */
class DatabaseConfiguration implements ConfigurationInterface
{
	/**
	 * @var TreeBuilder
	 */
	private $treeBuilder;

	/**
	 * @param TreeBuilder $treeBuilder
	 */
	public function __construct(TreeBuilder $treeBuilder)
	{
		$this->treeBuilder = $treeBuilder;
	}

	/**
	 * Generates the configuration tree builder.
	 *
	 * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
	 */
	public function getConfigTreeBuilder()
	{
		$rootNode = $this->treeBuilder->root('database');

		$children = $rootNode->children();

		$scalarNodes = array(
			'driver',
			'host',
			'dbname',
			'password',
			'user',
		);

		$this->addRequiredScalarNodes($children, $scalarNodes);

		$children->end();

		return $this->treeBuilder;
	}

	/**
	 * @param NodeBuilder $node
	 * @param array $names
	 */
	private function addRequiredScalarNodes(NodeBuilder $node, array $names)
	{
		foreach ($names as $name) {
			$this->addScalarNodeRequired($node, $name);
		}
	}

	/**
	 * @param NodeBuilder $node
	 * @param string $name
	 */
	private function addScalarNodeRequired(NodeBuilder $node, $name)
	{
		$node->scalarNode($name)->isRequired()->end();
	}
}