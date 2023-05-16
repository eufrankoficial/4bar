<?php

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('menu')->delete();
        $menus = [
            [
                'menu' => 'Cadastros',
                'order' => 1,
                'route' => '#',
                'icon' => 'icon-list',
                'slug' => 'cadastros',
                'created_by' => 1,
                'updated_by' => 1,
                'parents' => [
                    [
                        'menu' => 'Organizações',
                        'route' => 'orgs.index',
                        'order' => 1,
                        'slug' => 'organizacoes',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                    [
                        'menu' => 'Bares',
                        'route' => 'branchs.index',
                        'order' => 2,
                        'slug' => 'bares',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                    [
                        'menu' => 'Fornecedores',
                        'route' => 'supplier.index',
                        'order' => 1,
                        'slug' => 'fornecedores',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                    [
                        'menu' => 'Tipos de Cerveja',
                        'route' => 'beer_type.index',
                        'order' => 1,
                        'slug' => 'tipos-de-cerveja',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                    [
                        'menu' => 'Torneiras',
                        'route' => 'supplier.index',
                        'order' => 1,
                        'slug' => 'torneiras',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                ],
            ],
            [
                'menu' => 'Estoque',
                'slug' => 'estoque',
                'route' => '#',
                'order' => 2,
                'icon' => 'icon-social-dropbox',
                'created_by' => 1,
                'updated_by' => 1,
                'parents' => [
                    [
                        'menu' => 'Adicionar/remover barril',
                        'route' => 'kegs.add',
                        'order' => 1,
                        'slug' => 'adicionar-remover-barril',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                    [
                        'menu' => 'Barris',
                        'route' => 'kegs.index',
                        'order' => 2,
                        'slug' => 'visualizar',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                    [
                        'menu' => 'Camara Fria',
                        'route' => 'cold_chamber.index',
                        'order' => 2,
                        'slug' => 'camara-fria',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                    [
                        'menu' => 'Torneiras',
                        'route' => 'taps.index',
                        'order' => 2,
                        'slug' => 'torneiras',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                ],
            ],
            [
                'menu' => 'Manutenção',
                'slug' => 'manutenção',
                'route' => '#',
                'order' => 2,
                'icon' => 'icon-wrench',
                'created_by' => 1,
                'updated_by' => 1,
                'parents' => [
                    [
                        'menu' => 'Dispositivos',
                        'route' => 'devices.index',
                        'order' => 2,
                        'slug' => 'dispositivos',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                    [
                        'menu' => 'Torneiras / Linha',
                        'route' => 'users.index',
                        'order' => 2,
                        'slug' => 'torneiras-linha',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                    [
                        'menu' => 'Câmara Fria',
                        'route' => 'cold_chamber.index',
                        'order' => 2,
                        'slug' => 'camara-fria',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                ],
            ],
            [
                'menu' => 'Relatórios',
                'slug' => 'relatorios',
                'route' => '#',
                'order' => 2,
                'icon' => 'icon-bar-chart',
                'created_by' => 1,
                'updated_by' => 1,
                'parents' => [
                    [
                        'menu' => 'Relatórios',
                        'route' => 'users.index',
                        'order' => 1,
                        'slug' => 'relatorios',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                    [
                        'menu' => 'Gráficos',
                        'route' => 'users.index',
                        'order' => 2,
                        'slug' => 'graficos',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                ],
            ],
            [
                'menu' => 'Usuarios',
                'slug' => 'usuarios',
                'route' => '#',
                'order' => 2,
                'icon' => 'icon-users',
                'created_by' => 1,
                'updated_by' => 1,
                'parents' => [
                    [
                        'menu' => 'Todos',
                        'route' => 'users.index',
                        'order' => 1,
                        'slug' => 'todos',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                    [
                        'menu' => 'Permissões',
                        'route' => 'users.permission.index',
                        'order' => 2,
                        'slug' => 'permissoes',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                    [
                        'menu' => 'Tipos de usuários',
                        'route' => 'users.group.index',
                        'order' => 3,
                        'slug' => 'tipos-de-usuario',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                ],
            ],
            [
                'menu' => 'Configurações',
                'slug' => 'configuracoes',
                'route' => '#',
                'order' => 2,
                'icon' => 'icon-settings',
                'created_by' => 1,
                'updated_by' => 1,
                'parents' => [
                    [
                        'menu' => 'PINs',
                        'route' => 'pins.index',
                        'order' => 1,
                        'slug' => 'pins',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                    [
                        'menu' => 'Menus',
                        'route' => 'menu.index',
                        'order' => 1,
                        'slug' => 'menus',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                    [
                        'menu' => 'Devices',
                        'route' => 'devices.index',
                        'order' => 1,
                        'slug' => 'devices',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                    [
                        'menu' => 'Tipos de sensores',
                        'route' => 'sensor_type.index',
                        'order' => 1,
                        'slug' => 'tipos-de-sensores',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                    [
                        'menu' => 'Sensores',
                        'route' => 'sensors.index',
                        'order' => 1,
                        'slug' => 'sensores',
                        'created_by' => 1,
                        'updated_by' => 1,
                    ],
                ],
            ],
        ];

        foreach($menus as $menu) {
            $parents = isset($menu['parents']) ? $menu['parents'] : [];
            unset($menu['parents']);

            $m = Menu::create($menu);


            if(count($parents) > 0) {
                foreach($parents as $parent) {
                    $parent['parent_id'] = $m->id;

                    Menu::create($parent);
                }
            }

        }
    }
}
