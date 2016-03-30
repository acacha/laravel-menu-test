<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Spatie\Menu\Laravel\Html;
use Spatie\Menu\Laravel\Link;

Route::get('/', ['as' => 'welcome', function () {
    return view('welcome');
}]);

Route::get('/about','AboutController@index');
Route::get('/contact','ContactController@index');

Menu::macro('fullsubmenu', function () {
    return Menu::new()->prepend('<a href="#"><span> Multilevel PROVA </span> <i class="fa fa-angle-left pull-right"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::to('/link1prova', 'Link1 prova'))->addClass('treeview-menu')
            ->add(Link::to('/link2prova', 'Link2 prova'))->addClass('treeview-menu')
            ->url('http://www.google.com', 'Google');

});

Menu::macro('adminlteSubmenu', function ($submenuName) {
    return Menu::new()->prepend('<a href="#"><span> ' . $submenuName . '</span> <i class="fa fa-angle-left pull-right"></i></a>')
            ->addParentClass('treeview')->addClass('treeview-menu');
});

Menu::macro('adminlteMenu', function () {
    return Menu::new()
        ->addClass('sidebar-menu');
});

Menu::macro('adminlteSeparator', function ($title) {
    return Html::raw($title)->addParentClass('header');
});

Menu::macro('main', function () {
    return Menu::adminlteMenu()
        ->route('welcome', 'Landing Page')
        ->url('http://www.google.com', 'Google')
        ->add(Html::raw('MAIN MENU')->addParentClass('header'))
        ->link('http://www.acacha.org', 'Acacha')
        ->action('HomeController@index', 'Home')
        ->action('AboutController@index', 'About')
        ->add(Menu::adminlteSeparator('SECONDARY MENU'))
        ->action('ContactController@index', 'Contact')
        ->add(Menu::new()->prepend('<a href="#"><span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::to('/link1', 'Link1'))->addClass('treeview-menu')
            ->add(Link::to('/link2', 'Link2'))
            ->url('http://www.google.com', 'Google')
            ->add(Menu::new()->prepend('<a href="#"><span>Multilevel 2</span> <i class="fa fa-angle-left pull-right"></i></a>')
                ->addParentClass('treeview')
                ->add(Link::to('/link21', 'Link21'))->addClass('treeview-menu')
                ->add(Link::to('/link22', 'Link22'))
                ->url('http://www.google.com', 'Google')
            )
        )
        ->add(
            Menu::fullsubmenu()
        )
        ->add(
            Menu::adminlteSubmenu('Best menu')
                ->add(Link::to('/acacha', 'acacha'))
                ->add(Link::to('/profile', 'Profile'))
                ->url('http://www.google.com', 'Google')
        )
        ->setActiveFromRequest();
});

