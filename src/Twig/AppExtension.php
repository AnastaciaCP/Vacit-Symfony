<?php 

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\Twigfilter;

use Symfony\Component\DependencyInjection\ContainerInterface;

class AppExtension extends AbstractExtension {

    private $templating;

    public function getFilters() {

        return( array(
                    new Twigfilter("showCheckmark", array($this, 'showCheckmark')),
                    new Twigfilter("inviteCheckmark", array($this, 'inviteCheckmark'))
                )
        );
    }

    public function showCheckmark($bool) {

        if (!$bool) {
            return ('');
        }
        return ("✔"); 
    }

    public function inviteCheckmark($bool) { 

        if (!$bool) {
            return ('Nodig deze kandidaat uit!');
        }
        return ("✔"); 
    }

}