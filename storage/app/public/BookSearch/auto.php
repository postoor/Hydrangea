<?php
//Version: V0.1
//function: 從博客來利用ISBN取得書籍資料
function getBookInfo($ISBN){
    require 'phpWebCralwer/LIB_parse.php';

    //取得博客來網頁資料
    $url = 'http://search.books.com.tw/search/query/key/' . $ISBN . '/cat/BKA';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $HTML = curl_exec($curl);

    //分出書籍資料部份
    $temp = return_between($HTML, '<form class="result" id="searchlist">', '</form>', '');
    $result[] = array();

    //分類
    $item = return_between($temp, '<li class="item">', '</li>', '');
    $result['Book_name'] = trim(strip_tags(return_between($item, '<h3>', '</h3>', '')));
    $result['Language'] = trim(strip_tags(return_between($item, '<span class="cat">', '</span>', '')));
    $result['author'] = trim(strip_tags(return_between($item, '<a rel="go_author"', '</a>', '')));
    $result['publish'] = trim(strip_tags(return_between($item, '<a target="_blank" rel="mid_publish"', '</a>', '')));
    $Books_price = trim(strip_tags(return_between($item, '<strong>', '</strong>', '')));
    $Ch_char[0] = '/([\x80-\xff]*)/i';
    $Ch_char[1] = '/[\(\)]/';
    $value = explode(' ', preg_replace($Ch_char,'',$Books_price));
    if($value[0] < 10){
        $value[0] *= 10;
    }

    if($value[1]){
        $raw_price = floor($value[1] / ($value[0] / 100));
    }else{
        $raw_price = $value[0] . ", $value[1]";
    }
    $result['books_price'] = $Books_price;
    $result['raw_price'] = $raw_price;
    if(! $result){
        echo $HTML;
    }
    curl_close($curl);


    if($result){
        $return_data = array('isbn' => $ISBN,
                             'title' => $result['Book_name'],
                             'author' => $result['author'],
                             'press' => $result['publish']);
        return $return_data;
    }else{
            return ['error' => 'Not find.'];
    }
}