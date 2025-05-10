// Add this JavaScript code to apply a floating effect to the text in the navigation links
document.querySelectorAll('nav a').forEach(link => {
    link.addEventListener('mouseover', () => {
        link.style.transition = 'transform 0.3s ease';
        link.style.transform = 'translateY(-5px)';
    });

    link.addEventListener('mouseout', () => {
        link.style.transition = 'transform 0.3s ease';
        link.style.transform = 'translateY(0)';
    });
});