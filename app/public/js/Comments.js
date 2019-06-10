class Comments {
    /**
     * @param baseurl URL du projet
     */
    constructor(baseurl) {
        this.baseUrl = baseurl;
        $('.report-comment').on('click', this.reportComment.bind(this));
        $('.post-comment').on('click', this.postComment.bind(this));
    }

    /**
     * @param e Event object
     */
    reportComment(e) {
        let idComment = $(e.target).attr('data-id');
        $.post(this.baseUrl + '/reportcomment', {commentId: idComment}, (response) => {
            if (response === 'success') {
                const divElt = $('<div id="report-popup" class="alert alert-success">').appendTo('#comments');
                divElt.css(
                    {
                        "position": "absolute",
                        "top": "50%",
                        "padding": "3rem 1rem",
                        "font-weight": "bold",
                        "text-align": "center",
                        "left": "40%"
                    });
                divElt.text('Signalement envoyé');
                setTimeout(() => {
                    $('#report-popup').remove();
                }, 2000);
            } else {
                console.log('Une erreur est survenue');
            }
        }, 'JSON');
    }

    /**
     * @param e Event object
     */
    postComment(e) {
        e.preventDefault();
        let id = $('.post-comment').attr('data-id');
        let commentVal = $('textarea#comment').val();
        $('<div id="message-comment">').appendTo('#comment-form');

        if (commentVal === '') {
            $('#message-comment').text('Votre message est vide');
        } else if (commentVal.trim() === '') {
            $('#message-comment').text('Votre commentaire ne contient que des espaces vides');
        } else {
            $.post(this.baseUrl + '/postcomment', {recipeId: id, comment: commentVal}, (response) => {

                if (response.status === 'success') {
                    $('textarea#comment').val('');
                    $('section#comments').prepend([
                        $('<div>', {'data-id': response.comment.commentId}).append([
                            $('<strong>').text(response.comment.nickname),
                            $('<span>').text(' Le ' + response.comment.date + ' '),
                            $('<button>', {
                                'data-id': response.comment.commentId,
                                'class': 'report-comment btn btn-danger p-1',
                                'text': 'Signaler'
                            }).on('click', this.reportComment.bind(this)),
                            $('<p>').text(response.comment.content)
                        ])
                    ]);

                    $('#message-comment').text('Message envoyé');
                    setTimeout(() => {
                        $('#message-comment').remove();
                    }, 2000);
                } else {
                    $('#message-comment').text('Commentaire invalide');
                    setTimeout(() => {
                        $('#message-comment').remove();
                    }, 2000);
                }
            }, 'JSON');
        }
    }
}