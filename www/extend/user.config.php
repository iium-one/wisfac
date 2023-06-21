<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가;

if($member['mb_id'] == "iium"){
  $is_admin = "super";
}

//참부된 파일을 지운다
function iu_file_delete ($idx , $db_table , $data_path , $file_name){
  // idx , 디비테이블명 , 파일 업로드 경로
  if ($idx) {
    @unlink(G5_DATA_PATH.$data_path.$file_name);
    $sql = " delete from {$db_table} where in_idx = '{$idx}' ";
    sql_query($sql);
   }
}

// 여러게 파일 지운다
function files_del($table ,$path){
  foreach ($_POST['file_del'] as $key => $idx_key) {
    //해당 파일을 삭제
    $sql = "SELECT * FROM $table where idx = {$idx_key} ";
    $del_file = sql_fetch($sql);
    $delete_file = G5_DATA_PATH . $path . $del_file['file_name'];
    if (file_exists($delete_file)){
      @unlink($delete_file);
    }
    $del_sql = "DELETE FROM $table where idx = {$idx_key} ";
    sql_query($del_sql);
  }
}

function shuffle2(){
  $chars_array = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
  shuffle($chars_array);
  $shuffle = implode('', $chars_array);
  return $shuffle;
}

// 파일업로드
function file_up($data_path, $table, $idx)
{
  global $_FILES;
  $wdate = date("Y-m-d H:i:s");

  $uploaddir = G5_DATA_PATH.$data_path;

  if (!empty($_FILES['file']['name'])){
    $file_name = array();
    for ($i = 0; $i < count($_FILES['file']['name']); $i++){
      if ($_FILES['file']['name']){
        $tmp_name = $_FILES['file']["tmp_name"][$i];
        $filename = get_safe_filename($tmp_name);
        $filename = abs(ip2long($_SERVER['REMOTE_ADDR'])) . '_' . substr(shuffle2(), 0, 8) . '_' . replace_filename($filename);
        $uploadfile = $uploaddir . basename($filename);
        move_uploaded_file($tmp_name, $uploadfile);
        $file_name['origin_name'][$i] = $_FILES['file']['name'][$i];
        $file_name['file_name'][$i] = $filename;

        $sql = "INSERT INTO {$table} set
                in_idx = '{$idx}'
                ,origin_name = '{$file_name['origin_name'][$i]}'
                ,file_name = '{$file_name['file_name'][$i]}'
                ,wdate = '{$wdate}' ";
        sql_query($sql);
      }
    }
  }
}

// 파일 업로드
function img_upload($srcfile, $filename, $dir, $data_table, $idx, $f_idx)
{
    global $_FILES;

    $file_info = array();
    $file_info['origin_name'] = $filename;

    if($filename == '')
        return '';

    //php파일도 getimagesize 에서 Image Type Flag 를 속일수 있다
    if (preg_match('/\.(gif|jpe?g|png)$/i', $filename)){
      $size = @getimagesize($srcfile);
      if($size[2] < 1 || $size[2] > 3){
          return '';
      }
    }


    if(!is_dir($dir)) {
        @mkdir($dir, G5_DIR_PERMISSION);
        @chmod($dir, G5_DIR_PERMISSION);
    }

    $pattern = "/[#\&\+\-%@=\/\\:;,'\"\^`~\|\!\?\*\$#<>\(\)\[\]\{\}]/";

    $filename = preg_replace("/\s+/", "", $filename);
    $filename = preg_replace( $pattern, "", $filename);

    $filename = preg_replace_callback("/[가-힣]+/", '_callback_img_upload', $filename);

    $filename = preg_replace( $pattern, "", $filename);
    $prepend = '';

    // 동일한 이름의 파일이 있으면 파일명 변경
    if(is_file($dir.'/'.$filename)) {
        for($i=0; $i<20; $i++) {
            $prepend = str_replace('.', '_', microtime(true)).'_';

            if(is_file($dir.'/'.$prepend.$filename)) {
                usleep(mt_rand(100, 10000));
                continue;
            } else {
                break;
            }
        }
    }

    $filename = $prepend.$filename;

    upload_file($srcfile, $filename, $dir);


    $file_info['file_name'] = $filename;

    $sql = "INSERT INTO {$data_table} set
            in_idx = '{$idx}'
            ,in_no = '{$f_idx}'
            ,origin_name = '{$file_info['origin_name']}'
            ,file_name = '{$file_info['file_name']}'
            ,wdate = '".G5_TIME_YMDHIS."' ";
    sql_query($sql);

    return $file_info['origin_name'];
}

function _callback_img_upload($matches){
  return isset($matches[0]) ? base64_encode($matches[0]) : '';
}

// 라우팅 하기 위해 추가
class Route {
  private $config;

  private $g5;

  private $mb;

  private $member;

  function __construct($member, $g5, $config, $mb) {
    $this->member = $member;
    $this->g5 = $g5;
    $this->config = $config;
    $this->mb = $mb;
  }

  function add($route, $file) {
    $params = [];
    $paramKey = [];
    preg_match_all("/(?<={).+?(?=})/", $route, $paramMatches);
    if (empty($paramMatches[0])) {
      $this->simpleRoute($file, $route);

      return;
    }
    foreach ($paramMatches[0] as $key) {
      $paramKey[] = $key;
    }
    if (!empty($_REQUEST['uri'])) {
      $route = preg_replace("/(^\/)|(\/$)/", "", $route);
      $reqUri = preg_replace("/(^\/)|(\/$)/", "", $_REQUEST['uri']);
    } else {
      $reqUri = "/";
    }
    $uri = explode("/", $route);
    $indexNum = [];
    foreach ($uri as $index => $param) {
      if (preg_match("/{.*}/", $param)) {
        $indexNum[] = $index;
      }
    }
    $reqUri = explode("/", $reqUri);
    foreach ($indexNum as $key => $index) {
      if (empty($reqUri[$index])) {
        return;
      }
      $params[$paramKey[$key]] = $reqUri[$index];
      $reqUri[$index] = "{.*}";
    }
    $reqUri = implode("/", $reqUri);
    $reqUri = str_replace("/", '\\/', $reqUri);
    if (preg_match("/$reqUri/", $route)) {
      $g5 = $this->g5;
      $config = $this->config;
      $mb = $this->mb;
      $member = $this->member;
      include $file;
    }
  }

  function notFound($file) {
    $g5 = $this->g5;
    $config = $this->config;
    $mb = $this->mb;
    $member = $this->member;
    include $file;
  }

  private function simpleRoute($file, $route) {
    if (!empty($_REQUEST['uri'])) {
      $route = preg_replace("/(^\/)|(\/$)/", "", $route);
      $reqUri = preg_replace("/(^\/)|(\/$)/", "", $_REQUEST['uri']);
    } else {
      $reqUri = "/";
    }
    if ($reqUri == $route) {
      $params = [];
      $g5 = $this->g5;
      $config = $this->config;
      $mb = $this->mb;
      $member = $this->member;
      include $file;
    }
  }
}


class Common_Model {
  public function set($db_input) {
    $set = "";
    end($db_input);
    $last_key = key($db_input);

    foreach ($db_input as $k => $v) {

      if ($k == $last_key) {
        $set .= $k . "= '" . $v . "'";
      } else {
        $set .= $k . "= '" . $v . "',";
      }
    }

    return $set;
  }
}

class IUD_Model extends Common_Model {
  public static function delete($table, $where) {
    $sql = "DELETE FROM {$table} {$where}";
    sql_query($sql, true);

    return $sql;
  }

  public static function insert($table, $db_input) {

    $set = Common_Model::set($db_input);
    $sql = "INSERT INTO {$table} SET {$set}";
    sql_query($sql, true);

    $idx = sql_insert_id();

    return $idx;
  }

  public static function update($table, $db_input, $where) {

    $set = Common_Model::set($db_input);
    $sql = "UPDATE {$table} SET {$set} {$where}";
    sql_query($sql, true);

  }
}

function log_write($str) {
  $log_dir = $_SERVER["DOCUMENT_ROOT"] . '/data/log';
  if (!is_dir($log_dir)) {
    mkdir($log_dir, 0777, true);
    chmod($log_dir, 0777);
  }

  $log_txt = '[' . date("Y-m-d H:i:s") . '] ';
  $log_txt .= $str;

  $file_name = date('Ymd') . ".txt";
  $log_file = fopen($log_dir . "/" . $file_name, "a");
  fwrite($log_file, $log_txt . "\r\n");
  fclose($log_file);

  //생성 한지 7일 지난 파일 삭제
  // system("find " . $log_dir . " -name '*.txt' -type f -ctime 6 -exec rm -f {} \;");
}
