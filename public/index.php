<?php

require $_SERVER['DOCUMENT_ROOT'] . '/../src/logic/init.php';
$casinos = $local_query_handle->get_casino_cards();

?>

<!DOCTYPE html>
<html lang="en">
<?php include views("head"); ?>
<body class="preload homepage">
    <?php include views("header"); ?>
    <div class="background-dsgn"></div>

    <main class="main-page">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="heading-container">
                        <div class="title">
                            <span>Best <span class="title-diff">Online Casino</span> Guide</span>
                        </div>
                        <p class="subtitle">Welcome to Casino World - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque fermentum pharetra urna non faucibus.<br>
                        Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed et sapien vel nisi venenatis pellentesque.<br>
                        Praesent vestibulum enim non tortor sagittis lacinia. Aenean sed euismod nibh, at tempor leo.<br>
                        Morbi malesuada consectetur sapien in bibendum.</p>
                    </div>
                    <div class="row cards-container">
                        <?php if (!empty($casinos)) : ?>
                            <?php if (!empty($casinos[1])) : ?>
                                <div class="col-sm-6 col-lg-4 order-2 order-lg-1 cas-card cas-left">
                                    <div class="rating">
                                        <img src="/assets/img/star.png">
                                        <span><?=$casinos[1]['plan_rating']?></span>
                                    </div>
                                    <div class="cas-title">
                                        <div class="cas-logo">
                                            <img src="/assets/img/bc1.png" alt="<?=$casinos[1]['casino_name']?>">
                                        </div>
                                        <div class="title-cont">
                                            <p class="title"><?=$casinos[1]['casino_name']?></p>
                                            <p class="id"><?=$casinos[1]['plan_id']?></p>
                                        </div>
                                    </div>
                                    <div class="offer-cont">
                                        <div class="ofc-price-cont">
                                            <p class="ofc1">100% up to</p>
                                            <p class="ofc-price"><?=format_plan_price($casinos[1]['plan_currency'], $casinos[1]['plan_price'])?></p>
                                        </div>                                
                                        <p class="ofc2"><?=$casinos[1]['terms_text']?></p>
                                        <p class="ofc-desc"><?=$casinos[1]['plan_description']?></p>
                                    </div>
                                    <a href="<?=$casinos[1]['cta_url'] ?? '#'?>" class="button green"><?=$casinos[1]['cta_text']?></a>
                                    <a href="<?=$casinos[1]['review_btn_url'] ?? '#'?>" class="review-btn"><?=$casinos[1]['review_btn_text']?></a>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($casinos[0])) : ?>
                                <div class="col-sm-12 col-lg-6 order-1 order-lg-2 cas-card cas-main">
                                    <div class="d-flex">                                
                                        <div class="cas-title">
                                            <div class="cas-title-inner-cont">
                                                <div class="cas-logo">
                                                    <img src="/assets/img/bc0.png" alt="<?=$casinos[0]['casino_name']?>">
                                                </div>
                                                <div class="title-cont">
                                                    <p class="title"><?=$casinos[0]['casino_name']?></p>
                                                    <p class="id"><?=$casinos[0]['plan_id']?></p>
                                                </div>
                                            </div>
                                            <div class="rating">
                                                <img src="/assets/img/star.png">
                                                <span><?=$casinos[0]['plan_rating']?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="offer-cont">
                                        <div class="offer-img">
                                            <img class="offer-img-lg" src="/assets/img/greatoffer.png">
                                            <img class="offer-img-sm" src="/assets/img/greatoffer-sm.png">
                                        </div>
                                        <div class="ofc-price-cont">
                                            <p class="ofc1">100% up to</p>
                                            <p class="ofc-price"><?=format_plan_price($casinos[0]['plan_currency'], $casinos[0]['plan_price'])?></p>
                                        </div>                                
                                        <p class="ofc2"><?=$casinos[0]['terms_text']?></p>
                                        <p class="ofc-desc"><?=$casinos[0]['plan_description']?></p>
                                    </div>
                                    <a href="<?=$casinos[0]['cta_url'] ?? '#'?>" class="button orange"><?=$casinos[0]['cta_text']?></a>
                                    <a href="<?=$casinos[0]['review_btn_url'] ?? '#'?>" class="review-btn"><?=$casinos[0]['review_btn_text']?></a>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($casinos[2])) : ?>
                                <div class="col-sm-6 col-lg-4 order-3 cas-card cas-right ms-2 ms-lg-0">
                                    <div class="rating">
                                        <img src="/assets/img/star.png">
                                        <span><?=$casinos[2]['plan_rating']?></span>
                                    </div>
                                    <div class="cas-title">
                                        <div class="cas-logo">
                                            <img src="/assets/img/bc2.png" alt="<?=$casinos[2]['casino_name']?>">
                                        </div>
                                        <div class="title-cont">
                                            <p class="title"><?=$casinos[2]['casino_name']?></p>
                                            <p class="id"><?=$casinos[2]['plan_id']?></p>
                                        </div>
                                    </div>
                                    <div class="offer-cont">
                                        <div class="ofc-price-cont">
                                            <p class="ofc1">100% up to</p>
                                            <p class="ofc-price"><?=format_plan_price($casinos[2]['plan_currency'], $casinos[2]['plan_price'])?></p>
                                        </div>                                
                                        <p class="ofc2"><?=$casinos[2]['terms_text']?></p>
                                        <p class="ofc-desc"><?=$casinos[2]['plan_description']?></p>
                                    </div>
                                    <a href="<?=$casinos[2]['cta_url'] ?? '#'?>" class="button green"><?=$casinos[2]['cta_text']?></a>
                                    <a href="<?=$casinos[2]['review_btn_url'] ?? '#'?>" class="review-btn"><?=$casinos[2]['review_btn_text']?></a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include views("scripts"); ?>

</body>
</html>