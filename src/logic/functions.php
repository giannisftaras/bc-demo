<?php

$domain_url = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://' . $_SERVER['SERVER_NAME'];

/**
 * Format the plan pricing to a user friendly format
 * @param string $id The currency integer from the database
 * @param string $price The plan price
 * @return string Return the formated plan pricing
 */
function format_plan_price(string $id, string $price) : string {
    if (is_numeric($id) && is_numeric($price)) {
        $id = intval($id);
        switch ($id) {
            case 1:
                return $price . '€'; // Euro
            case 2:
                return '$' . $price; // Dollar (US, AUS, etc.)
            case 3:
                return $price . 'zł'; // Polish Zloti
            case 4:
                return $price . '₽'; // Russian Ruble
            default:
                return '£' . $price; // British Pound
        }
    }
    return '£0';
}

/**
 * Validate the supplied image
 * @param string $image The temp image uploaded on the server
 * @param string $img_name The image name as supplied by the end user
 * @param array $filetypes Allowed image file mime types (as specified in https://www.php.net/manual/en/function.image-type-to-mime-type.php)
 * @param array $exts Allowed file extensions
 * @param array $mindim Allowed minimun image dimensions
 * @param array $maxdim Allowed maximum image dimensions
 * @param int $maxsize The maximum file size allowed
 * @return bool
 */
function validateImage(string $image, string $img_name, array $filetypes, array $exts, array $mindim, array $maxdim, int $maxsize) : bool {
    list($width, $height, $type, $attr) = getimagesize($image);
    if (!in_array($type, $filetypes)) {
        return false;
    } elseif (!in_array(strtolower(pathinfo($img_name, PATHINFO_EXTENSION)), $exts)) {
        return false;
    } elseif ($width < $mindim[0] || $height < $mindim[1] || $width > $maxdim[0] || $height > $maxdim[1]) {
        return false;
    } elseif ((filesize($image) / 1024) > $maxsize) {
        return false;
    }
    return true;
}

?>