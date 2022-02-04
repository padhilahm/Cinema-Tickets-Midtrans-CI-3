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
        <h1>History</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Movie Title</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Gross Amount</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($transactions as $transaction) { ?>
                    <tr>
                        <td><a href="<?= site_url("cinema/historyDetail/$transaction->order_id") ?>"><?= $transaction->order_id ?></a></td>
                        <td><?= $transaction->name ?></td>
                        <td><?= $transaction->email ?></td>
                        <td><?= $transaction->title ?></td>
                        <td><?= $transaction->amount ?></td>
                        <td><?= $transaction->gross_amount ?></td>
                        <td> <?php
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
                            (<?= $transaction->status_code ?>)
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>

    <footer class="bg-light text-center text-lg-start mt-5">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            ©<?= date('Y') ?> Copyright:
            <a class="text-dark" href="">Cinemas</a>
        </div>
        <!-- Copyright -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>