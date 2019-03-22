<?php 

//White list Routes
use System\Application;

$app =  Application::getInstance();

//Check if the current url started with /admin
if (strpos($app->request->url(), '/admin') === 0) {
    //Call middlewares
    $app->route->callFirst(function ($app) {
        $app->load->action('Admin/Access', 'index');
    });

    //Share|load logged user for each request
    $app->share('user', function ($app) {
        $loginModel = $app->load->model('Login');

        $loginModel->isLogged();
        $user = $loginModel->user();
        
        return  $user;
    });

    //Share|load settings for each request
    $app->share('settings', function ($app) {

        $settingsModel = $app->load->model('Settings');
        $settingsModel->loadAll();

        return $settingsModel;
    });

    //Share Admin layout
    $app->share('adminLayout', function ($app) {
        return $app->load->controller('Admin/Common/Layout');
    });

} elseif(strpos($app->request->url(), '/disabled') !== 0) {
    //Current url belongs to Blog or doesn't start with disabled
     
    //Share|load settings for each request
    $app->share('settings', function ($app) {
        $settingsModel = $app->load->model('Settings');
        $settingsModel->loadAll();

        return $settingsModel;
    });
    
    $app->route->callFirst(function ($app) {
        $app->load->action('Blog/Access', 'index');
    });

    //Share Blog layout
    $app->share('blogLayout', function ($app) {
        return $app->load->controller('Blog/Common/Layout');
    });
}


/**
 * Admin Routes
 */

//Admin => Login
$app->route->add('/admin/login', 'Admin/Login');
$app->route->add('/admin/login/submit', 'Admin/Login@submit', 'POST');

//Admin => Dashboard
$app->route->add('/admin', 'Admin/Dashboard');
$app->route->add('/admin/dashboard', 'Admin/Dashboard');
$app->route->add('/admin/submit', 'Admin/Dashboard@submit', 'POST');

//Admin => Users
$app->route->add('/admin/users', 'Admin/Users');
$app->route->add('/admin/users/add', 'Admin/Users@add', 'POST');
$app->route->add('/admin/users/submit', 'Admin/Users@submit', 'POST');
$app->route->add('/admin/users/save/:id', 'Admin/Users@save', 'POST');
$app->route->add('/admin/users/edit/:id', 'Admin/Users@edit', 'POST');
$app->route->add('/admin/users/delete/:id', 'Admin/Users@delete','POST');

//Admin => Users profile
$app->route->add('/admin/profile/update', 'Admin/Profile@update', 'POST');

//Admin => Users-Groups
$app->route->add('/admin/users-groups', 'Admin/UsersGroups');
$app->route->add('/admin/users-groups/add', 'Admin/UsersGroups@add','POST');
$app->route->add('/admin/users-groups/submit', 'Admin/UsersGroups@submit', 'POST');
$app->route->add('/admin/users-groups/save/:id', 'Admin/UsersGroups@save', 'POST');
$app->route->add('/admin/users-groups/edit/:id', 'Admin/UsersGroups@edit','POST');
$app->route->add('/admin/users-groups/delete/:id', 'Admin/UsersGroups@delete','POST');

//Admin => Chapters
$app->route->add('/admin/chapters', 'Admin/Chapters');
$app->route->add('/admin/chapters/add', 'Admin/Chapters@add', 'POST');
$app->route->add('/admin/chapters/submit', 'Admin/Chapters@submit', 'POST');
$app->route->add('/admin/chapters/save/:id', 'Admin/Chapters@save', 'POST');
$app->route->add('/admin/chapters/edit/:id', 'Admin/Chapters@edit', 'POST');
$app->route->add('/admin/chapters/delete/:id', 'Admin/Chapters@delete','POST');

//Admin => Episodes
$app->route->add('/admin/episodes', 'Admin/Episodes');
$app->route->add('/admin/episodes/add', 'Admin/Episodes@add', 'POST');
$app->route->add('/admin/episodes/submit', 'Admin/Episodes@submit', 'POST');
$app->route->add('/admin/episodes/save/:id', 'Admin/Episodes@save', 'POST');
$app->route->add('/admin/episodes/edit/:id', 'Admin/Episodes@edit', 'POST');
$app->route->add('/admin/episodes/delete/:id', 'Admin/Episodes@delete', 'POST');

//Admin => Comments
$app->route->add('/admin/episodes/comments', 'Admin/Comments');
$app->route->add('/admin/episodes/:id/comments', 'Admin/Comments');
$app->route->add('/admin/episodes/all-reported-comments', 'Admin/Comments@allReported');
$app->route->add('/admin/episodes/all-disabled-comments', 'Admin/Comments@allDisabled');;
$app->route->add('/admin/comments/delete/:id', 'Admin/Comments@delete', 'POST');
$app->route->add('/admin/comments/delete/:text', 'Admin/Comments@delete', 'POST');
$app->route->add('/admin/comments/delete/:text/episode/:id', 'Admin/Comments@delete', 'POST');
$app->route->add('/admin/comments/submit', 'Admin/Comments@submit', 'POST');
$app->route->add('/admin/comments/add', 'Admin/Comments@add', 'POST');
$app->route->add('/admin/comments/edit/:id', 'Admin/Comments@edit', 'POST');
$app->route->add('/admin/comments/save/:id', 'Admin/Comments@save', 'POST');

//Admin => Settings
$app->route->add('/admin/settings', 'Admin/Settings');
$app->route->add('/admin/settings/save', 'Admin/Settings@save', 'POST');

//Admin => Contacts 
$app->route->add('/admin/contacts', 'Admin/Contacts');
$app->route->add('/admin/contacts/reply/:id', 'Admin/Contacts@reply', 'POST');
$app->route->add('/admin/contacts/send/:id', 'Admin/Contacts@send', 'POST');
$app->route->add('/admin/contacts/disabled/:id', 'Admin/Contacts@disabled','POST');

//Admin => Logout
$app->route->add('/admin/logout', 'Admin/Logout');

/**
 * Blog Routes
 */
$app->route->add('/', 'Blog/Home'); // Home Page
$app->route->add('/chapter/:text/:id', 'Blog/Chapter');
$app->route->add('/episode/:text/:id', 'Blog/Episode');
$app->route->add('/episode/comment/:id', 'Blog/Episode@reportComment', 'POST');
$app->route->add('/episode/:text/:id/add-comment', 'Blog/Episode@addComment', 'POST');
$app->route->add('/register', 'Blog/Register');
$app->route->add('/register/submit', 'Blog/Register@submit', 'POST');
$app->route->add('/login', 'Blog/Login');
$app->route->add('/login/submit', 'Blog/Login@submit', 'POST');
$app->route->add('/logout', 'Blog/Logout');
$app->route->add('/search', 'Blog/Search', 'POST');
$app->route->add('/contact-me', 'Blog/Contact');
$app->route->add('/contact-me/submit', 'Blog/Contact@submit', 'POST');
$app->route->add('/about-me', 'Blog/AboutMe');
$app->route->add('/profile', 'Blog/Profile');
$app->route->add('/profile/save', 'Blog/Profile@save', 'POST');

//Disabled site Route
$app->route->add('/disabled', 'NotFound');

//NOT Found Routes
$app->route->add('/404', 'NotFound');
$app->route->notFound('/404');
