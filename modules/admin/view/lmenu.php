
<body>
<div class="a001_wrapper_lmenu"></div>
<div class="a001_lmenu">        
        <div class="a001_lmenu_icon">
        <div class="a001_lmenu_logo">
            <img class="a001_lmenu_logo_img" src="/modules/admin/src/img/pero.svg" alt="">
        </div>           
            
<?php
$url = \Modules\Router\Modul\Router::$url;
foreach(\Modules\Admin\Modul\Buildermenu::$build_lvl1 as $key => $elemet_menu){
    if(($key == 0) or ((intdiv($key, 10000)) == ($key / 10000))) {
        if($url["d_array"][1] == $elemet_menu["url"]){
            $style = "a001_icon_item a001_icon_item_activ";
        }else{
            $style = "a001_icon_item ";
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
<a href="" class="a001_icon_item a001_user_menu">
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
                <div class="a001_wrap_menu_two ">
                    <div class="a001_menu_two_level_title">
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
                <div class="a001_wrap_menu_two '.$hds.'">
                    <div class="a001_menu_two_level_title">
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
            <div class="a001_wrap_menu_two '.$hds.'">
                <div class="a001_menu_two_level_title">
                <a href="/admin/'.$url1.'/">'.$elemet_menu["name_ru"].'</a>
                </div>
            ';
        }
    }else if((intdiv($key, 100)) == ($key / 100)){
        $url2 = $elemet_menu["url"];
        $bid_line_2 .= '
        <div class="a001_menu_two_level_item">
            '.$elemet_menu["ico"].'
            <p class="a001_name_menu_item"><a href="/admin/'.$url1.'/'.$url2.'/">'.$elemet_menu["name_ru"].'</a></p>
        </div>
        ';
    } else{

        $url3 = $elemet_menu["url"];
        $bid_line_2 .= '
        <div class="a001_menu_three_level_item">
            '.$elemet_menu["ico"].'
            <p class="a001_name_menu_item"><a href="/admin/'.$url1.'/'.$url2.'/'.$url3.'/">'.$elemet_menu["name_ru"].'</a></p>
        </div>
        ';
    }
}
$bid_line_2  .= "</div>";
$bid_line_2_arr[] = $bid_line_2;

?>

           
        <div class="a001_menu_two_level">
            <?php
            foreach($bid_line_2_arr as $it){
                echo $it;
            }
            ?>            

            <div class="a001_menu_crm_user_info">
                <div class="a001_menu_crm_user_info_name"><?php echo $this->group->get_prefix() ." ";
        echo $this->user->get_username();?></div>
                <div class="a001_menu_crm_user_info_botom">
                    <a class="a001_menu_crm_user_info_lk" href="">Личный кабинет</a>
                    <a class="a001_exit" href="/user/exit/"> Выход<br></a>
                </div>
            </div>
        </div>
    </div>
</div>
    