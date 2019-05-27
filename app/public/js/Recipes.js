class Recipes {
    constructor(baseurl) {
        this.baseUrl = baseurl;
        this.displayRecipes();
        $('#keyword').on('input', this.searchRecipe.bind(this));
        $('.delete-recipe').on('click', this.deleteRecipe.bind(this));
    }

 displayRecipes() {
        $.get(this.baseUrl + '/displayRecipes', (response) => {
            if (response.status === 'success') {
                $('#list-recipes').empty();
                response.recipes.forEach((recipe) => {
                    this.createRecipe(recipe);
                });
            } else {
                $('<p>').text('Impossible de charger les recettes');
            }
        }, 'JSON');
    }

    createRecipe(recipe) {
        $('#list-recipes').append([
            $('<article>', {'class': 'card card-recipe'}).append(
                $('<img>', {
                    'src': this.baseUrl + '/app/public/images/' + recipe.image,
                    'height': '200px'
                }),
                $('<div>', {
                    'class': 'card-body text-center position-relative'
                }).append(
                    $('<span>', {
                        'class': 'badge badge-success position-absolute card-recipe-label'
                    }).text(recipe.category),
                    $('<h3>').append(
                        $('<strong>').text(recipe.title)
                    ),
                    $('<p>', {
                        'class' : 'card-recipe-infos'
                    }).html(' De ' + '<strong>' + recipe.nickname + '</strong> le ' + recipe.date),
                    $('<a>', {
                        'class' : 'btn btn-primary p-1',
                        'href' : 'recipes/id/' + recipe.id
                    }).text('Voir recette')
                )
            )
        ]);
    }

    searchRecipe() {
        let keyword = $('#keyword').val();

        $.post(this.baseUrl + '/search', {keyword: keyword}, (response) => {
            let listRecipe = $('#list-recipes');
            if (response.status === 'success') {

                if (keyword === '') { // vide
                    this.displayRecipes();
                } else {
                    listRecipe.empty();
                    response.recipes.forEach((recipe) => {
                        this.createRecipe(recipe);
                    });
                }
            } else if (response.status === 'empty') {
                listRecipe.empty();
            }
        }, 'JSON');
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
}