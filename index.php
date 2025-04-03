<?php
    // Incluye los archivos necesarios
    include_once "include/db.php";
    include_once "include/finanzas.php";

    // Instancia la clase Finanzas
    $_finanzas = new finanzas();
    
    if ($_SERVER['REQUEST_METHOD'] ==='POST') {
        $Desc = htmlspecialchars($_POST['description']);
        $Monto = htmlspecialchars($_POST['num']);
        $_finanzas->nuevaOperacion($Desc, $Monto);
    }


    $operaciones = $_finanzas->verOperaciones();
    $total = $_finanzas->Total();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dulces Ronroneos</title>
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/index.css">
    <script>
        if (window.history.replaceState) { // verificamos disponibilidad
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>
<body>
    <header>
        <span class="select"><a href="./">Finanzas</a></span>
        <span><a href="./inventario/">Inventario</a></span>
    </header>
    <main>
        <span class="titulo">Dinero total:</span>
        <span class="dinero"><?php echo $total ?></span>
    </main>
    <section class="div_sec">
        <div class="form_div">
            <div class="preView">
                <img src="./img/arrow.svg" class="arrow">
                <span class="pre_title">Añadir un gasto o ganancia</span>
            </div>
            <div class="fullView none" id="form">
                <form action="./" method="post">
                    <div>
                        <input type="text" name="description" placeholder="Description" required>
                        <input type="number" name="num" placeholder="Gasto/Ganancia" required>
                    </div>
                    <input type="submit" value="Listo">
                </form>
            </div>
        </div>
    </section>
    <section class="transacciones">
<?php
foreach (@$operaciones as $operacion) {
if ($operacion['MontoOperación'] >= 0){
    $class = "verde";
}else{
    $class = "rojo";
}
?>
    <div class="transaccion">
        <div class="uno">
            <div>
                <img src="./img/down.svg" >
                <span><?php echo $operacion['Desc'] ?></span>
            </div>
            <span class="<?php echo $class ?>"><?php echo $operacion['MontoOperación'] ?></span>
        </div>
        <span class="fecha"><?php echo $operacion['Fecha'] ?></span>
    </div>
<?php
}
?>      
</section>

    <script>
    const preView = document.querySelector(".preView");
    const arrow = document.querySelector(".arrow")
    const form = document.querySelector(".fullView");

    preView.addEventListener("click", function() {
        form.classList.toggle("none");
        console.log(arrow.src)
        if (arrow.src == "http://<?php echo $_SERVER["HTTP_HOST"] ?>/img/arrow.svg"){
            arrow.src = "/img/arrow2.svg"
        }else{
            arrow.src = "/img/arrow.svg"
        }
    });
</script>

</html>