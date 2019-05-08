$(document).ready(() => {
    $('#').on('click', () => {

        let registerEmail = $('#registerEmail').val();

        $.post('http://localhost:8080/Projets/Projet_5/newuser',
            {registerEmail: registerEmail}, (response) => {
                // ton code
            }, 'json');
    });
});