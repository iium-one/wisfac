Theme Name: 베이직
Theme URI: http://theme.sir.kr/gnuboard5/demo/basic
Maker: SIR
Maker URI: http://sir.kr
Version: 3.0.0
Detail: 베이직 테마는  SIR에서 제공하는 그누보드5 테마입니다. 베이직 테마는 웹표준 및 접근성을 준수합니다.
License: GNU LESSER GENERAL PUBLIC LICENSE Version 2.1
License URI: http://www.gnu.org/licenses/old-licenses/lgpl-2.1.html

ㅡㅡㅡㅡㅡㅡㅡㅡㅡ
|              |
|  작업 가이드  |
|              |
ㅡㅡㅡㅡㅡㅡㅡㅡㅡ

#기본 파일 
※기본 그누보드 사용할 경우 (기본형)
-> Header: /theme/basic/head.php
-> Footer: /theme/basic/tail.php
-> Main: /theme/basic/index.php
-> Sub: /sub/파일명.php (특정 영단어 소문자로 파일명 작성, 구분 기호는 _만 사용)
※쇼핑몰로 사용할 경우 (쇼핑몰형)
  */theme/basic/theme.config.php 파일에서 아래 코드 변경
  if(! defined('G5_COMMUNITY_USE')) define('G5_COMMUNITY_USE', true); => true를 false로 변경
-> Header: /theme/basic/shop/shop.head.php
-> Footer: /theme/basic/shop/shop.tail.php
-> Main: /theme/basic/shop/index.php
-> Sub: 기본형과 동일


#검색 메타태그 (*주석 해제 후 홈페이지 정보에 맞게 변경)
-> /theme/basic/head.sub.php (주석검색: 검색 메타태그) 

#JS, CSS 파일 연결 (<head>태그 내 적용)
-> JS: /theme/basic/head.sub.php (주석검색: JS 파일 연결)
-> CSS: /theme/basic/head.sub.php (주석검색: CSS 파일 연결)

#Font 설정
-> 폰트 파일 업로드 경로: /source/css/fonts
-> 폰트 파일 연결 CSS : /source/css/fonts.css
-> 기본 font-family 설정 : /source/css/common.css

#css 기본세팅 파일 경로
-> /source/css/common.css

#사용자 작성 CSS 파일 경로
-> PC: /source/css/normal.css
-> 반응형: /source/css/responsive.css

#사용자 작성 JS 파일 경로
-> /source/js/normal.js

#플러그인, 라이브러리 파일 연결
-> 업로드 경로: /source/plugin/플러그인 폴더 생성/플러그인별 폴더 생성 후 해당 폴더 내 관련 파일 업로드
-> 업로드 후 파일 불러오기는 '#JS, CSS 파일 연결 (<head>태그 내 적용)' 참고

#Q&A게시판 메일발송 설정(최고관리자에게만 발송)
-> 회원관리 > 최고관리자(admin) 메일 주소로 발송됨
-> 기본환경설정 > 글작성메일: 최고솬리자 사용 체크
-> 게시판관리 > 해당 게시판 수정모드 > 기능설정: 메일발송 사용 체크
-> 스팸메일함으로 수신될 수 있음

#서브페이지 공통 레이아웃(상단 비주얼)
-> /include/sub_visual.php (function 선언)
-> 서브페이지 소스 상단에 아래 연결 코드 추가
   include_once(G5_PATH.'/include/sub_visual.php');
-> 서브 비주얼 영역에 아래 실행 코드 추가
   <?php sub_visual('구분값'); ?>

#서브페이지 공통 레이아웃(상단 로케이션 메뉴)
-> /include/sub_location.php (function 선언)
-> 서브페이지 소스 상단에 아래 연결 코드 추가
   include_once(G5_PATH.'/include/sub_location.php');
-> 서브 비주얼 영역에 아래 실행 코드 추가
   <?php sub_location('구분값1','구분값2'); ?>