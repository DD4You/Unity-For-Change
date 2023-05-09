function isMobile() {
    return window.innerWidth <= 992;
}

function isDesktop() {
    return window.innerWidth > 992;
}

function isPortrait() {
    return screen.orientation.type === 'portrait-primary';
}

function isMobileResponsive() {
    return isPortrait() ? window.innerWidth <= 768 : window.innerWidth <= 992;
}

// window.addEventListener('resize', function () {
//     console.log('isMobile', isMobile());
//     console.log('isDesktop', isDesktop());
//     console.log('isPortrait', isPortrait());
//     console.log('isMobileResponsive', isMobileResponsive());
// });