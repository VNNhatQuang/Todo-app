$(document).ready(() => {

    // Close and Open User Navigation
    const rowHeaderMain = $('.row');
    const user = $('#user');
    const userNav = $('#user-nav');
    user.click(() => {
        userNav.toggle();
    });
    rowHeaderMain.click(() => {
        userNav.css('display', 'none');
    });


    // AJAX



});

