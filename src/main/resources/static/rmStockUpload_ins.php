<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
	let jsonArray = [];
	function add(a, b, c, d, e, f, g, h, i, j) {
		let jsonData = {
			"sageCode":c,
			"focusCode": d,
			"description": e,
			"reorderLevelQty":h,
			"brandName" : f,
			"productExpiry":i,
			"companyId":a,
			"uomId":g,
			"productCategoryId":b,
			"userId":j
		};
		jsonArray.push(jsonData);
	}
	async function addAll() {
		let url = `http://localhost:8080/manage/addAll/productRegister`;
		alert(jsonArray.length);
		let jsonObject = {
			"products" :jsonArray
		};
		await $.ajax({
			type: "POST",
			url: url,
			data: JSON.stringify(jsonObject),
			contentType: 'application/json',
			success: function(data) {
				console.log("inserted");
			},
			error: function(error) {
				console.log(error);
			}
		});
	}
</script>
<!-- await new Promise(resolve => setTimeout(resolve, 500)); -->
<?php

if (isset($_POST['btn'])) {

	$file = $_FILES['file']['tmp_name'];
	$handle = fopen($file, "r");
	while (($filesop = fgetcsv($handle, 10000, ",")) !== false) {
		if ($filesop[6] != "uom") {
			$a = $filesop[0];
			$b = $filesop[1];
			$c = $filesop[2];
			$d = $filesop[3];
			$e = $filesop[4];
			$f = $filesop[5];
			$g = $filesop[6];
			$h = $filesop[7];
			$i = $filesop[8];
			$j = $filesop[9];
			echo '<script>
					add("' . $a . '", "' . $b . '", "' . $c . '", "' . $d . '","' . $e . '","' . $f . '","' . $g . '","' . $h . '","' . $i . '","' . $j . '");
				</script>';
		}
	}
	echo'<script>addAll();</script>';
}

?>