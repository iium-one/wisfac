<?php
include_once('./_common.php');

$sb_menus = [
  [
    'id' => 'introduce',
    'name' => 'WISFAC',
    'link' => '/eng/sub/aboutus?v=vision',
    'sb_2menus' => [
      [
        'id' => 'aboutus',
        'name' => 'Company',
        'link' => '/eng/sub/aboutus?v=vision',
        'sb_3menus' => [
          [
            'id' => 'vision',
            'name' => 'Vision',
            'link' => '/eng/sub/aboutus?v=vision'
          ],
          [
            'id' => 'organization',
            'name' => 'Organization',
            'link' => '/eng/sub/aboutus?v=organization'
          ]
        ]
      ],
      [
        'id' => 'business',
        'name' => 'Business',
        'link' => '/eng/sub/business'
      ],
      [
        'id' => 'greeting',
        'name' => 'Greeting',
        'link' => '/eng/sub/greeting'
      ],
      [
        'id' => 'global',
        'name' => 'Global',
        'link' => '/eng/sub/global'
      ],
      [
        'id' => 'location',
        'name' => 'Location',
        'link' => '/eng/sub/location'
      ]
    ]
  ],
  [
    'id' => 'product',
    'name' => 'Product',
    'link' => '/eng/sub/prod_category',
    'sb_2menus' => []
  ],
  [
    'id' => 'cs',
    'name' => 'CS',
    'link' => '/eng/sub/contact',
    'sb_2menus' => [
      [
        'id' => 'contact',
        'name' => 'Inquiry',
        'link' => '/eng/sub/contact'
      ],
      [
        'id' => 'news',
        'name' => 'News',
        'link' => '/news_eng'
      ],
      [
        'id' => 'notice',
        'name' => 'Notices',
        'link' => '/notice_eng'
      ]
    ]
  ],
  [
    'id' => 'employ',
    'name' => 'Recruitment',
    'link' => '/eng/sub/announce',
    'sb_2menus' => [
      [
        'id' => 'announce',
        'name' => 'Information',
        'link' => '/eng/sub/announce'
      ],
      [
        'id' => 'welfare',
        'name' => 'Welfare',
        'link' => '/eng/sub/welfare'
      ]
    ]
  ]
];

//제품 카테고리 DB 데이터 가져오기 + 메뉴 배열에 할당
$cate_table = G5_TABLE_PREFIX.'shop_category';
$cate_lang = 'ENG';
$prd_table = G5_TABLE_PREFIX.'shop_item';
$prd_cate_sql = " select ca_id, ca_1_subj from {$cate_table} where ca_lang = '{$cate_lang}' ";
$prd_cate_result = sql_query($prd_cate_sql);
$prd_cate = array();
for($i=0; $prd_cate_row=sql_fetch_array($prd_cate_result); $i++){
  $sb_menus[1]['sb_2menus'][] = [
    'id' => $prd_cate_row['ca_id'],
    'name' => $prd_cate_row['ca_1_subj'],
    'link' => '/eng/sub/prod_list/'.$prd_cate_row['ca_id'],
  ];

  $prd_item_sql = " select it_id, it_name from {$prd_table} where ca_id = '{$prd_cate_row['ca_id']}' and it_use=1 ";
  $prd_item_result = sql_query($prd_item_sql);
  $prd_item = array();
  for($k=0; $prd_item_row=sql_fetch_array($prd_item_result); $k++){
    $sb_menus[1]['sb_2menus'][$i]['sb_3menus'][] = [
      'id' => $prd_item_row['it_id'],
      'name' => $prd_item_row['it_name'],
      'link' => '/eng/sub/prod_view/'.$prd_item_row['it_id'],
    ];
  }
}
?>