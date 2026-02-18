<?php

declare(strict_types=1);

namespace Philippe2463\RechercheEntreprisesBundle\Tests;

use PHPUnit\Framework\TestCase;
use Philippe2463\RechercheEntreprisesBundle\Philippe2463RechercheEntreprisesBundle;

class Philippe2463RechercheEntreprisesBundleTest extends TestCase
{
    public function testBundleCanBeInstantiated(): void
    {
        $bundle = new Philippe2463RechercheEntreprisesBundle();
        $this->assertInstanceOf(Philippe2463RechercheEntreprisesBundle::class, $bundle);
    }

    public function testGetPath(): void
    {
        $bundle = new Philippe2463RechercheEntreprisesBundle();
        $path = $bundle->getPath();
        $this->assertDirectoryExists($path);
    }
}
