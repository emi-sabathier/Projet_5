$(document).ready(() => {
    $('.report-comment').on('click', (e) => {
        let idComment = $(e.target).attr('data-id');
        $.post(baseUrl + '/reportcomment', {commentId: idComment}, (response) => {
            if (response === 'success') {
                const divElt = $('<div id="report-popup">').appendTo('#comments');
                divElt.css(
                    {
                        "position": "absolute",
                        "top": "50%",
                        "padding": "1rem",
                        "font-weight": "bold",
                        "text-align": "center",
                        "left": "40%",
                        "background-color" : "#fff",
                        "border" : "2px solid #000"
                    });
                divElt.text('Signalement envoyé');
                setTimeout(()=>{
                    $('#report-popup').remove();
                }, 2000);
            } else {
                alert('Une erreur est survenue');
            }
        }, 'JSON');
    });

});