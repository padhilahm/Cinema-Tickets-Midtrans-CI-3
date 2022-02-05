<?php $this->load->view('header_v'); ?>

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