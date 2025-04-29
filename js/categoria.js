function toggleCategory(header) {
    const arrow = header;
    const content = header.nextElementSibling;
    
    if (content.style.maxHeight && content.style.maxHeight !== '0px') {
        // Cerrar con animación
        content.style.maxHeight = '0';
        arrow.classList.remove('rotated');
        
        // Resetear después de la animación
        setTimeout(() => {
            content.removeAttribute('style');
        }, 500); // Debe coincidir con la duración de la transición CSS
    } else {
        // Abrir con animación
        content.style.maxHeight = '0';
        // Forzar el cálculo del height inicial
        setTimeout(() => {
            content.style.maxHeight = content.scrollHeight + 'px';
            arrow.classList.add('rotated');
        }, 10);
    }
}

// Inicializar elementos abiertos por defecto
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.arrow.rotated').forEach(arrow => {
        const content = arrow.nextElementSibling;
        content.style.maxHeight = content.scrollHeight + 'px';
    });
});