<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Site PW</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<?php
require_once "Controllers/Functions.php";
$con = Conection();
$allProd = cart();

if ($_SESSION['logado'] == false) {
    header("location: index.php");
}

$total = 0;

?>

<body style="background-color: #040726;">
    <?php require_once "menu.php"; ?>
    <div class="shopping-cart mt-5">
        <h1 class="text-light text-center">Carrinho</h1>
        <div class="px-4 px-lg-0">

            <div class="pb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

                            <!-- Shopping cart table -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="p-2 px-3 text-uppercase">Produto</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="py-2 text-center text-uppercase">Preço</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="py-2 text-center text-uppercase">Quantidade</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="py-2 text-center text-uppercase">Remover</div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php foreach ($allProd as $prod) {
                                            $total += $prod->prod_pric;
                                        ?>
                                            <tr>
                                                <th scope="row">
                                                    <div class="p-2">
                                                        <?php echo "<img width='70' class='img-fluid rounded shadow-sm' src='data:" . $prod->prod_img1_type . ";base64," . base64_encode($prod->prod_img1_data) . "'/>"; ?>
                                                        <div class="ml-3 d-inline-block align-middle">
                                                            <h5 class="mb-0"><a href="#" class="text-dark d-inline-block"><?= $prod->prod_name ?></a></h5><span class="text-muted font-weight-normal font-italic">Category: Electronics</span>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td class="align-middle text-center"><strong>R$<?= $prod->prod_pric ?></strong></td>
                                                <td class="align-middle text-center"><strong>1</strong></td>
                                                <td class="align-middle text-center"><a href="Controllers/Op.php?option=removeCart&id=<?= $prod->prod_id ?>" class=" btn btn-outline-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End -->
                        </div>
                    </div>

                    <div class="row py-5 p-4 bg-white rounded shadow-sm">
                        <div class="col-lg-6">
                            <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Coupom</div>
                            <div class="p-4">
                                <p class="font-italic mb-4">Se você tiver um cupom insira-o aqui</p>
                                <div class="input-group mb-4 border rounded-pill p-2">
                                    <input type="text" placeholder="Aplicar Cupom" aria-describedby="button-addon3" class="form-control border-0">
                                    <div class="input-group-append border-0">
                                        <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Aplicar Cupom</button>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Formas de pagamento</div>
                            <div class="p-4">
                                <select onchange="payment(this.value)" class="form-select" aria-label="Default select example">
                                    <option selected>Selecione a forma de pagamento</option>
                                    <option value="À Vista">À Vista</option>
                                    <option value="Crédito 3X parcelado">Crédito 3X parcelado</option>
                                    <option value="Crédito 6X parcelado">Crédito 6X parcelado</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Pedido </div>
                            <div class="p-4">
                                <p class="font-italic mb-4">Frete e custos adicionais são calculados com base nos valores que você inseriu.</p>
                                <ul class="list-unstyled mb-4">
                                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Subtotal </strong><strong id="subtotal"><?= $total ?></strong></li>
                                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Frete</strong><strong>R$10.00</strong></li>
                                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Forma de Pagamento</strong><strong id="tax">Selecione a forma de pagamento</strong></li>
                                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                                        <h5 id="total" class="font-weight-bold"></h5>
                                    </li>
                                </ul><a href="#" class="btn btn-dark rounded-pill py-2 btn-block">Finalizar Compra</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script>
        function payment(valueSelect) {
            var tax = document.getElementById("tax");
            var subtotal = document.getElementById("subtotal").innerHTML;
            var total = document.getElementById("total");
            if (valueSelect == "À Vista") {
                var taxa = subtotal * 0.03;
                var totalConta = subtotal - taxa;
                total.innerHTML = "R$" + totalConta;
            } else if (valueSelect == "Crédito 3X parcelado") {
                var totalConta = subtotal;
                total.innerHTML = "R$" + totalConta;
            } else if (valueSelect == "Crédito 6X parcelado") {
                var taxa = parseInt(subtotal) * 0.025;
                var totalConta = parseInt(subtotal) + taxa;
                total.innerHTML = "R$" + totalConta;
            }
            tax.innerHTML = valueSelect
        }
    </script>
</body>

</html>