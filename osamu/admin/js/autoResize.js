var textAreas = [...document.querySelectorAll(".auto-resize")];
textAreas.forEach(el => el.style.height = el.scrollHeight + 'px');
textAreas.forEach(el => el.addEventListener('input', autoResize, false));
function autoResize() {
    this.style.height = 'auto';
    this.style.height = this.scrollHeight + 'px';
}