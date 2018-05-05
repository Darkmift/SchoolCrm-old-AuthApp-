<?php
//Register Twig View helper
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'cache' => false/**'path/to/cache'**/,
        'debug' => true,
    ]);

    // Instantiate and add Slim specific extension
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));
    $view->addExtension(new Twig_Extension_Debug());

    $view->getEnvironment()->addGlobal('auth', [
        'check' => $container->auth->check(),
        'user' => $container->auth->user(),
        'role'=>$container->auth->role(),
    ]);

    $view->getEnvironment()->addGlobal('flash', $container->flash);

    return $view;
};
