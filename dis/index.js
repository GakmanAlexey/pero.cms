const canvas = document.getElementById('myCanvas');
const ctx = canvas.getContext('2d');

// Задаём цвет фона
ctx.fillStyle = '#F0F0F0'; // Любой цвет
ctx.fillRect(0, 0, canvas.width, canvas.height);

window.addEventListener('load', () => {
  const canvas = document.getElementById('myCanvas');
  const parent = canvas.parentElement;

  canvas.width = parent.clientWidth;
  canvas.height = parent.clientHeight;

  const ctx = canvas.getContext('2d');
  ctx.fillStyle = '#F0F0F0';
  ctx.fillRect(0, 0, canvas.width, canvas.height);
});