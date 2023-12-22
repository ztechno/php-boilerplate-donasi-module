<?php 
return [
    [
        'label' => 'donasi.menu.donations',
        'icon'  => 'fa-fw fa-xl me-2 fa-solid fa-money-bill',
        'route' => routeTo('crud/index',['table'=>'donasi']),
        'activeState' => 'default.donations'
    ],
];