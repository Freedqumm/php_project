<?php

require_once 'WelcomeController.php';
require_once 'ProductsController.php';
require_once 'ErrorController.php';
require_once 'BuyController.php';
require_once 'CustomerController.php';
require_once 'ConfirmedController.php';
require_once 'CartController.php';
require_once 'OrderController.php';
require_once 'PaymentController.php';
require_once 'ListOrderController.php';
require_once 'OrderCompletedController.php';
class Router
{
    private $twig;
    private $ctrlWelcome;
    private $ctrlProducts;
    private $ctrlError;
    private $ctrlBuy;
    private $ctrlCustomer;
    private $ctrlConfirmed;
    private $ctrlCart;
    private $ctrlOrder;
    private $ctrlPayment;
    private $ctrlListOrder;
    private $ctrlOrderCompleted;
    public function __construct($twig)
    {
        $this->twig = $twig;
        $this->ctrlWelcome = new WelcomeController();
        $this->ctrlProducts = new ProductsController();
        $this->ctrlError = new ErrorController();
        $this->ctrlBuy = new BuyController();
        $this->ctrlCustomer = new CustomerController();
        $this->ctrlConfirmed = new ConfirmedController();
        $this->ctrlCart = new CartController();
        $this->ctrlOrder = new OrderController();
        $this->ctrlPayment = new PaymentController();
        $this->ctrlListOrder = new ListOrderController();

        $this->ctrlOrderCompleted = new OrderCompletedController();
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

                case 'cart':
                    $this->ctrlCart->render($this->twig);
                    break;

                case 'buy':
                    if (isset($_GET['product'])) {
                        $this->ctrlBuy->render($this->twig, $_GET['product']);
                    } else {
                        $this->ctrlBuy->render_bis($this->twig);
                    }
                    break;
                case 'order':
                    $this->ctrlOrder->render($this->twig);
                    break;

                case 'payment':
                    $this->ctrlPayment->render($this->twig);
                    break;

                case 'inscription':
                    $this->ctrlCustomer->showRegistrationForm($this->twig);
                    break;
                case 'process-registration':
                    $this->ctrlCustomer->processRegistration();
                    break;

                case 'inscriptionConfirmed':
                    $this->ctrlConfirmed->render($this->twig);
                    break;


                case 'process-login':
                    $this->ctrlCustomer->processLogin();
                    break;

                case 'logout':
                    $this->ctrlCustomer->processLogout();
                    break;

                case 'listorder':
                    $this->ctrlListOrder->render($this->twig);
                    break;
                case 'orderCompleted':
                    $this->ctrlOrderCompleted->render($this->twig);
                    break;
                case 'confirm_order':
                    $this->ctrlOrderCompleted->confirm_order();


                default:
                    $this->ctrlProducts->render($this->twig, $_GET['page']);
            }
        } else {
            $this->ctrlWelcome->render($this->twig);
        }


    }


}