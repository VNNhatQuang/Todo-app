import './bootstrap';

$(document).ready(() => {

    // Toggle Navigation (Mobile and Tablet mode)
    const menu = $('#menu');
    const nav = $('nav');
    menu.click(() => {
        nav.toggleClass('show-nav');
    })
    const main = $('main');
    main.click(() => {
        nav.removeClass('show-nav');
    })


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


    // Complete submit Form
    var checkComplete = document.querySelectorAll("form.notes input[type='checkbox']");
    var notes = document.querySelectorAll("form.notes");
    var checkCompleteNoteArray = [];
    if(checkComplete.length === notes.length) {
        for (let index = 0; index < checkComplete.length; index++) {
            const check = checkComplete[index];
            const form = notes[index];
            checkCompleteNoteArray.push({check, form});
        }
    }
    checkCompleteNoteArray.forEach(element => {
        element.check.addEventListener('click', () => {
            element.form.submit();
        })
    });


    // Confirm Delete Note
    var deleteNote = $('a.delete-note');
    deleteNote.click((e) => {
        const response = confirm('Xác nhận xóa?');
        if (response == false)
            e.preventDefault();
    })


    // Open Form Edit Note
    // Create Associative Array
    var editNoteButton = document.querySelectorAll('.edit-note');
    var editNoteForm = document.querySelectorAll('section.note.note-edit-input');
    var editNoteArray = [];
    if (editNoteButton.length === editNoteForm.length) {
        for (let index = 0; index < editNoteButton.length; index++) {
            const editButton = editNoteButton[index];
            const editForm = editNoteForm[index];
            const note = notes[index]
            editNoteArray.push({ editButton, editForm, note });
        }
    }
    // Each Associative Array and add event click
    editNoteArray.forEach(element => {
        element.editButton.addEventListener('click', function () {
            element.editForm.style.display = "flex";
            element.editForm.autofocus = "autofocus";
            element.note.style.display = "none";
            console.log(form);
        });
    });


    // Preview image in User
    const imageInput = document.getElementById('image-input');
    const previewImage = document.getElementById('preview-image');

    imageInput.addEventListener('change', function(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        previewImage.src = e.target.result;
    };

    reader.readAsDataURL(file);
    });


    // AJAX




});

