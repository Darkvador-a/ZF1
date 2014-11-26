function Delete(id) {

	$.ajax({
		url : '#',
		type : 'POST',
		data : {
			id : id,
			supprime : 'supprime'
		},
		success : function(retour) {
			alert('Suppression effectuée');

		},
		error : function(obj, str, except) {
			alert('Error');
		}
	});
}
