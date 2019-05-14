// $(document).ready(() => {
//     $('.delete-recipe').on('click', (e) => {
//         let targetButton = $(e.target); // élément HTML
//         let id = targetButton.attr('data-id'); // data id de l'élément
//
//         $.post(baseUrl + '/admin/deleterecipe', {recipeId: id, vgjyvgyvg: 'jambon'}, (response) => {
//             console.log(response.coppa);
//         }, 'JSON');
//     });
// });

$(document).ready(() => {
    $('.delete-recipe').on('click', (e) => {
        let targetButton = $(e.target); // élément HTML
        let id = targetButton.attr('data-id'); // data id de l'élément
        $.post(baseUrl + '/admin/deleterecipe', {recipeId: id}, (response) => {
            if(response === 'success'){
                let trRecipe = targetButton.parent().parent();
                trRecipe.remove();
            } else {
                alert('Une erreur est survenue');
            }
        }, 'JSON');
    });
});