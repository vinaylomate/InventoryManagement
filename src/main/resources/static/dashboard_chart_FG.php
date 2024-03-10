<script>
	var productTypeId;
	<?php
	$dataPoints = array();
	$a = $_GET['iType'];
	echo "productTypeId = '" . $a . "';";
	?>
	let user = JSON.parse(localStorage.getItem('user'));
	if (user == null) {
		window.location.href = 'index.php';
	}
	let userId = user.User.userId;
	let token = user.token;
	let url = `http://localhost:8080/get/graph/${productTypeId}/1`;
	let arr = [];
	$.ajax({
		type: "GET",
		headers: {
			Authorization: token
		},
		url: url,
		contentType: 'application/json',
		success: function(data) {
			data.forEach((graph) => {
				let parts = graph.month.split("-");
				let month = parts[1];
				let year = parts[1] + '-' + parts[0];
				let stuff = {
					"label": year,
					"y": graph.totalQty,
					"indexLabel": "{y}"
				};
				arr.push(stuff);
			});
		}
	});
</script>