<?php
namespace PageBlocks\Service\BlockLayout;

use Interop\Container\ContainerInterface;
use PageBlocks\Site\BlockLayout\FourColumn;
use Laminas\ServiceManager\Factory\FactoryInterface;

class FourColumnFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        return new FourColumn(
            $services->get('FormElementManager'));
    }
}