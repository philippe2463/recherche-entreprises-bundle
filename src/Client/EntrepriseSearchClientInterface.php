<?php

declare(strict_types=1);

namespace Philippe2463\RechercheEntreprisesBundle\Client;

use Philippe2463\RechercheEntreprisesBundle\Model\Entreprise;
use Philippe2463\RechercheEntreprisesBundle\Model\SearchResult;

/**
 * Interface pour le client de recherche d'entreprises.
 */
interface EntrepriseSearchClientInterface
{
    public function search(
        string $query,
        int $page = 1,
        int $perPage = 10,
        array $filter = []
        ): SearchResult;

    public function findBySiren(string $siren): ?Entreprise;

    public function searchByCodePostal(
        string $codePostal,
        int $page = 1,
        int $perPage = 10,
    ): SearchResult;
}
