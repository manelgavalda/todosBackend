<?php

namespace ManelGavalda\TodosBackend\Transformers;

use ManelGavalda\TodosBackend\Transformers\Contracts\Transformer as TransformerContract;

/**
 * Class Transformer.
 */
abstract class Transformer implements TransformerContract
{
    /**
     * @param $resources
     *
     * @return array
     */
    public function transformCollection($resources)
    {
        return array_map(function ($resource) {
            return $this->transform($resource);
        }, $resources);
    }
}
