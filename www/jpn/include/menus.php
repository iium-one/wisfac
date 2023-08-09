<?php
include_once('./_common.php');

$sb_menus = [
  [
    'id' => 'introduce',
    'name' => 'ウィスファクについて',
    'link' => '/jpn/sub/aboutus?v=vision',
    'sb_2menus' => [
      [
        'id' => 'aboutus',
        'name' => '会社紹介',
        'link' => '/jpn/sub/aboutus?v=vision',
        'sb_3menus' => [
          [
            'id' => 'vision',
            'name' => 'ビジョン',
            'link' => '/jpn/sub/aboutus?v=vision'
          ],
          [
            'id' => 'organization',
            'name' => '組織図',
            'link' => '/jpn/sub/aboutus?v=organization'
          ]
        ]
      ],
      [
        'id' => 'business',
        'name' => '事業紹介',
        'link' => '/jpn/sub/business'
      ],
      [
        'id' => 'greeting',
        'name' => 'CEOメッセージ',
        'link' => '/jpn/sub/greeting'
      ],
      [
        'id' => 'global',
        'name' => 'グローバルネットワーク',
        'link' => '/jpn/sub/global'
      ],
      [
        'id' => 'location',
        'name' => 'アクセス',
        'link' => '/jpn/sub/location'
      ]
    ]
  ],
  [
    'id' => 'product',
    'name' => '製品紹介',
    'link' => '/jpn/sub/prod_category',
    'sb_2menus' => []
  ],
  [
    'id' => 'cs',
    'name' => 'お客様サポート',
    'link' => '/jpn/sub/contact',
    'sb_2menus' => [
      [
        'id' => 'contact',
        'name' => 'お問い合わせ',
        'link' => '/jpn/sub/contact'
      ],
      [
        'id' => 'news',
        'name' => '最新情報',
        'link' => '/news_jpn'
      ],
      [
        'id' => 'notice',
        'name' => 'お知らせ',
        'link' => '/notice_jpn'
      ]
    ]
  ],
  [
    'id' => 'employ',
    'name' => '人材採用',
    'link' => '/jpn/sub/announce',
    'sb_2menus' => [
      [
        'id' => 'announce',
        'name' => '採用情報',
        'link' => '/jpn/sub/announce'
      ],
      [
        'id' => 'welfare',
        'name' => '人事制度/福利厚生',
        'link' => '/jpn/sub/welfare'
      ]
    ]
  ]
];

//제품 카테고리 DB 데이터 가져오기 + 메뉴 배열에 할당
$cate_table = G5_TABLE_PREFIX.'shop_category';
$cate_lang = 'JPN';
$prd_table = G5_TABLE_PREFIX.'shop_item';
$prd_cate_sql = " select ca_id, ca_1_subj from {$cate_table} where ca_lang = '{$cate_lang}' ";
$prd_cate_result = sql_query($prd_cate_sql);
$prd_cate = array();
for($i=0; $prd_cate_row=sql_fetch_array($prd_cate_result); $i++){
  $sb_menus[1]['sb_2menus'][] = [
    'id' => $prd_cate_row['ca_id'],
    'name' => $prd_cate_row['ca_1_subj'],
    'link' => '/jpn/sub/prod_list/'.$prd_cate_row['ca_id'],
  ];

  $prd_item_sql = " select it_id, it_name from {$prd_table} where ca_id = '{$prd_cate_row['ca_id']}' and it_use=1 ";
  $prd_item_result = sql_query($prd_item_sql);
  $prd_item = array();
  for($k=0; $prd_item_row=sql_fetch_array($prd_item_result); $k++){
    $sb_menus[1]['sb_2menus'][$i]['sb_3menus'][] = [
      'id' => $prd_item_row['it_id'],
      'name' => $prd_item_row['it_name'],
      'link' => '/jpn/sub/prod_view/'.$prd_item_row['it_id'],
    ];
  }
}
?>