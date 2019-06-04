class Recipes {
    constructor(baseurl) {
        this.baseUrl = baseurl;
        this.displayLastRecipesHome();
        $('#keyword').on('input', this.searchRecipe.bind(this));
        $('.page-link').on('click', this.displayRecipesByPageHome.bind(this));
    }
    displayLastRecipesHome() {
        $.get(this.baseUrl + '/displayLastRecipes', (response) => {
            if (response.status === 'success') {
                $('#list-recipes').empty();
                response.recipes.forEach((recipe) => {
                    this.createRecipeCard(recipe);
                });
            } else {
                $('<p>').text('Impossible de charger les recettes');
            }
        }, 'JSON');
    }
    displayRecipesByPageHome(e) {
        let pageNumber = $(e.target).attr('data-id');
        $.post(this.baseUrl + '/page', {pageNumber: pageNumber}, (response) => {
            if (response.status === 'success') {
                $('#list-recipes').empty();
                response.recipes.forEach((recipe) => {
                    this.createRecipeCard(recipe);
                });
            } else {
                $('<p>').text('Impossible de charger les recettes');
            }
        }, 'JSON');
    }
    createRecipeCard(recipe) {
        $('#list-recipes').append([
            $('<article>', {'class': 'card card-recipe'}).append(
                $('<img>', {
                    'src': this.baseUrl + '/app/public/images/resized/' + recipe.image,
                    'class' : 'w-100'
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
                        'href' : 'id/' + recipe.id
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
                    this.displayLastRecipesHome();
                } else {
                    listRecipe.empty();
                    response.recipes.forEach((recipe) => {
                        this.createRecipeCard(recipe);
                    });
                }
            } else if (response.status === 'empty') {
                listRecipe.empty();
            }
        }, 'JSON');
    }
}