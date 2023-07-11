<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 이미지를 얻는다
function get_image_extend_category($img, $width=0, $height=0, $img_id='')
{
    global $g5, $default;

    $full_img = G5_DATA_PATH.'/category/'.$img;

    if (file_exists($full_img) && $img)
    {
        if (!$width)
        {
            $size = getimagesize($full_img);
            $width = $size[0];
            $height = $size[1];
        }
        $str = '<img src="'.G5_DATA_URL.'/category/'.$img.'" alt="" width="'.$width.'" height="'.$height.'"';

        if($img_id)
            $str .= ' id="'.$img_id.'"';

        $str .= '>';
    }
    else
    {
        $str = '<img src="'.G5_SHOP_URL.'/img/no_image.gif" alt="" ';
        if ($width)
            $str .= 'width="'.$width.'" height="'.$height.'"';
        else
            $str .= 'width="'.$default['de_mimg_width'].'" height="'.$default['de_mimg_height'].'"';

        if($img_id)
            $str .= ' id="'.$img_id.'"'.
        $str .= '>';
    }

    return $str;
}


// 쇼핑분류 이미지를 얻는다
function get_ca_image_extend_category($ca_id, $width, $height=0, $anchor=false, $img_id='', $img_alt='', $is_crop=false)
{
    global $g5;

    if(!$ca_id || !$width)
        return '';


	$sql = " select * from {$g5['g5_shop_category_table']} where ca_id = '$ca_id' ";
	$row = sql_fetch($sql);

    if(!$row['ca_id'])
        return '';

    $filename = $thumb = $img = '';
    
    $img_width = 0;
    for($i=1;$i<=5; $i++) {
        $file = G5_DATA_PATH.'/category/'.$row['ca_img'.$i];
        if(is_file($file) && $row['ca_img'.$i]) {
            $size = @getimagesize($file);
            if(! isset($size[2]) || $size[2] < 1 || $size[2] > 3)
                continue;

            $filename = basename($file);
            $filepath = dirname($file);
            $img_width = $size[0];
            $img_height = $size[1];

            break;
        }
    }

    if($img_width && !$height) {
        $height = round(($width * $img_height) / $img_width);
    }

    if($filename) {
        //thumbnail($filename, $source_path, $target_path, $thumb_width, $thumb_height, $is_create, $is_crop=false, $crop_mode='center', $is_sharpen=true, $um_value='80/0.5/3')
        $thumb = thumbnail($filename, $filepath, $filepath, $width, $height, false, $is_crop, 'center', false, $um_value='80/0.5/3');
    }

    if($thumb) {
        $file_url = str_replace(G5_PATH, G5_URL, $filepath.'/'.$thumb);
        $img = '<img src="'.$file_url.'" width="'.$width.'" height="'.$height.'" alt="'.$img_alt.'"';
    } else {
        $img = '<img src="'.G5_SHOP_URL.'/img/no_image.gif" width="'.$width.'"';
        if($height)
            $img .= ' height="'.$height.'"';
        $img .= ' alt="'.$img_alt.'"';
    }

    if($img_id)
        $img .= ' id="'.$img_id.'"';
    $img .= '>';

    if($anchor)
        $img = $img = '<a href="'.shop_item_url($ca_id).'">'.$img.'</a>';

    return run_replace('get_ca_image_tag', $img, $thumb, $ca_id, $width, $height, $anchor, $img_id, $img_alt, $is_crop);
}

// 쇼핑분류이미지 썸네일 생성
function get_ca_thumbnail_extend_category($img, $width, $height=0, $id='', $is_crop=false)
{
    $str = '';

    if ( $replace_tag = run_replace('get_ca_thumbnail_tag', $str, $img, $width, $height, $id, $is_crop) ){
        return $replace_tag;
    }

    $file = G5_DATA_PATH.'/category/'.$img;
    if(is_file($file))
        $size = @getimagesize($file);

    if (! (isset($size) && is_array($size))) 
        return '';

    if($size[2] < 1 || $size[2] > 3)
        return '';

    $img_width = $size[0];
    $img_height = $size[1];
    $filename = basename($file);
    $filepath = dirname($file);

    if($img_width && !$height) {
        $height = round(($width * $img_height) / $img_width);
    }

    $thumb = thumbnail($filename, $filepath, $filepath, $width, $height, false, $is_crop, 'center', false, $um_value='80/0.5/3');

    if($thumb) {
        $file_url = str_replace(G5_PATH, G5_URL, $filepath.'/'.$thumb);
        $str = '<img src="'.$file_url.'" width="'.$width.'" height="'.$height.'"';
        if($id)
            $str .= ' id="'.$id.'"';
        $str .= ' alt="">';
    }

    return $str;
}


// 이미지 URL 을 얻는다.
function get_ca_imageurl_extend_category($ca_id)
{
    global $g5;

	$sql = " select * from {$g5['g5_shop_category_table']} where ca_id = '$ca_id' ";
	$row = sql_fetch($sql);
    $filepath = '';

    for($i=1; $i<=5; $i++) {
        $img = $row['ca_img'.$i];
        $file = G5_DATA_PATH.'/category/'.$img;
        if(!is_file($file))
            continue;

        $size = @getimagesize($file);
        if($size[2] < 1 || $size[2] > 3)
            continue;

        $filepath = $file;
        break;
    }

    if($filepath)
        $str = str_replace(G5_PATH, G5_URL, $filepath);
    else
        $str = G5_SHOP_URL.'/img/no_image.gif';

    return $str;
}


// 큰 이미지
function get_large_image_extend_category($img, $ca_id, $btn_image=true)
{
    global $g5;

    if (file_exists(G5_DATA_PATH.'/category/'.$img) && $img != '')
    {
        $size   = getimagesize(G5_DATA_PATH.'/category/'.$img);
        $width  = $size[0];
        $height = $size[1];
        $str = '<a href="javascript:popup_large_image(\''.$ca_id.'\', \''.$img.'\', '.$width.', '.$height.', \''.G5_SHOP_URL.'\')">';
        if ($btn_image)
            $str .= '큰이미지</a>';
    }
    else
        $str = '';
    return $str;
}



// 쇼핑분류이미지 업로드
function ca_img_upload_extend_category($srcfile, $filename, $dir)
{
    if($filename == '')
        return '';

    $size = @getimagesize($srcfile);
    if($size[2] < 1 || $size[2] > 3)
        return '';

    //php파일도 getimagesize 에서 Image Type Flag 를 속일수 있다
    if (!preg_match('/\.(gif|jpe?g|png)$/i', $filename))
        return '';

    if(!is_dir($dir)) {
        @mkdir($dir, G5_DIR_PERMISSION);
        @chmod($dir, G5_DIR_PERMISSION);
    }

    $pattern = "/[#\&\+\-%@=\/\\:;,'\"\^`~\|\!\?\*\$#<>\(\)\[\]\{\}]/";

    $filename = preg_replace("/\s+/", "", $filename);
    $filename = preg_replace( $pattern, "", $filename);

    $filename = preg_replace_callback("/[가-힣]+/", '_callback_ca_img_upload', $filename);

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

    $file = str_replace(G5_DATA_PATH.'/category/', '', $dir.'/'.$filename);

    return $file;
}

function _callback_ca_img_upload_extend_category($matches){
    return isset($matches[0]) ? base64_encode($matches[0]) : '';
}

// 쇼핑분류이미지 썸네일 삭제
function delete_ca_thumbnail_extend_category($dir, $file)
{
    if(!$dir || !$file)
        return;

    $filename = preg_replace("/\.[^\.]+$/i", "", $file); // 확장자제거

    $files = glob($dir.'/thumb-'.$filename.'*');

    if(is_array($files)) {
        foreach($files as $thumb_file) {
            @unlink($thumb_file);
        }
    }
}

function get_ca_images_info_extend_category($ca, $size=array(), $image_width=50, $image_height=40){
    
    if( !(is_array($ca) && $ca) ) return array();
    $images = array();

    for($i=1; $i<=5; $i++) {
        if(!$ca['ca_img'.$i]) continue;
        $file = G5_DATA_PATH.'/category/'.$ca['ca_img'.$i];
        if( $is_exists = run_replace('is_exists_category_file', is_file($file), $ca, $i) ){
            $thumb = get_ca_thumbnail_extend_category($ca['ca_img'.$i], $image_width, $image_height);

			preg_match_all("/<img[^>]*src=[\"']?([^>\"']+)[\"']?[^>]*>/i", $thumb, $thumb_arr);   

			$size = @getimagesize($file);
            //$attr = (isset($size[0]) && isset($size[1]) && $size[0] && $size[1]) ? 'width="'.$size[0].'" height="'.$size[1].'" ' : '';
            $imageurl = G5_DATA_URL.'/category/'.$ca['ca_img'.$i];

			$imagehtml = '&lt;img src="'.$imageurl.'" '.$attr.' alt="'.get_text($ca['ca_name']).'" id="largeimage_'.$i.'" /&gt;';
            $infos = array(
                'thumburl'=>$thumb_arr[1][0],
                'thumb'=>htmlspecialchars($thumb),
                'imageurl'=>$imageurl,
                'imagehtml'=>$imagehtml,
                );
            //$images[$i] = run_replace('get_image_by_ca', $infos, $ca, $i, $size);
			$images[$i] = $infos;
        }
    }
    return $images; 
}


// 카테고리 이미지삭제
function shop_category_file_delete_extend_category($ca_id)
{
	global $g5, $is_admin;

	$sql = " select ca_img1, ca_img2, ca_img3, ca_img4, ca_img5
				from {$g5['g5_shop_category_table']} where ca_id = '$ca_id' ";
	$it = sql_fetch($sql);

	// 카테고리 이미지 이미지 삭제
	$dir_list = array();
	for($i=1; $i<=5; $i++) {
		$file = G5_DATA_PATH.'/category/'.clean_relative_paths($it['ca_img'.$i]);
		if(is_file($file) && $it['ca_img'.$i]) {
			@unlink($file);
			$dir = dirname($file);
			delete_ca_thumbnail_extend_category($dir, basename($file));

			if(!in_array($dir, $dir_list))
				$dir_list[] = $dir;
		}
	}

	// 이미지디렉토리 삭제
	for($i=0; $i<count($dir_list); $i++) {
		if(is_dir($dir_list[$i]))
			rmdir($dir_list[$i]);
	}


	// 카테고리 이미지 삭제
	//$sql = " delete from {$g5['g5_shop_category_table']} where ca_id = '$ca_id' ";
	//sql_query($sql);
}

