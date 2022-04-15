<?php

$update_errors = false;

if (!empty($_POST['menu_order'])) {
    $menu_order = json_decode(html_entity_decode($_POST['menu_order']), true);
    $n_menus = [];
    foreach ($menu_order as $mo) {
        $n_menus[$mo['item_id']] = [
            'name' => htmlspecialchars($_POST['menuText-' . $mo['item_id']]),
            'url' => htmlspecialchars($_POST['menuUrl-' . $mo['item_id']])
        ];
        if (!empty($mo['parent_id']) && is_numeric($mo['parent_id'])) {
            $n_menus[$mo['item_id']]['parent_id'] = $mo['parent_id'];
        }
    }
    $m_resp = $local_query_handle->update_header_menu($n_menus);

    if (!empty($m_resp)) {
        $update_errors = true;
    }
    
} else {
    $local_query_handle->clear_header_table();
}

$c_resp = $local_query_handle->update_casino_cards($_POST);
if (!empty($c_resp)) {
    $update_errors = true;
}

if (!empty($_FILES['l-casino-image']['tmp_name']) && validateImage($_FILES['l-casino-image']['tmp_name'], $_FILES['l-casino-image']['name'], [IMAGETYPE_JPEG ,IMAGETYPE_PNG], ['jpg','jpeg','png'], [40,40], [350,350], 2048)) {
    move_uploaded_file($_FILES['l-casino-image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/assets/img/bc1.png');
}
if (!empty($_FILES['c-casino-image']['tmp_name']) && validateImage($_FILES['c-casino-image']['tmp_name'], $_FILES['c-casino-image']['name'], [IMAGETYPE_JPEG ,IMAGETYPE_PNG], ['jpg','jpeg','png'], [40,40], [350,350], 2048)) {
    move_uploaded_file($_FILES['c-casino-image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/assets/img/bc0.png');
}
if (!empty($_FILES['r-casino-image']['tmp_name']) && validateImage($_FILES['r-casino-image']['tmp_name'], $_FILES['r-casino-image']['name'], [IMAGETYPE_JPEG ,IMAGETYPE_PNG], ['jpg','jpeg','png'], [40,40], [350,350], 2048)) {
    move_uploaded_file($_FILES['r-casino-image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/assets/img/bc2.png');
}

if ($update_errors) {
    $saved_changes = ['success', 'Your changes were saved successfully!'];
} else {
    $saved_changes = ['error', 'An error occured whilst trying to save your changes. Try again.'];
}

?>