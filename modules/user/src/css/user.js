<script>
const toggleButton = document.getElementById('togglePassword');
const passwordField = document.getElementById('passwordField');
const eyeOpen = toggleButton.querySelector('.eye_open');
const eyeClosed = toggleButton.querySelector('.eye_closed');

toggleButton.addEventListener('click', () => {
    const isHidden = passwordField.type === 'password';
    passwordField.type = isHidden ? 'text' : 'password';
    eyeOpen.style.display = isHidden ? 'inline' : 'none';
    eyeClosed.style.display = isHidden ? 'none' : 'inline';
});
</script>
