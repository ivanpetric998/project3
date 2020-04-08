<?php 

    require_once "app/config/config.php";
    require_once "app/config/setup.php";
    require_once "app/config/functions.php";

    /* Controller namespaces */

    use app\controllers\FrontController;
    use app\controllers\RegisterController;
    use app\controllers\LoginController;
    use app\controllers\CommentsController;

    /* Controller namespaces - end */


    /* Controller middlewares */

    use app\middlewares\IsLoggedIn;

    /* Controller middlewares - end */


    /* Controller objects */

    $frontController=new FrontController();
    $registerController=new RegisterController();
    $loginController=new LoginController();
    $commentsController=new CommentsController();

    /* Controller objects - end */


    /* Middleware objects */

    $isLoggedInMiddleware=new IsLoggedIn();

    /* Middleware objects - end */

    switch (getRoute())
    {
        /* Views */

        case '':
            $frontController->loadCommentsPage();
        break;
        case 'login':
            $frontController->loadLoginPage();
        break;
        case 'register':
            $frontController->loadRegisterPage();
        break;
        case "403":
            $frontController->load403Page();
        break;

        /* Views - end */

        case "user/login":
            $loginController->doLogin($_POST);
        break;
        case "logout":
            $loginController->logout();
        break;
        case "user/register":
            $registerController->store($_POST);
        break;
        case "comments/cat":
            $commentsController->showCommentsForCategory($_GET);
        break;
        case "comments/store":
            $isLoggedInMiddleware->handle();
            $commentsController->store($_POST);
        break;
        

        
        default:
            $frontController->load404Page();
        break;
    }

?>



    
          

    

   

    


