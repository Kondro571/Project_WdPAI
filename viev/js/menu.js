function toggleMenu() {
    var menuList = document.querySelector('.menu-list');
    menuList.style.display = (menuList.style.display === 'flex' || menuList.style.display === '') ? 'none' : 'flex';
}

window.addEventListener('resize', function () {
    var menuList = document.querySelector('.menu-list');
    if (window.innerWidth > 700) {
        menuList.style.display = 'flex';
    } else {
        menuList.style.display = 'none';
    }
});