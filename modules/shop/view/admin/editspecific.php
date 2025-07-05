<form action="" method="post">
    <div class="a029_header_block">
        <div class="a029_header_title">Бренд #1</div>
        <button name="save_boot" value="save" class="a029_add_button">
            Сохранить
        </button>
    </div>
    <div id="box_msg">    
        <!-- Успешно -->
        <div class="a029_toast a029_toast_success">
            <span class="a029_toast_icon">✔</span>
            <span class="a029_toast_text">Данные успешно сохранены</span>
        </div>

        <!-- Ошибка -->
        <div class="a029_toast a029_toast_error">
            <span class="a029_toast_icon">✖</span>
            <span class="a029_toast_text">Ошибка сохранения</span>
        </div>
    </div>

    <div class="a029_form_box_in_user">
        <div class="a029_form_box">
            <div class="a029_input_group">                
                <div class="a029_input_wrapper">
                    <input class="a029_input_field" type="text" name="name" placeholder="Простой текст" value="">
                    <label class="a029_input_label" for="name">Название</label>
                    <div class="a029_error_text hd">Пожалуйста, заполните это поле</div>
                </div>

                <div class="a029_input_wrapper">
                    <select class="a029_input_field_select" name="unit">
                        <option value="" disabled selected>Выберите еденицу измерения</option>
                        <option value="option1">Опция 1</option>
                        <option value="option2">Опция 2</option>
                    </select>
                    <label class="a029_input_label" for="unit">Еденица измерения</label>
                    <div class="a029_error_text hd">Пожалуйста, выберите значение</div>
                </div>
            </div>
            </div>
            <div class="a029_input_group">
                <div class="a029_checkbox_wrapper">
                    <label class="a029_checkbox_label">
                        <input type="checkbox" class="a029_checkbox_field" name="card">
                        Отображение в карточке
                    </label>
                </div>

                <div class="a029_checkbox_wrapper">
                    <label class="a029_checkbox_label">
                        <input type="checkbox" class="a029_checkbox_field" name="filter">
                        Отображение в фильтре
                    </label>
                </div>
            </div>
        </div>
    </div>
</form>


<style>
    
  /* Для textarea */
.a029_input_textarea {
    border: none;
    padding: 10px 0;
    font-size: 16px;
    background: none;
    height: 18px;
    order: 2;
    outline: none;
}

.a029_input_textarea:focus + .a006_input_label {
    color: #2F6BF2;
}

  .a029_header_block {
    margin-top: 80px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #ffffff;
    border-radius: 10px;
    padding: 15px 20px;
    margin-bottom: 20px;
  }

  .a029_header_title {
    font-size: 20px;
    font-weight: bold;
    color: #333333;
  }

  .a029_add_button {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 7px 26px;
    background: #2F6BF2;
    border-radius: 5px;
    color: #fff;
    font-size: 14px;
    border: none;
    cursor: pointer;
  }



.a029_input_group {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
    width: 100%;
}

.a029_input_wrapper {
    background-color: #fff;
    border-radius: 6px;
    border: 1px solid #E8E8ED;
    transition: all 0.3s linear;
    display: flex;
    flex-direction: column;
    padding: 10px;
    flex: 0 0 calc(50% - 32px); /* если 1 — займет 50% ширины */
    min-width: 250px; /* можно регулировать под ваш дизайн */
}

.a029_input_wrapper:hover {
    border-color: #c5c5c5;
}

.a029_input_label {
    font-size: 14px;
    font-weight: 600;
    transition: color 0.3s linear;
}

.a029_input_field {
    border: none;
    padding: 10px 0;
    font-size: 14px;
    background: none;
    order: 2;
    outline: none;
}


.a029_input_field_select {
    border: none;
    padding: 10px 0;
    font-size: 14px;
    background: none;
    order: 2;
    outline: none;
    appearance: none; /* Убираем стандартную стрелку в большинстве браузеров */
    background-image: url('data:image/svg+xml;utf8,<svg fill="%232F6BF2" height="10" viewBox="0 0 24 24" width="10" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>');
    background-repeat: no-repeat;
    background-position: right 0.5rem center;
    background-size: 20px;
    cursor: pointer;
}


.a029_input_field:focus + .a008_input_label {
    color: #2F6BF2;
}



/* Ошибочный стиль */
.a029_has_error {
  border-color: #FF4D4F;
}

.a029_has_error .a008_input_label {
  color: #FF4D4F;
}

/* Текст ошибки */
.a029_error_text {
  color: #FF4D4F;
  font-size: 12px;
  margin-top: 4px;
  line-height: 1.2;
}





.a029_toast {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 12px 16px;
  border-radius: 8px;
  font-size: 14px;
  font-weight: 500;
  width: calc(100% - 32px);
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  margin-bottom: 12px;
  animation: fadeIn 0.3s ease;
}

.a029_toast_icon {
  font-size: 18px;
}

.a029_toast_success {
  background-color: #e6f6eb;
  color: #2e7d32;
  border: 1px solid #c1e7d0;
}

.a029_toast_error {
  background-color: #fdecea;
  color: #c62828;
  border: 1px solid #f5c6c6;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}


.a029_checkbox_wrapper {    
    background-color: #fff;
    border-radius: 6px;
    border: 1px solid #E8E8ED;
    transition: all 0.3s linear;
    display: flex;
    flex-direction: column;
    padding: 10px;
    flex: 0 0 calc(50% - 32px); /* если 1 — займет 50% ширины */
    min-width: 250px; /* можно регулировать под ваш дизайн */
    justify-content: center;
}

.a029_checkbox_wrapper:hover {
    border-color: #c5c5c5;
}

.a029_checkbox_label {
    font-size: 14px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
}

.a029_checkbox_field {
    width: 16px;
    height: 16px;
    border: 1px solid #ccc;
    accent-color: #2F6BF2; /* Современный способ стилизации checkbox */
    cursor: pointer;
}

</style>