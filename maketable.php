<?php
//MSQLにてselect、fetchallで抽出した配列に対してテーブルを作成
function maketable($array)
{
    $result = '<table border = "1"><tr>';

    //thの作成
    $keys = array_keys($array[0]);
    foreach ($keys as $value) {
        $result .= '<th>' . $value . '</th>';
    }
    $result .= '</tr>';

    $result .= maketd($array);

    $result .= '</table>';

    return $result;
}

//<tr><td>の作成
//thを英語にしないときに単体で用いる。
function maketd($array)
{
    $result = null;
    //tdの作成
    foreach ($array as $value) {
        $result .= '<tr>';
        foreach ($value as $content) {
            $result .= '<td>' . $content . '</td>';
        }
        $result .= '</tr>';
    }

    return $result;
}

//詳細付きのテーブル作成
function maketable_detail($array)
{
    $add = '詳細';

    $result = '<table border = "1"><tr>';

    //thの作成
    $keys = array_keys($array[0]);
    foreach ($keys as $value) {
        $result .= '<th>' . $value . '</th>';
    }
    $result .= '<th>' . $add . '</th>';
    $result .= '</tr>';

    //詳細付き行列の作成
    //$iは呼び出し回数。行が複数表示の場合にsubmitで異なるformを呼び出す際に用いる。
    if(Count($array)>1){
    $i=0;
    }
    else{
        $i = null;
    }
    foreach ($array as $value) {
        $result .= '<tr>';
        foreach ($value as $content) {
            $result .= '<td>' . $content . '</td>';
        }

        //フォーム作成
        $addtag = '<form method = "post" name = "detail" action="detail.php">';

        //hiddenとしてname等のデータを詳細画面にポストするためのタグを追加
        foreach($value as $key => $value){
        $addtag .= '<input type="hidden" name = '.$key.' value = '.$value.'>';
        }
        //detail.phpにて送信元を分別するためのname valueの追加。
        $addtag .= '<input type="hidden" name = "detail" value = "detail">';
        //リンクにpostを埋め込む。$iを使用。
        if(isset($i)){
            $addtag .= '<a href = "javascript:document.detail['.$i.'].submit()">' . $add . '</a></form>';
            $i++;
        }else{
            $addtag .= '<a href = "javascript:document.detail.submit()">' . $add . '</a></form>';
        }
        $result .= '<td>' . $addtag . '</td>';
        $result .= '</tr>';
    }

    $result .= '</table>';

    return $result;
}
