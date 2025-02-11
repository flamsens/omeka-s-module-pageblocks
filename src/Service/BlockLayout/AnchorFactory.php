<?php
namespace PageBlocks\Service\BlockLayout;

use Interop\Container\ContainerInterface;
use PageBlocks\Site\BlockLayout\Anchor;
use Laminas\ServiceManager\Factory\FactoryInterface;

class AnchorFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        return new Anchor(
            $services->get('FormElementManager'));
    }
}