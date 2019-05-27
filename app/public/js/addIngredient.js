// var counter = 1;
// var limit = 3;
// function addInput(divName){
//     if (counter == limit)  {
//         alert("You have reached the limit of adding " + counter + " inputs");
//     }
//     else {
//         var newdiv = document.createElement('div');
//         newdiv.innerHTML = "Entry " + (counter + 1) + " <br><input type='text' name='myInputs[]'>";
//         document.getElementById(divName).appendChild(newdiv);
//         counter++;
//     }
// }
$(document).ready(() => {
    let counter = 1;
    const limit = 3;

    $('#ingredients').on('click', () => {
        if (counter == limit) {
            alert("Vous ne pouvez pas ajouter plus de " + counter + " ingrédients");
        }
        else {
            $('#dynamicInput').append('<div>Ingrédient ' + (counter + 1) + ' <br><input type=\'text\' name=\'ingredients[]\'>Quantité<input type=\'text\' name=\'quantities[]\'>Unité<input type=\'text\' name=\'units[]\'></div>');
            counter++;
        }
    });
});
