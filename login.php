<?php include('header.php') ?>
<section class="bg-light vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-lg-4 col-md-6">

                <div class="card shadow">
                    <div class="card-body p-4">

                        <!-- User Icon -->
                        <div class="border rounded-circle d-flex justify-content-center align-items-center mx-auto mb-4"
                             style="width:100px; height:100px;">
                            <i class="fa fa-user fa-3x text-secondary"></i>
                        </div>

                        <h3 class="text-center mb-4">Login</h3>

                        <form action="files/login.php" method="POST">

                            <!-- Email -->
                            <div class="form-floating mb-3">
                                <input type="email"
                                       class="form-control"
                                       id="email"
                                       name="email"
                                       placeholder="Your Email"
                                       required>

                                <label for="email">Your Email</label>
                            </div>

                            <!-- Password -->
                            <div class="form-floating mb-4">
                                <input type="password"
                                       class="form-control"
                                       id="password"
                                       name="password"
                                       placeholder="Your Password"
                                       required>

                                <label for="password">Your Password</label>
                            </div>

                            <!-- Button -->
                            <div class="d-grid">
                                <button type="submit" style="background-color: purple; color:white;"  class="rounded" name="login">
                                    Login
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
<?php include('footer.php')?>
