<?php

namespace DEVJS\SwaggerGenerator\tests;

use DEVJS\SwaggerGenerator\ClassFinder;
use DEVJS\SwaggerGenerator\DefinitionParser;
use DEVJS\SwaggerGenerator\Generator;
use DEVJS\SwaggerGenerator\Property;
use SwaggerGenerator\SwaggerGenerator;
use Tests\TestCase;

class GenerateTest extends TestCase
{
    /** @var Generator */
    private $generator;

    /** @var ClassFinder */
    private $classFinder;

    /** @var Property */
    private $property;

    /** @var DefinitionParser */
    private $definitionParser;

    public function setUp()
    {
        parent::setUp();

        $this->classFinder = new ClassFinder();
        $this->property = New Property();
        $this->definitionParser = New DefinitionParser($this->property);

        $this->generator = new Generator($this->classFinder, $this->property, $this->definitionParser);

    }
    public function testGenerate()
    {
        $this->assertJson($this->generator->generate());
    }

}