<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class StampaOraExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('stampaOra', [$this, 'doSomething']),
        ];
    }

    public function doSomething()
    {
        echo date("d/m/Y H:i:s");
    }
}
