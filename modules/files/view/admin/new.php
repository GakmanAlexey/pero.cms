<form class="a012_form" id="a012_upload_form" enctype="multipart/form-data" action="/admin/site/files/new/" method="post">
<div class="a012_header_block">
    <div class="a012_header_title">Новый файл</div>
    <button  class="a012_add_button">
        Отправить всё
    </button>
</div>
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
      </div>
    </div>
  </div>

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
    <tbody class="a012_tbody" id="a012_tbody">
      <!-- Файлы будут сюда вставляться -->
    </tbody>
  </table>
</div>
</form>
<?php
if($this->view_data != []){
    echo '
    <h1>Результат загрузки</h1>
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
              <tbody class="a012_tbody" id="a012_tbody">';
    foreach($this->view_data as $file){

    $relativePath = str_replace(APP_ROOT, '', $file->get_path());
      echo '<tr>
      <td class="a012_td a012_td_id">'.$file->get_id().'</td>
      <td class="a012_th a012_td_prev"><img class="a012_td_prev_img" src="'.$relativePath.'" alt=""></th>
      <td class="a012_td a012_td_path">'.$file->get_name().'</td>
      <td class="a012_td a012_td_type">'.$file->get_type().'</td>
      <td class="a012_td a012_td_size">'.$file->get_size().'b</td>
      <td class="a012_td a012_td_status" style="color: #888;">Загружен</td></tr>';
    };
    echo '
    </tbody>
  </table>
</div>';
}
?>

<script>
  const fileTypeIcons = {
  'application/pdf': '/icons/pdf.svg',
  'application/msword': '/icons/doc.svg',
  'application/vnd.openxmlformats-officedocument.wordprocessingml.document': '/icons/docx.svg',
  'application/vnd.ms-excel': '/icons/xls.svg',
  'application/zip': '/icons/zip.svg',
  'default': '/icons/file.svg',
};

document.addEventListener('DOMContentLoaded', () => {
  const dropZone = document.getElementById('a012_drop_zone');
  const input = document.getElementById('a012_file_input');
  const tableBody = document.getElementById('a012_tbody');

  // Цвет фона при перетаскивании
  dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.classList.add('dragover');
  });

  dropZone.addEventListener('dragleave', () => {
    dropZone.classList.remove('dragover');
  });

  dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.classList.remove('dragover');
    const newFiles = e.dataTransfer.files;
    const dataTransfer = new DataTransfer();

    for (let i = 0; i < input.files.length; i++) {
      dataTransfer.items.add(input.files[i]);
    }
    for (let i = 0; i < newFiles.length; i++) {
      dataTransfer.items.add(newFiles[i]);
    }

    input.files = dataTransfer.files;
    updateTable(); // обновляем таблицу
  });

  input.addEventListener('change', updateTable);

  function updateTable() {
  tableBody.innerHTML = '';
  const files = input.files;

  Array.from(files).forEach((file, index) => {
    const tr = document.createElement('tr');
    tr.className = 'a012_tr_body';

    // Превью по типу
    let previewHTML = '';
    if (file.type.startsWith('image/')) {
      previewHTML = `<img class="a012_td_prev_img" src="${URL.createObjectURL(file)}" alt="">`;
    } else {
      const iconSrc = fileTypeIcons[file.type] || fileTypeIcons['default'];
      previewHTML = `<img class="a012_td_prev_img" src="${iconSrc}" alt="">`;
    }

    tr.innerHTML = `
      <td class="a012_td a012_td_id">${index + 1}</td>
      <th class="a012_th a012_td_prev">${previewHTML}</th>
      <td class="a012_td a012_td_path">${file.name}</td>
      <td class="a012_td a012_td_type">${file.type || 'N/A'}</td>
      <td class="a012_td a012_td_size">${(file.size / 1024 / 1024).toFixed(2)} MB</td>
      <td class="a012_td a012_td_status" style="color: #888;">Ожидает загрузки</td>
    `;
    tableBody.appendChild(tr);
  });
}

  
});
</script>
