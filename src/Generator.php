<?php

namespace DEVJS\ApiDefinitions;

class Generator
{
    const RULES = 'rules';
    const RELATIONS = 'relations';

    /** @var ClassFinder */
    private $classFinder;

    /** @var Property */
    private $property;

    /** @var DefinitionParser */
    private $definitionParser;

    public function __construct(ClassFinder $classFinder, Property $property, DefinitionParser $definitionParser)
    {
        $this->classFinder = $classFinder;
        $this->property = $property;
        $this->definitionParser = $definitionParser;
    }

    public function generate(): string
    {
        /** Namespaces */
        $modelNamespaces = $this->classFinder->getNamespaces('app/Entities/');
        $repositoryNamespaces = $this->classFinder->getRepositoryNamespaces();

        /** Property */
        $classesRules = $this->property->fillProperties($modelNamespaces, self::RULES);
        $relations = $this->property->fillProperties($repositoryNamespaces, self::RELATIONS);

        /** Definitions */
        $allModelRequests = $this->definitionParser->parseRequests($classesRules);
        $allModelResponses = $this->definitionParser->parseResponses($classesRules, $relations);

        $swagger = json_encode(
            [
                'definitions' => $allModelRequests + $allModelResponses,
            ]);

        return $swagger;
    }
}