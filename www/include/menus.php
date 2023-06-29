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