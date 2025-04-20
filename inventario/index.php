<?php
    // Incluye los archivos necesarios
    include_once "../include/db.php";
    include_once "../include/inventario.php";

    // Instancia la clase Inventario
    $_inventario = new inventario();

    if ($_SERVER['REQUEST_METHOD'] ==='POST') {

        $_array = [
            'Leche' => ($_POST['Leche'] != '') ? htmlspecialchars($_POST['Leche']) : 0,
            'Lecherita' => ($_POST['Lecherita'] != '') ? htmlspecialchars($_POST['Lecherita']) : 0,
            'C.Leche' => ($_POST['C_Leche'] != '') ? htmlspecialchars($_POST['C_Leche']) : 0,
            'Paquetatos' => ($_POST['Paquetatos'] != '') ? htmlspecialchars($_POST['Paquetatos']) : 0,
            'Gelatina' => ($_POST['Gelatina'] != '') ? htmlspecialchars($_POST['Gelatina']) : 0,
            'Envase' => ($_POST['Envase'] != '') ? htmlspecialchars($_POST['Envase']) : 0,
            'Gorros' => ($_POST['Gorros'] != '') ? htmlspecialchars($_POST['Gorros']) : 0,
            'CubreBocas' => ($_POST['CubreBocas'] != '') ? htmlspecialchars($_POST['CubreBocas']) : 0,
            'Cucharas' => ($_POST['Cucharas'] != '') ? htmlspecialchars($_POST['Cucharas']) : 0,
            'Guantes' => ($_POST['Guantes'] != '') ? htmlspecialchars($_POST['Guantes']) : 0
        ];
        $_inventario->nuevaOperacion($_array);
    }
    $Values = $_inventario->valuesForm();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario | Dulces Ronroneos</title>
    <link rel="stylesheet" href="/css/all.css">
    <link rel="stylesheet" href="/css/inv.css">
    <link rel="shortcut icon" href="/img/Dulces Ronroneos(6).png" type="image/x-icon">
    <script>
        if (window.history.replaceState) { // verificamos disponibilidad
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <!-- <?php print_r($_inventario->verOperaciones()) ?> -->
</head>
<body>
    <header>
        <span><a href="/">Finanzas</a></span>
        <span class="select"><a href="./inventario/">Inventario</a></span>
    </header>
    <main>
		<span class="titulo">Dinero inv:</span>
        <span class="dinero"><?php echo round($_inventario->invValor(), 1) ?></span>
	</main>
	<section>
		<form action="./" method="POST">
            <div class="preView">
                <img src="/img/arrow.svg" class="arrow">
                <span class="pre_title">Editar el inventario</span>
            </div>
			<div id="div_nya" class="none">
				<div class="div_nya_1">
					<span>Leche <b>Bolsa</b></span>
					<span>Lecherita <b>Gramos</b></span>
					<span>C.Leche <b>Bolsa</b></span>
					<span>Paquetatos <b>#</b></span>
					<span>Gelatina <b>Gramos</b></span>
					<span>Envase <b>#</b></span>
                    <span>Gorros <b>#</b></span>
                    <span>Cubre bocas <b>#</b></span>
                    <span>Cucharas <b>#</b></span>
                    <span>Guantes <b>#</b></span>

				</div>
				<div class="div_nya_2">
					<input type="number" name="Leche" <?php echo $Values['Leche'] ?> placeholder="0">
					<input type="number" name="Lecherita" <?php echo $Values['Lecherita'] ?> placeholder="0">
					<input type="number" name="C_Leche" <?php echo $Values['C.Leche'] ?> placeholder="0">
					<input type="number" name="Paquetatos" <?php echo $Values['Paquetatos'] ?> placeholder="0">
					<input type="number" name="Gelatina" <?php echo $Values['Gelatina'] ?> placeholder="0">
					<input type="number" name="Envase" <?php echo $Values['Envase'] ?> placeholder="0">
                    <input type="number" name="Gorros" <?php echo $Values['Gorros'] ?> placeholder="0">
					<input type="number" name="CubreBocas" <?php echo $Values['CubreBocas'] ?> placeholder="0">
                    <input type="number" name="Cucharas" <?php echo $Values['Cucharas'] ?> placeholder="0">
                    <input type="number" name="Guantes" <?php echo $Values['Guantes'] ?> placeholder="0">
				</div><br>
			</div>
            <input type="submit" id="submit" value="Guardar" class="none">
		</form>
	</section>

<script>
    const preView = document.querySelector(".preView");
    const arrow = document.querySelector(".arrow")
    const form = document.querySelector("#div_nya");
	const sub = document.querySelector("#submit");

    preView.addEventListener("click", function() {
        form.classList.toggle("none");
        form.classList.toggle("div_nya");
		sub.classList.toggle("none");
        if (arrow.src == "http://<?php echo $_SERVER["HTTP_HOST"] ?>/img/arrow.svg"){
            arrow.src = "/img/arrow2.svg"
        }else{
            arrow.src = "/img/arrow.svg"
        }
    });
</script>
</body>
</html>