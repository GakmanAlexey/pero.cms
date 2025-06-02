
<body>

<div class="wrapper_lmenu"></div>
<div class="menu_left">
        <div class="menu_icon">
            <div class="menu_arrow">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.53239 11.1225L12.2249 15.6975C14.2874 16.785 16.5299 14.5875 15.4874 12.5025L14.2724 10.0725C13.9349 9.39753 13.9349 8.60253 14.2724 7.92753L15.4874 5.49753C16.5299 3.41253 14.2874 1.22253 12.2249 2.30253L3.53239 6.87752C1.82239 7.77752 1.82239 10.2225 3.53239 11.1225Z" stroke="white" stroke-opacity="0.48" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg> 
            </div>
            
<?php
$url = \Modules\Router\Modul\Router::$url;
foreach(\Modules\Admin\Modul\Buildermenu::$build_lvl1 as $key => $elemet_menu){
    if(($key == 0) or ((intdiv($key, 10000)) == ($key / 10000))) {
        if($url["d_array"][1] == $elemet_menu["url"]){
            $style = "icon_item icon_item_activ";
        }else{
            $style = "icon_item ";
        }
        echo '
        <abbr data-title="'.$elemet_menu["name_ru"].'">
        <a href="/admin/'.$elemet_menu["url"].'/" class="'.$style.'">
        '.$elemet_menu["ico"].'
            </a></abbr>
        ';
    }
}
echo '
<a href="" class="icon_item user_menu">
<img src="/src/admin/img/avatar.png" alt="">
</a>
</div>
';
$num_futher = 0;
$old_pather = 0;
$bid_line_2 = "";
$bid_line_2_arr = [];
$hd_2 = "hd";
if(!isset($url ["d_array"][2])){
    $hd_2 = "";
}
$url1 = "";
$url2 = "";
$url3 = "";
foreach(\Modules\Admin\Modul\Buildermenu::$build_lvl1 as $key => $elemet_menu){
    if(($key == 0) or ((intdiv($key, 10000)) == ($key / 10000))) {
        if($bid_line_2 != ""){
            $bid_line_2_arr[] = $bid_line_2;
            $bid_line_2 = "";
        }
        $url1 = $elemet_menu["url"];
        if($key == 0){
            if(!isset($url ["d_array"][2])){
                $bid_line_2 = '
                <div class="wra_menu_twoo ">
                    <div class="menu_twoo_level_title">
                        '.$elemet_menu["name_ru"].'
                    </div>
                ';
            }else{
                if($url ["d_array"][2] == $elemet_menu["url"]){
                    $hds = "";
                }else{
                    $hds = "hd";
                }
                $bid_line_2 = '
                <div class="wra_menu_twoo '.$hds.'">
                    <div class="menu_twoo_level_title">
                        <a href="/admin/'.$url1.'/">'.$elemet_menu["name_ru"].'</a>
                    </div>
                ';
            }
        }else{
            
            if(isset($url ["d_array"][2])){
                if($url ["d_array"][2] == $elemet_menu["url"]){
                    $hds = "";
                }else{
                    $hds = "hd";
                }
            }else{
                $hds = "hd";
            }
            $bid_line_2 = '
            </div>
            <div class="wra_menu_twoo '.$hds.'">
                <div class="menu_twoo_level_title">
                <a href="/admin/'.$url1.'/">'.$elemet_menu["name_ru"].'</a>
                </div>
            ';
        }
    }else if((intdiv($key, 100)) == ($key / 100)){
        $url2 = $elemet_menu["url"];
        $bid_line_2 .= '
        <div class="menu_twoo_level_item">
            '.$elemet_menu["ico"].'
            <p class="name_menu_item"><a href="/admin/'.$url1.'/'.$url2.'/">'.$elemet_menu["name_ru"].'</a></p>
        </div>
        ';
    } else{

        $url3 = $elemet_menu["url"];
        $bid_line_2 .= '
        <div class="menu_three_level_item">
            '.$elemet_menu["ico"].'
            <p class="name_menu_item"><a href="/admin/'.$url1.'/'.$url2.'/'.$url3.'/">'.$elemet_menu["name_ru"].'</a></p>
        </div>
        ';
    }
}
$bid_line_2  .= "</div>";
$bid_line_2_arr[] = $bid_line_2;

?>

           
        <div class="menu_twoo_level">
            <?php
            foreach($bid_line_2_arr as $it){
                echo $it;
            }
            ?>            

            <div class="menu_crm_user_info">
                <div class="menu_crm_user_info_name">[ADMIN] Алексей</div>
                <div class="menu_crm_user_info_botom">
                    <a class="menu_crm_user_info_lk" href="">Личный кабинет</a>
                    <a class="exit" href=""> Выход<br></a>
                </div>
            </div>
        </div>
    </div>
</div>
    