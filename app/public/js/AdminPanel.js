class AdminPanel{
    constructor(baseurl){
        this.baseUrl = baseurl;
        this.displayLastRecipesAdmin();
        $('.reset-report').on('click', this.resetReport.bind(this));
        $('.delete-comment').on('click', this.deleteComment.bind(this));
        $('.delete-user').on('click', this.deleteUser.bind(this));
        $('.page-link').on('click', this.displayRecipesByPageAdmin.bind(this));
    }
    deleteUser(e){
        let idUser = $(e.target).attr('data-id');
        $.post(this.baseUrl + '/admin/deleteuser', {userId: idUser}, (response) => {
            if(response === 'success'){
                $(e.target).parent().parent().remove();
            } else {
                console.log('Une erreur est survenue');
            }
        }, 'JSON');
    }
    displayLastRecipesAdmin(){
        $.get(this.baseUrl + '/admin/displayLastRecipesAdmin', (response) => {
            if (response.status === 'success') {
                response.recipes.forEach((recipe) => {
                    this.createRecipeInline(recipe);
                    $('.delete-recipe').on('click', this.deleteRecipe.bind(this));
                });
            } else {
                $('<p>').text('Impossible de charger les recettes');
            }
        }, 'JSON');
    }
    displayRecipesByPageAdmin(e){
        let pageNumber = $(e.target).attr('data-id');
        $.post(this.baseUrl + '/admin/page', {pageNumber: pageNumber}, (response) => {
            if (response.status === 'success') {
            $('#admin-list-recipes').empty();
                response.recipes.forEach((recipe) => {
                    this.createRecipeInline(recipe);
                    $('.delete-recipe').on('click', this.deleteRecipe.bind(this));
                });
            } else {
                $('<p>').text('Impossible de charger les recettes');
            }
        }, 'JSON');
    }
    createRecipeInline(recipe){
        let linkInfo = {
            'class' : 'nbComments'
        }

        if (recipe.nbComments > 0) linkInfo.href = this.baseUrl + '/admin/listcomments/' + recipe.id;

        $('#admin-list-recipes').append(
            $('<tr>', {'class' : 'recipes'}).append(
                $('<td>').append(
                    $('<a>', {
                        'href': this.baseUrl + '/id/' + recipe.id,
                        'target' : '_blank'
                    }).text(recipe.title)
                ),
                $('<td>').text(recipe.date),
                $('<td>').append(
                    $('<a>', {
                        'href': this.baseUrl + '/admin/category/' + recipe.categoryId
                    }).text(recipe.categoryLabel)
                ),
                $('<td>').append(
                    $('<a>', linkInfo).text(recipe.nbComments)
                ),
                $('<td>', {
                    'class' : 'btn-group',
                    'role' : 'group',
                    'aria-label' : 'actions'
                }).append(
                    $('<a>', {
                        'href': this.baseUrl + '/admin/updateform/' + recipe.id,
                        'class' : 'btn btn-secondary'
                    }).text('Modifier'),
                    $('<button>', {
                        'data-id': recipe.id,
                        'class' : 'delete-recipe btn btn-danger'
                    }).text('Effacer')
                )
            )
        );
    }
    deleteRecipe(e) {
        let targetButton = $(e.target); // élément HTML
        let id = targetButton.attr('data-id'); // data id de l'élément
        $.post(this.baseUrl + '/admin/deleterecipe', {recipeId: id}, (response) => {
            if (response === 'success') {
                let trRecipe = targetButton.parent().parent();
                trRecipe.remove();
            } else {
                console.log('Une erreur est survenue');
            }
        }, 'JSON');
    }
    resetReport(e) {
        let idComment = $(e.target).attr('data-id');
        $.post(this.baseUrl + '/admin/resetreport', {commentId: idComment}, (response) => {
            if (response === 'success') {
                $(e.target).parent().parent().remove();
            } else {
                console.log('Une erreur est survenue');
            }
        }, 'JSON');
    }
    deleteComment(e){
        let idComment = $(e.target).attr('data-id');
        $.post(this.baseUrl + '/admin/deletecomment', {commentId: idComment}, (response) => {
            if(response === 'success'){
                $(e.target).parent().parent().remove();
            } else {
                console.log('Une erreur est survenue');
            }
        }, 'JSON');
    }
}
