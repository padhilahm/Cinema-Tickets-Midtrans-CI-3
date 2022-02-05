<?php $this->load->view('header_v'); ?>

    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title"><?php echo $movie->title; ?></h3>
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-6">
                        <div class="white-box text-center img-fluid"><img src="<?php echo base_url('asset/images/'); ?><?php echo $movie->image; ?>" width="300" class="img-responsive"></div>
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
                                <div class="center">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-secondary btn-number" data-type="minus" data-field="quant[2]">
                                                -
                                            </button>
                                        </span>
                                        <input type="text" id="amount" name="quant[2]" class="form-control input-number" value="1" min="1" max="5" onchange="inputForm()">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-secondary btn-number" data-type="plus" data-field="quant[2]">
                                                +
                                            </button>
                                        </span>
                                    </div>
                                </div>

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

        $('.btn-number').click(function(e) {
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if (type == 'minus') {

                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if (type == 'plus') {

                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });
        $('.input-number').focusin(function() {
            $(this).data('oldValue', $(this).val());
        });
        $('.input-number').change(function() {

            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());

            name = $(this).attr('name');
            if (valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if (valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }


        });
        $(".input-number").keydown(function(e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
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