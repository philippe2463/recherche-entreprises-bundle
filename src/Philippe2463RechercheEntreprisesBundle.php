<?php

declare(strict_types=1);

namespace Philippe2463\RechercheEntreprisesBundle;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Philippe2463\RechercheEntreprisesBundle\Client\EntrepriseSearchClient;
use Philippe2463\RechercheEntreprisesBundle\Client\EntrepriseSearchClientInterface;
use Philippe2463\RechercheEntreprisesBundle\Command\SearchEntrepriseCommand;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;


/**
* Bundle pour l'API Recherche d'entreprises.
*/
class Philippe2463RechercheEntreprisesBundle extends AbstractBundle
{
    public function configure(DefinitionConfigurator $definition): void
        {
            $definition->rootNode()
                ->children()
                ->integerNode('timeout')
                ->defaultValue(10)
                ->min(1)
                ->max(60)
                ->info('Timeout des requêtes HTTP en secondes')
                ->end()
                ->end()
            ;
        }

    public function loadExtension(
        array $config,
        ContainerConfigurator $container,
        ContainerBuilder $builder
    ): void {

        // Paramètres
        $container->parameters()
            ->set('philippe2463_recherche_entreprises.timeout', $config['timeout'])
        ;
        
        // Services
        $container->services()

            // Client principal
            ->set(EntrepriseSearchClient::class)
            ->args([
                service('http_client'),
                service('logger')->ignoreOnInvalid(),
                '%philippe2463_recherche_entreprises.timeout%',
                ])
            ->public()

            // Alias pour l'interface
            ->alias(EntrepriseSearchClientInterface::class, EntrepriseSearchClient::class)
            ->public()

            // Alias nommé
            ->alias('philippe2463_recherche_entreprises.client', EntrepriseSearchClient::class)
            ->public()

            // Commande
            ->set(SearchEntrepriseCommand::class)
            ->args([
                service(EntrepriseSearchClientInterface::class),
            ])
            ->tag('console.command')
        ;
    }
        
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}