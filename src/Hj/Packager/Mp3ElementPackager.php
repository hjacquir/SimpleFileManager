<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Packager;

use Hj\Collection\ElementCollection;
use Hj\Loader\CsvLoader;
use Hj\Mapper\InterpreterMapper;
use Hj\Mapper\TitleMapper;

/**
 * I take an CsvLoader with InterpreterMapper, TitleMapper and return an ElementCollection
 *
 * Class Mp3ElementPackager
 * @package Hj\Packager
 */
class Mp3ElementPackager
{
    /**
     * @var CsvLoader
     */
    private $loader;

    /**
     * @var InterpreterMapper
     */
    private $interpreterMapper;

    /**
     * @var TitleMapper
     */
    private $titleMapper;

    /**
     * @var ElementCollection
     */
    private $elementCollection;

    /**
     * @param CsvLoader $loader
     * @param InterpreterMapper $interpreterMapper
     * @param TitleMapper $titleMapper
     * @param ElementCollection $elementCollection
     */
    public function __construct(
        CsvLoader $loader,
        InterpreterMapper $interpreterMapper,
        TitleMapper $titleMapper,
        ElementCollection $elementCollection
    ) {
        $this->loader = $loader;
        $this->interpreterMapper = $interpreterMapper;
        $this->titleMapper = $titleMapper;
        $this->elementCollection = $elementCollection;
    }

    /**
     * Package the CSV Elements to Element Collection
     *
     * @return ElementCollection
     */
    public function package()
    {
        $this->loader->loadData();

        $content = $this->loader->getContent();

        foreach ($content as $value) {
            $this->interpreterMapper->setArray($value);

            $interpreter = $this->interpreterMapper->map();

            $this->elementCollection->add($interpreter);

            $this->titleMapper->setArray($value);
            $this->titleMapper->setInterpreter($interpreter);

            $title = $this->titleMapper->map();

            $this->elementCollection->add($title);
        }

        return $this->elementCollection;
    }
}