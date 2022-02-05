<?php $this->load->view('header_v'); ?>

    <div class="container mt-5 table-responsive">
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