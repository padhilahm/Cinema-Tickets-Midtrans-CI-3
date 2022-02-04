<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-ZK801qB3t6GSnZl0"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <title>Cinemas</title>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= site_url() ?>">
                <img src="<?= base_url('asset/images/logo.png') ?>" alt="" width="30" height="24" class="d-inline-block align-text-top">
                Cinemas
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= site_url() ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('cinema/history'); ?>">History</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($movies as $movie) { ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="<?php echo base_url('asset/images/'); ?><?php echo $movie->image; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $movie->title; ?></h5>
                            <p class="card-text"><?php echo $movie->description; ?></p>
                        </div>
                        <a href="<?php echo site_url('cinema/movie/') . $movie->id; ?>" class="btn btn-primary">Buy Ticket</a>
                    </div>
                </div>
            <?php } ?>

        </div>

        <!-- <h3>Pembayaran SPP</h3>
        <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Kelas</label>
                <input type="text" class="form-control" id="kelas" name="kelas" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Jumlah Bayar</label>
                <input type="number" class="form-control" id="jumlah_bayar" name="jumlah_bayar" required>
            </div>
        </form>

        <form id="payment-form" method="post" action="<?= site_url() ?>/snap/finish">
            <input type="hidden" name="result_type" id="result-type" value="">

            <input type="hidden" name="result_data" id="result-data" value="">
        </form>
        <button id="pay-button" class="btn btn-primary">Bayar!</button> -->
        <!-- <hr>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Order Id</th>
                    <th scope="col">Transaction Id</th>
                    <th scope="col">Gross Amount</th>
                    <th scope="col">Payment Type</th>
                    <th scope="col">Transaction Time</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $transaction) { ?>
                    <tr>
                        <td><?= $transaction->order_id ?></td>
                        <td><?= $transaction->transaction_id ?></td>
                        <td>Rp.<?= number_format($transaction->gross_amount) ?></td>
                        <td><?= $transaction->payment_type ?></td>
                        <td><?= $transaction->transaction_time ?></td>
                        <td>
                            <?php
                            if ($transaction->status_code == 200) {
                                echo "Success";
                            } elseif ($transaction->status_code == 201) {
                                echo "Pending";
                            } elseif ($transaction->status_code == 407) {
                                echo "Expired";
                            } elseif ($transaction->status_code == 202) {
                                echo "Danied";
                            }
                            ?>
                            (<?= $transaction->status_code ?>)</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table> -->
    </div>

    <footer class="bg-light text-center text-lg-start mt-5">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            ©<?= date('Y') ?> Copyright:
            <a class="text-dark" href="">Cinemas</a>
        </div>
        <!-- Copyright -->
    </footer>

    <script type="text/javascript">
        $('#pay-button').click(function(event) {
            event.preventDefault();
            $(this).attr("disabled", "disabled");
            var nama = $("#nama").val();
            var kelas = $("#kelas").val();
            var jumlah_bayar = $("#jumlah_bayar").val();
            $.ajax({
                type: 'POST',
                url: '<?= site_url() ?>/snap/token',
                data: {
                    nama: nama,
                    kelas: kelas,
                    jumlah_bayar: jumlah_bayar
                },
                cache: false,

                success: function(data) {
                    //location = data;
                    console.log('token = ' + data);

                    var resultType = document.getElementById('result-type');
                    var resultData = document.getElementById('result-data');

                    function changeResult(type, data) {
                        $("#result-type").val(type);
                        $("#result-data").val(JSON.stringify(data));
                        //resultType.innerHTML = type;
                        //resultData.innerHTML = JSON.stringify(data);
                    }

                    snap.pay(data, {

                        onSuccess: function(result) {
                            changeResult('success', result);
                            console.log(result.status_message);
                            console.log(result);
                            $("#payment-form").submit();
                        },
                        onPending: function(result) {
                            changeResult('pending', result);
                            console.log(result.status_message);
                            $("#payment-form").submit();
                        },
                        onError: function(result) {
                            changeResult('error', result);
                            console.log(result.status_message);
                            $("#payment-form").submit();
                        }
                    });
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>