let button = document.querySelectorAll('.admin_edit');
button.forEach((edit) => {
	edit.addEventListener('click', () => {
		let id = edit.getAttribute('data-id');
		let input = document.querySelectorAll('.admin_input'); 
			input.forEach((inp) => {
				if (inp.dataset.edit == id) {
					input = inp.value;
				}
			});
		(
			async () => {
				const response = await fetch('/admin/edit', {
					method: 'POST',
					headers: {'Content-Type': 'application/json; charset=utf-8'}, 
					body: JSON.stringify({
						id: id,
						input: input
					})
				});
				const answer = await response.json();
			}	
		)();
	});
});


let button_del = document.querySelectorAll('.admin_delete');
button_del.forEach((del) => {
	del.addEventListener('click', () => {
		let id_order = del.getAttribute('data-id');

		if (del.dataset.id == id_order) {
			id = del.dataset.id
		};
		(
			async () => {
				const response = await fetch('/admin/delete', {
					method: 'POST',
					headers: {'Content-Type': 'application/json; charset=utf-8'},
					body: JSON.stringify({
						id: id
					})
				});
				const answer = await response.json();
				let section = document.querySelectorAll('.section');
				section.forEach((sec) => {
					if (sec.dataset.id == id) {
						sec.remove();
					}
				});
			}
		)();
	});
});