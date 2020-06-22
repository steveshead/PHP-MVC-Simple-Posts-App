    </div>
    <!-- Footer -->
    <footer class="py-3 pb-2 bg-light border-top fixed-bottom">
        <div class="container">
            <div class="row small">
                <div class="col-md-6">Copyright &copy; Your Website <?php print date("Y");?></div>

                <?php if(isset($_SESSION['user_id'])) : ?>
                <div class="col-md-6 text-right">Logged in as: <?php echo $_SESSION['user_name']; ?></div>
                <?php else : ?>
                    <div class="col-md-6 text-right"><a href="<?php echo URLROOT; ?>/users/register">Register</a> &middot; <a href="<?php echo URLROOT; ?>/users/login">Login</a></div>
                <?php endif; ?>
            </div>
        </div>
    </footer>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-- Site JS -->
    <script src="<?php echo URLROOT; ?>/js/main.js"></script>
</body>
</html>