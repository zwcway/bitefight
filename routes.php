<?php
/**
 * Created by PhpStorm.
 * User: osein
 * Date: 08/01/17
 * Time: 17:13
 */

$router = new \Phalcon\Mvc\Router(false);
/*
 * There is a configuration here on line 18, if you point public folder
 * in apache configurations there is no problem, but if you give it a link
 * like xxx.xx/public or something like that, comment out line 18
 *
 * I am too lazy to test and fix it sorry lol
 * https://github.com/Osein/bitefight/issues/23
 */
$router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI);
$router->removeExtraSlashes(true);
$router->setDefaultController('Home');
$router->setDefaultAction('getIndex');

$router->addGet('/news', ['controller' => 'Base', 'action' => 'getNews']);
$router->addGet('/highscore', ['controller' => 'Base', 'action' => 'getHighscore']);
$router->addPost('/highscore/mypos', ['controller' => 'Base', 'action' => 'postHighscoreMyPosition']);
$router->addGet('/profile/player/{id:[0-9]+}', ['controller' => 'Base', 'action' => 'getPreview']);

$register = new \Phalcon\Mvc\Router\Group(['controller' => 'Home']);
$register->setPrefix('/register');
$register->addGet('/{id:[0-2]}', ['action' => 'getRegister']);
$register->addPost('/{id:[1-2]}', ['action' => 'postRegister']);
$register->addGet('/ajaxcheck', ['action' => 'postAjaxCheck']);
$router->mount($register);

$router->addGet('/login', ['controller' => 'Home', 'action' => 'getLogin']);
$router->addPost('/login', ['controller' => 'Home', 'action' => 'postLogin']);
$router->addGet('/user/lostpw', ['controller' => 'Home', 'action' => 'getLostPassword']);
$router->addPost('/user/lostpw', ['controller' => 'Home', 'action' => 'postLostPassword']);

$user = new \Phalcon\Mvc\Router\Group(['controller' => 'User']);
$user->setPrefix('/user');
$user->addGet('/profile', ['action' => 'getProfile']);
$user->addPost('/profile/training', ['action' => 'postTrainingUp']);
$user->addGet('/profile/logo', ['action' => 'getProfileLogo']);
$user->addPost('/profile/logo', ['action' => 'postProfileLogo']);
$user->addGet('/settings', ['action' => 'getSettings']);
$user->addPost('/settings', ['action' => 'postSettings']);
$router->mount($user);

$router->addGet('/hideout', ['controller' => 'User', 'action' => 'getHideout']);
$router->addGet('/hideout/upgrade', ['controller' => 'User', 'action' => 'getHideoutUpgrade']);

$city = new \Phalcon\Mvc\Router\Group(['controller' => 'City']);
$city->setPrefix('/city');
$city->addGet('/index', ['action' => 'getIndex']);
$city->addGet('/library', ['action' => 'getLibrary']);
$city->addPost('/library', ['action' => 'postLibrary']);
$city->addGet('/church', ['action' => 'getChurch']);
$city->addPost('/church', ['action' => 'postChurch']);
$city->addGet('/graveyard', ['action' => 'getGraveyard']);
$city->addPost('/graveyard', ['action' => 'postGraveyard']);
$city->addPost('/graveyard/cancel', ['action' => 'postGraveyardCancel']);
$router->mount($city);

$hunt = new \Phalcon\Mvc\Router\Group(['controller' => 'Hunt']);
$hunt->setPrefix('/hunt');
$hunt->addGet('/index', ['action' => 'getHunt']);
$hunt->addGet('/human/{id:[1-5]}', ['action' => 'getHumanHunt']);
$router->mount($hunt);

$clan = new \Phalcon\Mvc\Router\Group(['controller' => 'Clan']);
$clan->setPrefix('/clan');
$clan->addGet('/{id:[0-9]+}', ['action' => 'getClanPreview', 'controller' => 'Base']);
$clan->addGet('/index', ['action' => 'getIndex']);
$clan->addGet('/create', ['action' => 'getCreate']);
$clan->addPost('/create', ['action' => 'postCreate']);
$clan->addGet('/leave', ['action' => 'getLeave']);
$clan->addGet('/clanleave', ['action' => 'postLeave']);
$clan->addGet('/hideout/upgrade', ['action' => 'postHideoutUpgrade']);
$clan->addPost('/donate', ['action' => 'postDonate']);
$clan->addPost('/newmessage', ['action' => 'postNewMessage']);
$clan->addGet('/deletemessage', ['action' => 'postDeleteMessage']);
$clan->addGet('/logo/background', ['action' => 'getLogoBackground']);
$clan->addGet('/logo/symbol', ['action' => 'getLogoSymbol']);
$clan->addPost('/logo/background', ['action' => 'postLogoBackground']);
$clan->addPost('/logo/symbol', ['action' => 'postLogoSymbol']);
$clan->addGet('/description', ['action' => 'getDescription']);
$clan->addPost('/description', ['action' => 'postDescription']);
$router->mount($clan);

$router->addGet('/search', ['controller' => 'Game', 'action' => 'getSearch']);
$router->addPost('/search', ['controller' => 'Game', 'action' => 'postSearch']);
$router->addGet('/notepad', ['controller' => 'User', 'action' => 'getNotepad']);
$router->addPost('/notepad', ['controller' => 'User', 'action' => 'postNotepad']);
$router->addGet('/logout', ['controller' => 'User', 'action' => 'getLogout']);

return $router;