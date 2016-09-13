<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace OnTap\MasterCard\ObjectManager;

use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\ObjectManager\TMap;

/**
 * Class TMapFactory
 */
class TMapFactory
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * TMapFactory constructor.
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(ObjectManagerInterface $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @param array $args
     * @return TMap
     */
    public function create(array $args)
    {
        return $this->objectManager->create(TMap::class, $args);
    }

    /**
     * @param array $args
     * @return TMap
     */
    public function createSharedObjectsMap(array $args)
    {
        return $this->objectManager->create(
            TMap::class,
            array_merge(
                $args,
                [
                    'objectCreationStrategy' => function (ObjectManagerInterface $om, $objectName) {
                        return $om->get($objectName);
                    }
                ]
            )
        );
    }
}