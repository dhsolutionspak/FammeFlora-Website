<?php


return [

    'status' => [
        1 => 'Active',
        0 => 'Inactive'
    ],

    'languages' => [
        1 => 'Yes',
        0 => 'No'
    ],

    'tax_type' => [
        1 => 'Percentage',
        2 => 'Fixed'
    ],

    'file_path' => [
        'category' => 'uploads/category',
        'banner' => 'uploads/banner',
        'manufacturer' => 'uploads/manufacturer',
        'product' => 'uploads/product',
        'product_option' => 'uploads/product_option',
        'store' => 'uploads/store',
        'user' => 'uploads/user',
        'language' => 'uploads/language',
        'paymentmethod' => 'uploads/paymentmethods'
    ],

    'date_format' => [
        'date_format_js' => "dd/mm/yyyy",
        'custom_date_format' => 'd/m/Y',
        'database_date_format' => 'Y-m-d'
    ],

    'payment_method' => [
      1 => 'COD',
      2 => 'Debit Card',
      3 => 'Credit Card',
    ],

    'shipping_method' => [
      1 => 'UPS',
      2 => 'Fedex',
    ],

    'order_status' => [
        1 => 'Canceled',
        2 =>'Canceled Reversal',
        3 =>'Chargeback',
        4 =>'Complete',
        5 =>'Denied',
        6 =>'Expired',
        7 =>'Failed',
        8 =>'Pending',
        9 =>'Processed',
        10 =>'Processing',
        11 =>'Refunded',
        12 =>'Reversed',
        13 =>'Shipped',
        14 =>'Voided',
    ],

    'product_option' => [
        'Choose' => [
            'Select' => 'Select',
            'Radio' => 'Radio',
            'Checkbox' => 'Checkbox',
            'Color' => 'Color'
        ],
        // 'Input' => [
        //     'Text' => 'Text',
        //     'Textarea' => 'Textarea',
        // ],
    ],

    'checkout_terms' => [
        1 => 'Privacy Policy',
        2 => 'Return and Refund Policy',
        3 => 'Shipping and Delivery Policy',
        4 => 'Terms and Condition'
    ],

    'store_alert_mail' => [
        'Register' => 'Register',
        'Orders' => 'Orders'
    ],

    'price_range' => [
        '$0 - $99',
        '$100 - $250',
        '$250 - $399',
        '$400 - $499',
        '$500 - $699',
        '$700 - $999',
        '$1000+'
    ],

    //'image_loader' => asset('frontend/images/imageloader.gif')

];
