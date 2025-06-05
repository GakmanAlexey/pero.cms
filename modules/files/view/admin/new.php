<?php
var_dump($_FILES); 
?>
<div class="a012_header_block">
    <div class="a012_header_title">Новый файл</div>
    <a href="" class="a012_add_button">
        <svg class="a012_add_icon" viewBox="0 0 24 24">
        <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"/>
        </svg>
        Добавить файл
    </a>
</div>
<form class="a012_form" id="a012_upload_form" enctype="multipart/form-data" action="/admin/site/files/new/">
  <div class="a012_upload_wrapper" id="a012_drop_zone">
    <div class="a012_upload_content">
      <!-- ИКОНКИ -->
      <div class="a012_upload_icon_wrapper">
        <div class="a012_upload_icon a012_icon_main">
          <!-- SVG-иконка -->
          <!-- ... вставьте ваш SVG сюда ... -->
        </div>
        <div class="a012_upload_icon a012_icon_side a012_icon_left">
          <!-- левая иконка -->
        </div>
        <div class="a012_upload_icon a012_icon_side a012_icon_right">
          <!-- правая иконка -->
        </div>
      </div>

      <!-- Текст-инструкция -->
      <div class="a012_upload_text_block">
        <div class="a012_upload_heading">Перетащите файл сюда</div>
        <div class="a012_upload_subtext">или нажмите на кнопку</div>
      </div>

      <!-- Кнопки -->
      <div class="a012_upload_buttons">
       <label class="a012_btn_choose">
            <input type="file" name="files[]" id="a012_file_input" class="a012_input_file" multiple hidden>
            Выбрать файл
        </label>

<div id="file_names_display" style="margin-top: 10px; font-style: italic; color: #666;">
  
</div>
        <button type="submit" class="a012_btn_upload">Загрузить</button>
      </div>
    </div>
  </div>

  <!-- Таблица с файлами -->
  <div class="a012_table_wrapper">
    <table class="a012_table">
      <thead class="a012_thead">
        <tr class="a012_tr_header">
          <th class="a012_th a012_td_id">ID</th>
          <th class="a012_th a012_td_prev">Превью</th>
          <th class="a012_th a012_td_path">Путь</th>
          <th class="a012_th a012_td_type">Тип</th>
          <th class="a012_th a012_td_size">Размер</th>
          <th class="a012_th a012_td_status" style="text-align: right;">Статус</th>
        </tr>
      </thead>
      <tbody class="a012_tbody">
        <!-- Здесь будут появляться строки файлов -->
      </tbody>
    </table>
  </div>
</form>

<script>
</script>