class Recipes {
    constructor(baseurl) {
        this.baseUrl = baseurl;
        this.displayLastRecipesHome();
        $('#keyword').on('input', this.searchRecipe.bind(this));
        $('.page-link').on('click',
            this.displayRecipesByPageHome.bind(this)
        );
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
            $('<article>', {
                'class': 'animated fadeIn card-anim col-sm-6 col-md-4 col-lg-4 mx-auto'
            }).append(
                $('<div>', {
                    'class': 'mb-3'
                }).append(
                    $('<a>', {
                        'href': this.baseUrl + '/id/' + recipe.id,
                        'class': 'card card-recipe'
                    }).append(
                        $('<figure>').append(
                            $('<img>', {
                                'src': this.baseUrl + '/app/public/images/resized/' + recipe.image,
                                'class': 'w-100'
                            })
                        ),
                        $('<div>', {'class': 'position-absolute text-center w-100 text-white card-text'}).append(
                            $('<span>', {'class': 'badge badge-success position-absolute card-recipe-label'}).text(recipe.categoryLabel),
                            $('<h4>').text(recipe.title),
                            $('<p>').html('<i class="fas fa-clock"></i> ' + recipe.time + 'mn <i class="fas fa-comment-dots"></i> ' + recipe.nbComments),
                        )
                    )
                )
            )
        ]);
    }

    searchRecipe() {
        let keyword = $('#keyword').val();
        $.post(this.baseUrl + '/search', {keyword: keyword}, (response) => {
            let listRecipe = $('#list-recipes');
            if (response.status === 'success') {
                if (keyword === '') {
                    $('.no-recipe-msg').text('');
                    this.displayLastRecipesHome();
                } else {
                    listRecipe.empty();
                    response.recipes.forEach((recipe) => {
                        this.createRecipeCard(recipe);
                    });
                }
            } else {
                listRecipe.empty();
                $('.no-recipe-msg').text('Aucune recette trouvée.');
            }
        }, 'JSON');
    }
}