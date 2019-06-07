let url = null;

$(document).ready(() => {
    //sectionを隠す
    $(".sec_hide").ready().fadeIn(500);
    fade_title(2000);

    //マウスオーバーでポインタ変更
    $("a").hover().css("cursor", "pointer");

    //リンクがクリックされたらvalue取得。valueをload。
    $(".foot_link").click(function () {
        let val = $(this).attr("value");
        url=val;
        load_section(val);
    });

    //最初にtopを読み込む
    $("section").load("title.php");

    //検索時の画面遷移
    $("section").on("click","input[name='serch']",()=>{
        let val = $('input[name="serch_name"]').val();
        let json = {
            "serch_name" : val
        };
        load_section_data(url,json);
    });

    //signup時の画面遷移
    $("section").on("click","input[name='signup']",()=>{
        let name = $('input[name="signup_name"]').val();
        let address =  $('input[name="signup_address"]').val();
        let mail = $('input[name="signup_mail"]').val();
        let json = {
            "signup" : "did",
            "signup_name" : name,
            "signup_address": address,
            "signup_mail": mail
        };
        load_section_data(url,json);
    });
}
);

function fade_title(t) {
    //???1000でなくてt/2だとループしないのはなぜか。
    $(".title").fadeOut(1000).fadeIn(1000);
    setTimeout(fade_title, t);
}

function load_section(link) {

    $("section").fadeOut(500, () => {
        $("section").load(link, () => {
            $("section").fadeIn(500);
        });
    });
}

function load_section_data(link,data) {

    $("section").fadeOut(500, () => {
        $("section").load(link,data, () => {
            $("section").fadeIn(500);
        });
    });
}