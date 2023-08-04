<?php
include_once('./_common.php');

$sb_menus = [
  [
    'id' => 'introduce',
    'name' => '介绍WISFAC',
    'link' => '/chi/sub/aboutus?v=vision',
    'sb_2menus' => [
      [
        'id' => 'aboutus',
        'name' => '介绍公司',
        'link' => '/chi/sub/aboutus?v=vision',
        'sb_3menus' => [
          [
            'id' => 'vision',
            'name' => '前途',
            'link' => '/chi/sub/aboutus?v=vision'
          ],
          [
            'id' => 'organization',
            'name' => '组织图',
            'link' => '/chi/sub/aboutus?v=organization'
          ]
        ]
      ],
      [
        'id' => 'business',
        'name' => '介绍行业',
        'link' => '/chi/sub/business'
      ],
      [
        'id' => 'greeting',
        'name' => 'CEO致辞',
        'link' => '/chi/sub/greeting'
      ],
      [
        'id' => 'global',
        'name' => '全球网络',
        'link' => '/chi/sub/global'
      ],
      [
        'id' => 'location',
        'name' => '访问办法',
        'link' => '/chi/sub/location'
      ]
    ]
  ],
  [
    'id' => 'product',
    'name' => '介绍制品',
    'link' => '/chi/sub/prod_category',
    'sb_2menus' => []
  ],
  [
    'id' => 'cs',
    'name' => '客户服务',
    'link' => '/chi/sub/contact',
    'sb_2menus' => [
      [
        'id' => 'contact',
        'name' => '询问',
        'link' => '/chi/sub/contact'
      ],
      [
        'id' => 'news',
        'name' => '公司消息',
        'link' => '/news_chi'
      ],
      [
        'id' => 'notice',
        'name' => '公告事项',
        'link' => '/notice_chi'
      ]
    ]
  ],
  [
    'id' => 'employ',
    'name' => '招聘人才',
    'link' => '/chi/sub/announce',
    'sb_2menus' => [
      [
        'id' => 'announce',
        'name' => '招聘指南',
        'link' => '/chi/sub/announce'
      ],
      [
        'id' => 'welfare',
        'name' => '人事、福利制度',
        'link' => '/chi/sub/welfare'
      ]
    ]
  ]
];

//제품 카테고리 DB 데이터 가져오기 + 메뉴 배열에 할당
$cate_table = G5_TABLE_PREFIX.'shop_category';
$cate_lang = 'CHI';
$prd_table = G5_TABLE_PREFIX.'shop_item';
$prd_cate_sql = " select ca_id, ca_1_subj from {$cate_table} where ca_lang = '{$cate_lang}' ";
$prd_cate_result = sql_query($prd_cate_sql);
$prd_cate = array();
for($i=0; $prd_cate_row=sql_fetch_array($prd_cate_result); $i++){
  $sb_menus[1]['sb_2menus'][] = [
    'id' => $prd_cate_row['ca_id'],
    'name' => $prd_cate_row['ca_1_subj'],
    'link' => '/chi/sub/prod_list/'.$prd_cate_row['ca_id'],
  ];

  $prd_item_sql = " select it_id, it_name from {$prd_table} where ca_id = '{$prd_cate_row['ca_id']}' and it_use=1 ";
  $prd_item_result = sql_query($prd_item_sql);
  $prd_item = array();
  for($k=0; $prd_item_row=sql_fetch_array($prd_item_result); $k++){
    $sb_menus[1]['sb_2menus'][$i]['sb_3menus'][] = [
      'id' => $prd_item_row['it_id'],
      'name' => $prd_item_row['it_name'],
      'link' => '/chi/sub/prod_view/'.$prd_item_row['it_id'],
    ];
  }
}
?>