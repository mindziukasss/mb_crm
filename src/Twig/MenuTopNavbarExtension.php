<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class MenuTopNavbarExtension
 */
class MenuTopNavbarExtension extends AbstractExtension
{

    const PAGE_TITLE = [
        'Dashboard' => 'crm_dashboard_index',
        'Menu' => 'crm_menu_index'
    ];

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('titlePage', [$this, 'topNavBarTitle']),
        ];
    }

    /**
     * @param $value
     *
     * @return string
     */
    public function topNavBarTitle($value)
    {
        return array_search($value, self::PAGE_TITLE);
    }
}