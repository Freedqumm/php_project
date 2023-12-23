<?php

require_once 'WelcomeController.php';
require_once 'ProductsController.php';
require_once 'ErrorController.php';
require_once 'BuyController.php';
require_once 'InscriptionController.php';
class Router
{
    private $twig;
    private $url;
    private $ctrlWelcome;
    private $ctrlProducts;
    private $ctrlError;
    private $ctrlBuy;
    private $ctrlInscription;

    public function __construct($twig)
    {
        $this->twig = $twig;
        $this->ctrlWelcome = new WelcomeController();
        $this->ctrlProducts = new ProductsController();
        $this->ctrlError = new ErrorController();
        $this->ctrlBuy = new BuyController();
        $this->ctrlInscription = new InscriptionController();
    }

    public function route()
    {
        ####################################################################################################
        ## METTRE UN TRY CATCH LE MOMENT VENU !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!#
        ####################################################################################################

            if (isset($_GET['page'])) {
                switch ($_GET['page']) {
                    case 'default':
                        $this->ctrlWelcome->render($this->twig);
                        break;

                    case 'buy':
                        if(isset($_GET['product'])){
                            $this->ctrlBuy->render($this->twig, $_GET['product']);
                        } else {
                            $this->ctrlError->render($this->twig);
                        }
                        break;

                    case 'inscription':
                        $this->ctrlInscription->render($this->twig);
                        break;

                    default:
                        $this->ctrlProducts->render($this->twig, $_GET['page']);
                }
            } else {
                $this->ctrlWelcome->render($this->twig);
            }

        
    }


}
