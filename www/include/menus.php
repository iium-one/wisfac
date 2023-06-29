<?php
include_once('./_common.php');

/*$sql = " SELECT 
          wr_id, wr_subject, wr_content, wr_datetime
          FROM {$board_name} ";
$result = sql_query($sql);

$data = array();
for($i=0; $row=sql_fetch_array($result); $i++){
  $data[] = $row;
}*/

$cate_table = G5_TABLE_PREFIX.'g5_shop_category';
$prd_table = G5_TABLE_PREFIX.'g5_shop_item';

$sql = " select * from {$cate_table} a left join {$prd_table} b on (a.ca_id=b.ca_id) where b.it_use = 1 ";

$sb_menus = [
  [
    'id' => 'introduce',
    'name' => '위스팩소개',
    'link' => '/sub/aboutus',
    'sb_2menus' => [
      [
        'id' => 'aboutus',
        'name' => '회사소개',
        'link' => '/sub/aboutus'
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
    'sb_2menus' => [
      [
        'id' => 'edge',
        'name' => 'Edge/Surface',
        'link' => '#'
      ],
      [
        'id' => 'IR',
        'name' => 'Air Pocket(IR)',
        'link' => '#'
      ],
      [
        'id' => 'other',
        'name' => 'Other',
        'link' => '#'
      ]
    ]
  ],
  [
    'id' => 'cs',
    'name' => '고객지원',
    'link' => '/sub/contact',
    'sb_2menus' => [
      [
        'id' => 'inquiry',
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
?>