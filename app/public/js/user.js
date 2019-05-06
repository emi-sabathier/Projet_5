$(document).ready(()=>{
	$('#registerEmail').on('blur', ()=>{

		// let registerEmail = $('#registerEmail').val();
        //
		// $.post('http://localhost:8080/Projets/Projet_5/newuser', {registerEmail: registerEmail}, (response) => {
		// 	// ton code
		// }, 'json');

	$.ajax({
			url: 'http://localhost:8080/Projets/Projet_5/newuser',
			method: 'POST',
			data: {
				registerEmail: $('#registerEmail').val()
			},
			dataType: 'JSON',
			success: (response)=>{
				console.log(response);
			} 
		});
	});
});