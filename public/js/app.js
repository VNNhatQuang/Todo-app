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



    // Confirm Delete Note
    var deleteNote = $('a#delete-note');
    deleteNote.click((e) => {
        const response = confirm('Xác nhận xóa?');
        if(response == false)
            e.preventDefault();
    })



    // AJAX



});

