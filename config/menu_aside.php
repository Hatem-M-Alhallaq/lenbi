<?php
// Aside menu

return [

    'items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/',
            'new-tab' => false,
        ],

        // Custom
        [
            'title' => 'Roles & Permission',
            
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Role',
                    'bullet' => 'dot',
                    'submenu' => [

                        [
                            'title' => 'Add Role',
                            'page' => 'cms/admin/roles/create'
                        ],
                        [
                            'title' => 'Index Roles',
                            'page' => 'cms/admin/roles'
                        ],
                    ]
                ],
                [
                    'title' => 'Permission',
                    'bullet' => 'dot',
                    'submenu' => [
                         
                        [
                            'title' => 'Add Permission',
                            'page' => 'cms/admin/permissions/create'
                        ],
                        [
                            'title' => 'Index Permission',
                            'page' => 'cms/admin/permissions'
                        ],
                    ]
                ],
                
            ]
        ],
        
        [
            'title' => 'Human Resources',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Admin',
                    'bullet' => 'dot',
                    'submenu' => [
                          
                        [
                           
                            'title' => 'Add Admin',
                            'page' => 'cms/admin/admins/create'
                        ],
                   
                        [
                            'title' => 'Index Admin',
                            'page' => 'cms/admin/admins'
                        ],
                    ]
                ],

            ]
        ],
   

        [
            'title' => 'Content Management',
            'icon' => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'bullet' => 'line',
            'root' => true,
            'submenu' => [

                [
                    'title' => 'Clink',
                    'bullet' => 'dot',
                    'submenu' => [

                        [
                            'title' => 'Add Clink',
                            'page' => 'cms/admin/clinks/create'
                        ],
                        [
                            'title' => 'Index Clink',
                            'page' => 'cms/admin/clinks'
                        ],
                    ]
                ],
                [
                    'title' => 'Members',
                    'bullet' => 'dot',
                    'submenu' => [

                        [
                            'title' => 'Add Member',
                            'page' => 'cms/admin/members/create'
                        ],
                        [
                            'title' => 'Index Member',
                            'page' => 'cms/admin/members'
                        ],
                    ]
                ],
       
          

            ]
        ],

        
    ]

];
