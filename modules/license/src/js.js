
document.addEventListener('DOMContentLoaded', function() {
  const popup = document.getElementById('cookie-consent-popup');
  const acceptBtn = document.getElementById('accept-cookies');
  const declineBtn = document.getElementById('decline-cookies');
  
  // Проверяем, есть ли уже куки
  if (!document.cookie.includes('cookie_consent=')) {
    popup.style.display = 'block';
  }

  // Обработка принятия
  acceptBtn.addEventListener('click', function() {
    // Устанавливаем куки на 1 год
    const date = new Date();
    date.setFullYear(date.getFullYear() + 1);
    document.cookie = `cookie_consent=true; expires=${date.toUTCString()}; path=/`;
    popup.style.display = 'none';
    
    // Здесь можно добавить загрузку аналитических скриптов
    console.log('Cookies accepted');
  });

  // Обработка отказа
  declineBtn.addEventListener('click', function() {
    // Устанавливаем куки на 1 день (чтобы не показывать постоянно)
    const date = new Date();
    date.setDate(date.getDate() + 1);
    document.cookie = `cookie_consent=false; expires=${date.toUTCString()}; path=/`;
    popup.style.display = 'none';
  });
});