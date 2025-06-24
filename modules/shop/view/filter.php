<div class="katalog_box">
    <a class="b026_mobile_filter" href="">

        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M22.0156 6.5H16.0156" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M6.01562 6.5H2.01562" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M10.0156 10C11.9486 10 13.5156 8.433 13.5156 6.5C13.5156 4.567 11.9486 3 10.0156 3C8.08263 3 6.51562 4.567 6.51562 6.5C6.51562 8.433 8.08263 10 10.0156 10Z" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M22.0156 17.5H18.0156" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M8.01562 17.5H2.01562" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M14.0156 21C15.9486 21 17.5156 19.433 17.5156 17.5C17.5156 15.567 15.9486 14 14.0156 14C12.0826 14 10.5156 15.567 10.5156 17.5C10.5156 19.433 12.0826 21 14.0156 21Z" stroke="#171717" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>                            

    </a>
    <form method="post" class="b026_filter_left">
        <div class="b026_filter_box">
            <a class="b026_closed_filter" href="">
                <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 17L16 1" stroke="#171717" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 17L1 1" stroke="#171717" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>                                
            </a>
            <div class="b026_filter_title">
                Цена, ₽
            </div>                        
            <div class="b026_range_container">
                <div class="b026_range_inputs">
                    <input type="number" id="min_input" value="99" min="0" max="1000" />
                    <div class="b026_filter_tire"></div>
                    <input type="number" id="max_input" value="35000" min="0" max="35000" />
                </div>
                <div class="b026_range_bar_container">
                    <div class="b026_range_fill" id="range_fill"></div>
                    <div class="b026_range_thumb" id="min_thumb"></div>
                    <div class="b026_range_thumb" id="max_thumb"></div>
                </div>
            </div>
        </div>
        <div class="b026_filter_box">
            <div class="b026_filter_title">
                Производитель
            </div>                        
            <div class="b026_checkbox_box">
                <div class="b026_padio_elem">
                    <input type="checkbox" id="selectAll" onclick="document.querySelectorAll('.b026_chek_e').forEach(checkbox => checkbox.checked = this.checked)">
                    <label for="selectAll">Выбрать все</label>
                </div>
                <div class="b026_padio_elem">
                    <input type="checkbox" class="b026_custom-checkbox b026_chek_e" id="Dormer" name="Dormer" value="1">
                    <label for="Dormer">Dormer</label>
                </div>
                <div class="b026_padio_elem">
                    <input type="checkbox" class="b026_custom-checkbox b026_chek_e" id="Guhring" name="Guhring" value="2">
                    <label for="Guhring">Guhring</label>
                </div>                            
                <div class="b026_padio_elem">
                    <input type="checkbox" class="b026_custom-checkbox b026_chek_e" id="Hoffmann" name="Hoffmann" value="3">
                    <label for="Hoffmann">Hoffmann</label>
                </div> 
                <div class="b026_padio_elem">
                    <input type="checkbox" class="b026_custom-checkbox b026_chek_e" id="IZAR" name="IZAR" value="4">
                    <label for="IZAR">IZAR</label>
                </div> 
                <div class="b026_padio_elem">
                    <input type="checkbox" class="b026_custom-checkbox b026_chek_e" id="Korloy" name="Korloy" value="5">
                    <label for="Korloy">Korloy</label>
                </div> 
                <div class="b026_padio_elem">
                    <input type="checkbox" class="b026_custom-checkbox b026_chek_e" id="Dormer2" name="Dormer" value="6">
                    <label for="Dormer2">Dormer2</label>
                </div> 
            </div>                        
        </div>

        <div class="b026_filter_box">
            <div class="b026_filter_title">
                Наличие
            </div>                        
            <div class="b026_radio_box">
                <div class="b026_padio_elem">
                    <input type="radio" id="option1" name="options" value="1" checked>
                    <label for="option1">Все</label>
                </div>
                <div class="b026_padio_elem">
                    <input type="radio" id="option2" name="options" value="2">
                    <label for="option2">В наличии</label>
                </div>                            
                <div class="b026_padio_elem">
                    <input type="radio" id="option3" name="options" value="3">
                    <label for="option3">Нет в наличии</label>
                </div> 
            </div>                        
        </div>

        <div class="b026_filter_box">
            <div class="b026_filter_title">
                Выходное напряжение Uвых
            </div>                        
            <div class="b026_checkbox_box">
                <div class="b026_padio_elem">
                    <input type="checkbox" id="selectAll2" onclick="document.querySelectorAll('.b026_chek_e2').forEach(checkbox => checkbox.checked = this.checked)">
                    <label for="selectAll2">Выбрать все</label>
                </div>
                <div class="b026_padio_elem">
                    <input type="checkbox" class="b026_custom-checkbox b026_chek_e2" id="22" name="" value="1">
                    <label for="22">205...235 В</label>
                </div>
                <div class="b026_padio_elem">
                    <input type="checkbox" class="b026_custom-checkbox b026_chek_e2" id="33" name="" value="2">
                    <label for="33">212...228 В</label>
                </div>                            
            </div>                        
        </div>

        <button class="b026_btn_form b026_filtre_btn">Поиск по фильтрам</button>
        <a class="b026_link_filter" href="">Сбросить все фильтры</a>
    </form>
