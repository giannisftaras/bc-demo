<head>
    <meta charset="utf-8">
    <meta name="theme-color" content="#462667">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?php if (isset($page_details['no_index']) && $page_details['no_index'] === true) : ?>
        <meta name="robots" content="noindex">
    <?php endif; ?>
    <link rel="shortcut icon" type="image/png" href="/assets/img/favicon.png"/>
    <?php if (current_page() == 'index.php') : ?>
        <title>Casino World • The best online casino guide!</title>
        <meta property="og:title" content="Casino World - The best online casino guide!" />
    <?php else : ?>
        <title><?=$page_details['title'] ?? ''?> • Casino World</title>
        <meta property="og:title" content="<?=$page_details['title'] ?? ''?> - Casino World" />
    <?php endif; ?>
    
    <meta property="og:site_name" content="Casino World">
    <meta property="og:locale" content="en_US">
    <meta name="description" content="Welcome to Casino World! The best online casino guide!" />
    <meta property="og:description" content="Welcome to Casino World! The best online casino guide!" />
    <meta property="og:image" content="<?=$domain_url?>/assets/img/logo-lg.png" />
    <meta property="og:image:alt" content="<?=$page_details['title'] ?? 'Page'?>" />
    <meta name="twitter:card" content="summary_large_image">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/assets/css/main.css?ver=<?=$config_ini['version']?>">

    <?php if (current_page() == 'admin.php') : ?>
        <link rel="stylesheet" type="text/css" href="/assets/css/adm.css?ver=<?=$config_ini['version']?>">
    <?php endif; ?>
</head>
