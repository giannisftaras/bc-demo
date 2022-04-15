<?php

require $_SERVER['DOCUMENT_ROOT'] . '/../src/logic/init.php';
$page_details = [
    'title' => 'Admin Portal',
    'no_index' => true
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $csrf->validate('update-adm-fields')) {
    require process('update-fields');
}

$menus = $local_query_handle->get_header_menu();
$casinos = $local_query_handle->get_casino_cards();

?>

<!DOCTYPE html>
<html lang="en">
<?php include views("head"); ?>

<body class="preload admin-page">
    <div class="adm-header">
        <div class="d-flex align-items-center logo-lnk">
            <a href="/">
                <img src="/assets/img/logo.png" alt="CasinoWorld">
            </a>
            <span class="ms-3 me-5">Admin Portal</span>
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-menu-tab" data-bs-toggle="pill" data-bs-target="#pills-menu" type="button" role="tab" aria-controls="pills-menu" aria-selected="true">Header menu</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-cards-tab" data-bs-toggle="pill" data-bs-target="#pills-cards" type="button" role="tab" aria-controls="pills-cards" aria-selected="false">Casino cards</button>
                </li>
            </ul>
            <button type="submit" form="upd-form" class="btn btn-sm btn-light ms-auto d-flex align-items-center">
                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" width="20" height="20" style="fill: var(--unnamed-color-aa68c9);"><path d="M5 21h14a2 2 0 0 0 2-2V8a1 1 0 0 0-.29-.71l-4-4A1 1 0 0 0 16 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2zm10-2H9v-5h6zM13 7h-2V5h2zM5 5h2v4h8V5h.59L19 8.41V19h-2v-5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v5H5z"></path></svg>
                Save changes
            </button>
        </div>
    </div>

    <div class="toast alert-toast border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>

    <main class="main-page">
        <form id="upd-form" action="" method="POST" enctype="multipart/form-data" onkeydown="return event.key != 'Enter';">
            <div class="main-container p-4">
                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade show active" id="pills-menu" role="tabpanel" aria-labelledby="pills-menu-tab">
                        <div class="row">
                            <div class="col-12 col-lg-5">
                                <div class="d-flex align-items-center mb-2">
                                    <div>
                                        <h4>Header Menu</h4>
                                        <p class="mb-0">Modify and customize the header menu entries</p>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-primary ms-auto" onclick="addNewItem()">Add new item</button>
                                </div>
                                <hr class="mb-5">
                                <input type="hidden" name="menu_order">
                                <?=$csrf->input('update-adm-fields')?>
                                <div id="menulist" class="menu-list">

                                    <?php foreach ($menus as $mi => $menu) : ?>
                                        <div class="menu-item" data-order="<?=$menu['id']?>" data-parent-id="<?=$menu['id']?>">
                                            <div class="card nest-item">
                                                <div class="card-body">
                                                    <div class="row w-100 me-3">
                                                        <div class="col-12 col-lg-6">
                                                            <label for="menuTextInput<?=$menu['id']?>" class="form-label">Menu text</label>
                                                            <input type="text" class="form-control" id="menuTextInput<?=$menu['id']?>" name="menuText-<?=$menu['id']?>" maxlength="50" value="<?=$menu['menu_text'] ?? ''?>" required>
                                                        </div>
                                                        <div class="col-12 col-lg-6 mt-2 mt-lg-0">
                                                            <label for="menuUrlInput<?=$menu['id']?>" class="form-label">Menu URL</label>
                                                            <input type="text" class="form-control" id="menuUrlInput<?=$menu['id']?>" name="menuUrl-<?=$menu['id']?>" maxlength="150" value="<?=$menu['menu_url'] ?? ''?>" required>
                                                        </div>
                                                    </div>
                                                    <button type="button" title="Remove item" class="rm-item">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" width="24" height="24" style="fill: var(--bs-danger);"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm5 11H7v-2h10v2z"></path></svg>
                                                    </button>
                                                    <div title="Move item" class="drg-icon ms-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" width="24" height="24" style="fill: rgba(0, 0, 0, 1);">
                                                            <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if (isset($menu['child'])) : ?>
                                                <div class="menu-list">
                                                <?php foreach ($menu['child'] as $ci => $child) : ?>
                                                    <div class="menu-item" data-order="<?=$child['id']?>">
                                                        <div class="card nest-item">
                                                            <div class="card-body">
                                                                <div class="row w-100 me-3">
                                                                    <div class="col-12 col-lg-6">
                                                                        <label for="menuTextInput<?=$child['id']?>" class="form-label">Menu text</label>
                                                                        <input type="text" class="form-control" id="menuTextInput<?=$menu['id']?>-<?=$child['id']?>" name="menuText-<?=$child['id']?>" maxlength="50" value="<?=$child['menu_text'] ?? ''?>" required>
                                                                    </div>
                                                                    <div class="col-12 col-lg-6 mt-2 mt-lg-0">
                                                                        <label for="menuUrlInput<?=$menu['id']?>-<?=$child['id']?>" class="form-label">Menu URL</label>
                                                                        <input type="text" class="form-control" id="menuUrlInput<?=$menu['id']?>-<?=$child['id']?>" name="menuUrl-<?=$child['id']?>" maxlength="150" value="<?=$child['menu_url'] ?? ''?>" required>
                                                                    </div>
                                                                </div>
                                                                <button type="button" title="Remove item" class="rm-item">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" width="24" height="24" style="fill: var(--bs-danger);"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm5 11H7v-2h10v2z"></path></svg>
                                                                </button>
                                                                <div title="Move item" class="drg-icon ms-3">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" width="24" height="24" style="fill: rgba(0, 0, 0, 1);">
                                                                        <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                                </div>
                                            <?php else : ?>
                                                <div class="menu-list"></div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-cards" role="tabpanel" aria-labelledby="pills-cards-tab">
                        <h4>Casino Cards</h4>
                        <p class="mb-2">Customize the contents of the casino cards at the homepage</p>
                        <hr class="mb-4">
                        <div class="row mb-4">                        
                            <div class="col-12 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Left Card</h5>
                                        <div class="mb-3">
                                            <label for="lCasinoNameInput" class="form-label">Casino Name</label>
                                            <input type="text" class="form-control" id="lCasinoNameInput" name="l-casino-name" value="<?=$casinos[1]['casino_name'] ?? ''?>" maxlength="100" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lCasinoIDInput" class="form-label">Plan ID</label>
                                            <input type="text" class="form-control" id="lCasinoIDInput" name="l-casino-id" value="<?=$casinos[1]['plan_id'] ?? ''?>" maxlength="50" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lCasinoImageInp" class="form-label">Image</label>
                                            <input class="form-control" type="file" id="lCasinoImageInp" name="l-casino-image">
                                            <small>File types: .png, .jpg | Recommended size: 100x100</small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lCasinoRating" class="form-label">Rating</label>
                                            <input type="number" class="form-control" id="lCasinoRating" name="l-casino-rating" step=".1" max="5" min="1" value="<?=$casinos[1]['plan_rating'] ?? '1'?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lCasinoPriceGroup">Plan price</label>
                                            <div class="input-group" id="lCasinoPriceGroup">
                                                <input type="number" class="form-control" id="lCasinoPrice" name="l-casino-price" step="1" min="1" value="<?=$casinos[1]['plan_price'] ?? '1'?>" required>
                                                <select id="lCasinoCurr" class="form-select mx-cnt" name="l-casino-currency" required>
                                                    <option selected>Select currency</option>
                                                    <option value="0">British Pound (£)</option>
                                                    <option value="1">Euro (€)</option>
                                                    <option value="2">Dollar ($)</option>
                                                    <option value="3">Polish Zloti (zł)</option>
                                                    <option value="4">Russian Ruble (₽)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lCasinoTC" class="form-label">Terms & Conditions</label>
                                            <input type="text" class="form-control" id="lCasinoTC" name="l-casino-tc" value="<?=$casinos[1]['terms_text'] ?? ''?>" maxlength="100" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lCasinoDesc" class="form-label">Plan description</label>
                                            <input type="text" class="form-control" id="lCasinoDesc" name="l-casino-desc" value="<?=$casinos[1]['plan_description'] ?? ''?>" maxlength="250" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lCasinoCtaText" class="form-label">CTA Text</label>
                                            <input type="text" class="form-control" id="lCasinoCtaText" name="l-casino-cta-text" value="<?=$casinos[1]['cta_text'] ?? ''?>" maxlength="50" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lCasinoCtaURL" class="form-label">CTA URL</label>
                                            <input type="text" class="form-control" id="lCasinoCtaURL" name="l-casino-cta-url" value="<?=$casinos[1]['cta_url'] ?? ''?>" maxlength="250">
                                        </div>
                                        <div class="mb-3">
                                            <label for="lCasinoReviewText" class="form-label">Review Button Text</label>
                                            <input type="text" class="form-control" id="lCasinoReviewText" name="l-casino-review-text" value="<?=$casinos[1]['review_btn_text'] ?? ''?>" maxlength="50" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="lCasinoReviewUrl" class="form-label">Review Button URL</label>
                                            <input type="text" class="form-control" id="lCasinoReviewUrl" name="l-casino-review-url" value="<?=$casinos[1]['review_btn_url'] ?? ''?>" maxlength="250">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Center Card</h5>
                                        <div class="mb-3">
                                            <label for="cCasinoNameInput" class="form-label">Casino Name</label>
                                            <input type="text" class="form-control" id="cCasinoNameInput" name="c-casino-name" value="<?=$casinos[0]['casino_name'] ?? ''?>" maxlength="100" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="cCasinoIDInput" class="form-label">Plan ID</label>
                                            <input type="text" class="form-control" id="cCasinoIDInput" name="c-casino-id" value="<?=$casinos[0]['plan_id'] ?? ''?>" maxlength="50" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="cCasinoImageInp" class="form-label">Image</label>
                                            <input class="form-control" type="file" id="cCasinoImageInp" name="c-casino-image">
                                            <small>File types: .png, .jpg | Recommended size: 100x100</small>                                        
                                        </div>
                                        <div class="mb-3">
                                            <label for="cCasinoRating" class="form-label">Rating</label>
                                            <input type="number" class="form-control" id="cCasinoRating" name="c-casino-rating" step=".1" max="5" min="1" value="<?=$casinos[0]['plan_rating'] ?? '1'?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="cCasinoPriceGroup">Plan price</label>
                                            <div class="input-group" id="cCasinoPriceGroup">
                                                <input type="number" class="form-control" id="cCasinoPrice" name="c-casino-price" step="1" min="1" value="<?=$casinos[0]['plan_price'] ?? '1'?>" required>
                                                <select id="cCasinoCurr" class="form-select mx-cnt" name="c-casino-currency" required>
                                                    <option selected>Select currency</option>
                                                    <option value="0">British Pound (£)</option>
                                                    <option value="1">Euro (€)</option>
                                                    <option value="2">Dollar ($)</option>
                                                    <option value="3">Polish Zloti (zł)</option>
                                                    <option value="4">Russian Ruble (₽)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="cCasinoTC" class="form-label">Terms & Conditions</label>
                                            <input type="text" class="form-control" id="cCasinoTC" name="c-casino-tc" value="<?=$casinos[0]['terms_text'] ?? ''?>" maxlength="100" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="cCasinoDesc" class="form-label">Plan description</label>
                                            <input type="text" class="form-control" id="cCasinoDesc" name="c-casino-desc" value="<?=$casinos[0]['plan_description'] ?? ''?>" maxlength="250" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="cCasinoCtaText" class="form-label">CTA Text</label>
                                            <input type="text" class="form-control" id="cCasinoCtaText" name="c-casino-cta-text" value="<?=$casinos[0]['cta_text'] ?? ''?>" maxlength="50" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="cCasinoCtaURL" class="form-label">CTA URL</label>
                                            <input type="text" class="form-control" id="cCasinoCtaURL" name="c-casino-cta-url" value="<?=$casinos[0]['cta_url'] ?? ''?>" maxlength="250">
                                        </div>
                                        <div class="mb-3">
                                            <label for="cCasinoReviewText" class="form-label">Review Button Text</label>
                                            <input type="text" class="form-control" id="cCasinoReviewText" name="c-casino-review-text" value="<?=$casinos[0]['review_btn_text'] ?? ''?>" maxlength="50" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="cCasinoReviewUrl" class="form-label">Review Button URL</label>
                                            <input type="text" class="form-control" id="cCasinoReviewUrl" name="c-casino-review-url" value="<?=$casinos[0]['review_btn_url'] ?? ''?>" maxlength="250">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 mt-0 mt-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Right Card</h5>
                                        <div class="mb-3">
                                            <label for="rCasinoNameInput" class="form-label">Casino Name</label>
                                            <input type="text" class="form-control" id="rCasinoNameInput" name="r-casino-name" value="<?=$casinos[2]['casino_name'] ?? ''?>" maxlength="100" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="rCasinoIDInput" class="form-label">Plan ID</label>
                                            <input type="text" class="form-control" id="rCasinoIDInput" name="r-casino-id" value="<?=$casinos[2]['plan_id'] ?? ''?>" maxlength="50" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="rCasinoImageInp" class="form-label">Image</label>
                                            <input class="form-control" type="file" id="rCasinoImageInp" name="r-casino-image">
                                            <small>File types: .png, .jpg | Recommended size: 100x100</small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="rCasinoRating" class="form-label">Rating</label>
                                            <input type="number" class="form-control" id="rCasinoRating" name="r-casino-rating" step=".1" max="5" min="1" value="<?=$casinos[2]['plan_rating'] ?? '1'?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="rCasinoPriceGroup">Plan price</label>
                                            <div class="input-group" id="rCasinoPriceGroup">
                                                <input type="number" class="form-control" id="rCasinoPrice" name="r-casino-price" step="1" min="1" value="<?=$casinos[2]['plan_price'] ?? '1'?>" required>
                                                <select id="rCasinoCurr" class="form-select mx-cnt" name="r-casino-currency" required>
                                                    <option selected>Select currency</option>
                                                    <option value="0">British Pound (£)</option>
                                                    <option value="1">Euro (€)</option>
                                                    <option value="2">Dollar ($)</option>
                                                    <option value="3">Polish Zloti (zł)</option>
                                                    <option value="4">Russian Ruble (₽)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="rCasinoTC" class="form-label">Terms & Conditions</label>
                                            <input type="text" class="form-control" id="rCasinoTC" name="r-casino-tc" value="<?=$casinos[2]['terms_text'] ?? ''?>" maxlength="100" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="rCasinoDesc" class="form-label">Plan description</label>
                                            <input type="text" class="form-control" id="rCasinoDesc" name="r-casino-desc" value="<?=$casinos[2]['plan_description'] ?? ''?>" maxlength="250" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="rCasinoCtaText" class="form-label">CTA Text</label>
                                            <input type="text" class="form-control" id="rCasinoCtaText" name="r-casino-cta-text" value="<?=$casinos[2]['cta_text'] ?? ''?>" maxlength="50" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="rCasinoCtaURL" class="form-label">CTA URL</label>
                                            <input type="text" class="form-control" id="rCasinoCtaURL" name="r-casino-cta-url" value="<?=$casinos[2]['cta_url'] ?? ''?>" maxlength="250">
                                        </div>
                                        <div class="mb-3">
                                            <label for="rCasinoReviewText" class="form-label">Review Button Text</label>
                                            <input type="text" class="form-control" id="rCasinoReviewText" name="r-casino-review-text" value="<?=$casinos[2]['review_btn_text'] ?? ''?>" maxlength="50" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="rCasinoReviewUrl" class="form-label">Review Button URL</label>
                                            <input type="text" class="form-control" id="rCasinoReviewUrl" name="r-casino-review-url" value="<?=$casinos[2]['review_btn_url'] ?? ''?>" maxlength="250">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </main>

    <template id="nest-item-template">
        <div class="menu-item" data-order="" data-parent-id="">
            <div class="card nest-item">
                <div class="card-body">
                    <div class="row w-100 me-3">
                        <div class="col">
                            <label for="menuTextInput-" class="form-label mt-fl">Menu text</label>
                            <input type="text" class="form-control" id="menuTextInput-" name="menuText-" maxlength="50" required>
                        </div>
                        <div class="col">
                            <label for="menuUrlInput-" class="form-label mu-fl">Menu URL</label>
                            <input type="text" class="form-control" id="menuUrlInput-" name="menuUrl-" maxlength="150" required>
                        </div>
                    </div>
                    <button type="button" title="Remove item" class="rm-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" width="24" height="24" style="fill: var(--bs-danger);"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm5 11H7v-2h10v2z"></path></svg>
                    </button>
                    <div title="Move item" class="drg-icon ms-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" width="24" height="24" style="fill: rgba(0, 0, 0, 1);">
                            <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="menu-list"></div>
        </div>
    </template>

    <?php include views("scripts"); ?>
    <script>
        document.getElementById("lCasinoCurr").value = <?=$casinos[1]['plan_currency']?>;
        document.getElementById("cCasinoCurr").value = <?=$casinos[0]['plan_currency']?>;
        document.getElementById("rCasinoCurr").value = <?=$casinos[2]['plan_currency']?>;

        <?php if (isset($saved_changes)) : ?>
            $(document).ready(function(){
                display_alert('<?=$saved_changes[1]?>', '<?=$saved_changes[0]?>');
            });
        <?php endif; ?>
    </script>

</body>

</html>