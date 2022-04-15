<?php

$menus = $local_query_handle->get_header_menu();

?>

<header>
    <div class="d-flex align-items-center">
        <div class="logo">
            <img src="/assets/img/logo.png" alt="CasinoWorld">
        </div>
        <div class="mobile-menu-hm">
            <button data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
                <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" width="29" height="29" style="fill: #FFFFFF">
                    <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path>
                </svg>
            </button>
        </div>
        <div class="menu-items">
            <?php foreach ($menus as $mi => $menu) : ?>
                <?php if (!empty($menu['child'])) : ?>
                    <div class="menu-item dropd">
                        <div class="dropdown">
                            <a href="<?=$menu['menu_url'] ?? '#'?>" class="menu-btn dropdown-toggle" role="button" id="drpBtn<?=$mi?>" data-bs-toggle="dropdown" aria-expanded="false">
                                <?=$menu['menu_text']?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="drpBtn<?=$mi?>">
                                <?php foreach ($menu['child'] as $menu_child) : ?>
                                    <li><a class="dropdown-item" href="<?=$menu_child['menu_url'] ?? '#'?>"><?=$menu_child['menu_text']?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="menu-item">
                        <a href="<?=$menu['menu_url'] ?? '#'?>" class="menu-btn"><?=$menu['menu_text']?></a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</header>

<div class="offcanvas offcanvas-end sidebar-menu" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenu">
    <div>
        <div class="background-dsgn"></div>
    </div>
    <div class="offcanvas-header">
        <div class="logo">
            <img src="/assets/img/logo.png" alt="CasinoWorld">
        </div>
        <button type="button" class="btn-close-custom" data-bs-dismiss="offcanvas" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" width="29" height="29" style="fill: #ffffff;">
                <path d="m16.192 6.344-4.243 4.242-4.242-4.242-1.414 1.414L10.535 12l-4.242 4.242 1.414 1.414 4.242-4.242 4.243 4.242 1.414-1.414L13.364 12l4.242-4.242z"></path>
            </svg>
        </button>
    </div>
    <div class="offcanvas-body">
        <div>
            <div class="accordion" id="sidemenuAcc">
                <?php foreach ($menus as $mi => $menu) : ?>
                    <?php if (!empty($menu['child'])) : ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading<?=$mi?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$mi?>" aria-controls="collapse<?=$mi?>">
                                    <?=$menu['menu_text']?>
                                </button>
                            </h2>
                            <div id="collapse<?=$mi?>" class="accordion-collapse collapse" aria-labelledby="heading<?=$mi?>" data-bs-parent="#sidemenuAcc">
                                <div class="accordion-body">
                                    <ul>
                                        <?php foreach ($menu['child'] as $menu_child) : ?>
                                            <li><a href="<?=$menu_child['menu_url'] ?? '#'?>"><?=$menu_child['menu_text']?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <a href="<?=$menu['menu_url'] ?? '#'?>" class="ofcb-lnk"><?=$menu['menu_text']?></a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>