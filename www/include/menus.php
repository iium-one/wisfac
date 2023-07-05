<?php
include_once('./_common.php');

$sb_menus = [
  [
    'id' => 'introduce',
    'name' => '위스팩소개',
    'link' => '/sub/aboutus',
    'sb_2menus' => [
      [
        'id' => 'aboutus',
        'name' => '회사소개',
        'link' => '/sub/aboutus?v=vision',
        'sb_3menus' => [
          [
            'id' => 'vision',
            'name' => '비전',
            'link' => '/sub/aboutus?v=vision'
          ],
          [
            'id' => 'organization',
            'name' => '조직도',
            'link' => '/sub/aboutus?v=organization'
          ]
        ]
      ],
      [
        'id' => 'business',
        'name' => '사업소개',
        'link' => '/sub/business'
      ],
      [
        'id' => 'greeting',
        'name' => 'CEO인사말',
        'link' => '/sub/greeting'
      ],
      [
        'id' => 'global',
        'name' => '글로벌 네트워크',
        'link' => '/sub/global'
      ],
      [
        'id' => 'location',
        'name' => '오시는 길',
        'link' => '/sub/location'
      ]
    ]
  ],
  [
    'id' => 'product',
    'name' => '제품소개',
    'link' => '#',
    'sb_2menus' => []
  ],
  [
    'id' => 'cs',
    'name' => '고객지원',
    'link' => '/sub/contact',
    'sb_2menus' => [
      [
        'id' => 'contact',
        'name' => '문의하기',
        'link' => '/sub/contact'
      ],
      [
        'id' => 'news',
        'name' => '회사소식',
        'link' => '/news'
      ],
      [
        'id' => 'notice',
        'name' => '공지사항',
        'link' => '/notice'
      ]
    ]
  ],
  [
    'id' => 'employ',
    'name' => '인재채용',
    'link' => '/sub/announce',
    'sb_2menus' => [
      [
        'id' => 'announce',
        'name' => '채용안내',
        'link' => '/sub/announce'
      ],
      [
        'id' => 'welfare',
        'name' => '인사/복지재도',
        'link' => '/sub/welfare'
      ]
    ]
  ]
];

//제품 카테고리 DB 데이터 가져오기 + 메뉴 배열에 할당
$cate_table = G5_TABLE_PREFIX.'shop_category';
$prd_table = G5_TABLE_PREFIX.'shop_item';
$prd_cate_sql = " select ca_id, ca_name from {$cate_table} ";
$prd_cate_result = sql_query($prd_cate_sql);
$prd_cate = array();
for($i=0; $prd_cate_row=sql_fetch_array($prd_cate_result); $i++){
  $sb_menus[1]['sb_2menus'][] = [
    'id' => $prd_cate_row['ca_id'],
    'name' => $prd_cate_row['ca_name'],
    'link' => '#',
  ];

  $prd_item_sql = " select it_id, it_name from {$prd_table} where ca_id = '{$prd_cate_row['ca_id']}' ";
  $prd_item_result = sql_query($prd_item_sql);
  $prd_item = array();
  for($k=0; $prd_item_row=sql_fetch_array($prd_item_result); $k++){
    $sb_menus[1]['sb_2menus'][$i]['sb_3menus'][] = [
      'id' => $prd_item_row['it_id'],
      'name' => $prd_item_row['it_name'],
      'link' => '#',
    ];
  }
}
?>