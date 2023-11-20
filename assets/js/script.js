function myFunction() {
    var containerMenu = document.querySelector('.container-menu-xs');
    containerMenu.style.display = (containerMenu.style.display === 'block') ? 'none' : 'block';
}

var cmxClose = document.querySelector('.cmx-close');
cmxClose.addEventListener('click', function() {
    var containerMenu = document.querySelector('.container-menu-xs');
    containerMenu.style.display = 'none';
});