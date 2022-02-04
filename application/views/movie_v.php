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
        <div class="card">
            <div class="card-body">
                <h3 class="card-title"><?php echo $movie->title; ?></h3>
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-6">
                        <div class="white-box text-center"><img src="<?php echo base_url('asset/images/'); ?><?php echo $movie->image; ?>" width="430" class="img-responsive"></div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-6">
                        <h4 class="box-title mt-5"><?php echo $movie->title; ?></h4>
                        <p><?php echo $movie->description; ?></p>
                        <h2 class="mt-5">
                            Rp.<?php echo $movie->price; ?><small class="text-success"></small>
                        </h2>
                        <br>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Buy Now
                        </button>

                    </div>

                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Buy Ticket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-amount" class="col-form-label">Amount:</label>
                                <select name="amount" id="amount" class="form-control" onchange="inputForm()">
                                    <option value="0">Select Amount</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Name:</label>
                                <input type="text" onchange="inputForm()" class="form-control" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-phone" class="col-form-label">Email:</label>
                                <input type="email" onchange="inputForm()" class="form-control" id="email">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-phone" class="col-form-label">Watch date:</label>
                                <input type="date" onchange="inputForm()" class="form-control" id="dateWatch">
                            </div>
                            <br>
                            <div class="mb-3">
                                <hr>
                                <h4 id="totalPayment">Total payment : Rp. 0</h4>
                            </div>
                        </form>
                    </div>
                    <form id="payment-form" method="post" action="<?= site_url() ?>/cinema/finish">
                        <input type="hidden" name="result_type" id="result-type" value="">

                        <input type="hidden" name="result_data" id="result-data" value="">
                        
                        <input type="hidden" name="amountPay" id="amountPay" value="0">
                        <input type="hidden" name="namePay" id="namePay">
                        <input type="hidden" name="emailPay" id="emailPay">
                        <input type="hidden" name="dateWatchPay" id="dateWatchPay">
                        <input type="hidden" name="movieId" id="movieId" value="<?php echo $this->uri->segment(3); ?>">
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" id="pay-button" class="btn btn-primary">Pay</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <footer class="bg-light text-center text-lg-start mt-5">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            ©<?= date('Y') ?> Copyright:
            <a class="text-dark" href="">Cinemas</a>
        </div>
        <!-- Copyright -->
    </footer>

    <script>
        function inputForm() {
            var amount = $('#amount').val();
            var name = $('#name').val();
            var email = $('#email').val();
            var dateWatch = $('#dateWatch').val();
            var totalPayment = amount * <?php echo $movie->price; ?>;
            $("#amountPay").val(amount);
            $("#namePay").val(name);
            $("#emailPay").val(email);
            $("#dateWatchPay").val(dateWatch);
            $("#totalPayment").html(`Total payment : Rp. ${ totalPayment }`);
        }
    </script>

    <script type="text/javascript">
        $('#pay-button').click(function(event) {
            event.preventDefault();
            // $(this).attr("disabled", "disabled");
            const amount = $('#amount').val();
            const name = $('#name').val();
            const movieId = <?php echo $this->uri->segment(3); ?>;
            $.ajax({
                type: 'POST',
                url: '<?= site_url() ?>cinema/token',
                data: {
                    name: name,
                    amount: amount,
                    movieId: movieId
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