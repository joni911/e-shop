<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Blade::directive('currency', function ( $expression ) { return "Rp. <?php echo number_format($expression,0,',','.'); ?>"; });
        Blade::directive('currencynorp', function ( $expression ) { return "<?php echo number_format($expression,0,',','.'); ?>"; });

        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {
            // Add some items to the menu...
            $user = Auth::user();

            $event->menu->add('MAIN NAVIGATION');
            switch ($user->hak_akses) {
                case 'user':
                    # code...
                    $event->menu->add(
                        [
                            'text'        => 'Tender User',
                            'url'         => 'tender_home',
                            'icon'        => 'far fa-fw fa-file',
                            'label'       => 4,
                            'label_color' => 'success',
                        ],
                    );
                    break;

                default:
                    # code...
                    $event->menu->add(

                        // [
                        //     'type'         => 'navbar-search',
                        //     'text'         => 'search',
                        //     'topnav_right' => true,
                        // ],
                        // [
                        //     'type'         => 'fullscreen-widget',
                        //     'topnav_right' => true,
                        // ],

                        // // Sidebar items:
                        // [
                        //     'type' => 'sidebar-menu-search',
                        //     'text' => 'search',
                        // ],
                        // [
                        //     'text' => 'blog',
                        //     'url'  => 'admin/blog',
                        //     'can'  => 'manage-blog',
                        // ],
                        // [
                        //     'text'        => 'Barang',
                        //     'url'         => 'barang',
                        //     'icon'        => 'far fa-fw fa-file',
                        //     // 'label'       => 4,
                        //     'label_color' => 'success',
                        // ],
                        // [
                        //     'text'        => 'Barang User',
                        //     'url'         => 'shops',
                        //     'icon'        => 'far fa-fw fa-file',
                        //     // 'label'       => 4,
                        //     'label_color' => 'success',
                        // ],
                        [
                            'text'        => 'Tender',
                            'url'         => 'tender_admin',
                            'icon'        => 'far fa-fw fa-file',
                            // 'label'       => 4,
                            'label_color' => 'success',
                        ],
                        [
                            'text'        => 'Tender User',
                            'url'         => 'tender_home',
                            'icon'        => 'far fa-fw fa-file',
                            // 'label'       => 4,
                            'label_color' => 'success',
                        ],
                        [
                            'text'    => 'Master',
                            'icon'    => 'fas fa-fw fa-share',
                            'submenu' => [
                                 [
                                    'text' => 'Katagori',
                                    'url'  => 'katagori',
                                    'icon' => 'fas fa-fw fa-list'

                                ],
                                [
                                    'text' => 'Jenis pengadaan',
                                    'url' => 'jenis_pengadaan',
                                    'icon' => 'fas fa-fw fa-boxes'

                                ],
                                [
                                    'text' => 'Jenis Kontrak',
                                    'url'  => 'jenis_kontrak',
                                    'icon' => 'fas fa-fw fa-certificate'
                                ],
                                [
                                    'text' => 'Metode Pengadaan',
                                    'url'  => 'metode_pengadaan',
                                    'icon' => 'fas fa-fw fa-route'
                                ],
                                [
                                    'text' => 'Status Tender',
                                    'url'  => 'status_tender',
                                    'icon' => 'fas fa-fw fa-info-circle'
                                ]

                            ],
                        ],

                        ['header' => 'Pemeriksaan'],
                        [
                            'text' => 'Pemeriksaan',
                            'url'  => 'dashboard',
                            'icon' => 'fas fa-search'
                        ],


                );
                    break;
            }

        });
    }
}
