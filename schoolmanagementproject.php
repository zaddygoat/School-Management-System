<?php include('./includes/config.php') ?>
<?php include('header.php') ?>
<!--Navbar-->
<nav class="navbar navbar-expand-lg" data-bs-theme="dark" style="background-color: #1A1A1A; border-bottom: 4px solid #C90812; box-shadow: 0 4px 15px rgba(201, 8, 18, 0.2);">
<?php if(isset($_SESSION['login'])) { ?>
  <div class="container-fluid">
   <a class="navbar-brand fw-bold" href="#" style="color: #C90812; text-shadow: 1px 1px 2px #000;">Zaid</a>
    
    <button class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup"
        aria-expanded="false"
        aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
    
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active px-3 rounded" aria-current="page" href="#" style="background-color: #C90812; color: #FFF !important; font-weight: bold;">Home</a>
        <a class="nav-link text-white-50" href="#" onmouseover="this.style.color='#C90812'" onmouseout="this.style.color='rgba(255,255,255,0.5)'">Features</a>
        <a class="nav-link text-white-50" href="#" onmouseover="this.style.color='#C90812'" onmouseout="this.style.color='rgba(255,255,255,0.5)'">Pricing</a>
      </div> 
		<div class="dropdown ms-auto">
		<a class="btn btn-outline-light dropdown-toggle"
       href="#"
       role="button"
       data-bs-toggle="dropdown"
       aria-expanded="false">
        <i class="fa fa-user me-2"></i>Account
		</a>

		<ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><a class="dropdown-item" href="/project/admin/dashboard.php">Dashboard</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>

        <li><hr class="dropdown-divider"></li>

        <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
    </ul>
	</div>
	
	<?php } else { ?>
	
	   <div class="navbar-nav ms-auto">
            <a href="login.php" class="nav-link ">
                <i class="fa fa-user me-2"></i>Login Or Register </a>
        </div>
    <?php } ?>
</div>
</nav>

<!--Div Class-->
<div class="d-flex shadow" style="height:550px; background:linear-gradient(-45deg, red 50%, transparent 50%)">
	<div class="container-fluid py-5">
		<div class = "row">
			<div class = "col-lg-6 my-auto">
			<h1 class = "display-1">School Management System</h1> <br>
			</h3> <br>
			</div>
			<div class = "col-lg-6">
				<div class = "col-lg-8 mx-auto card">
					<div class = "card-body">
					<h3 class = "display-6"> Dummy Admission Form</h3>
					<form action = "" method = "post" class ="">
					  <div class = "form-floating mb-3">
						<input type = "text" id = "form1" class = "form-control" placeholder="Your Name">
						<label for = "form1">Your Name</label>
					  </div>
					  <div class = "form-floating mb-3">
						<input type = "email" id = "email" class = "form-control" placeholder="Your Email">
						<label for = "email">Your Email</label>
					  </div>
					  <div class = "form-floating mb-3">
						<input type = "text" id = "mobile" class = "form-control" placeholder="Your Mobile Number">
						<label for = "mobile">Your Mobile Number</label>
					  </div>
					  <div class = "form-floating mb-3">
						<input type = "text" id = "mobile" class = "form-control" placeholder="Your Class">
						<label for = "mobile">Your Class</label>
					  </div>
					  <button  style="background-color: red; color: white;" class="rounded">Click To Submit</button>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 
 <!--About Us-->
 <section class="py-5">
  <div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-lg-7 py-4 text-center mx-auto">
			<h2>About <br> School Management Project</h2>
			<div>
			<p> 
			We bridge the gap between education and technology. Our mission is to empower schools, colleges, and universities with an intuitive, all-in-one digital ecosystem. By automating tedious administrative tasks, we give educators more time to focus on what matters most: student success.
			</p>
			<p> 
			Managing a modern school involves endless paperwork, disconnected communication channels, and scattered data. We created this School Management System to act as a single source of truth. Whether it is tracking daily attendance, managing complex fee structures, or sending instant updates to parents, our platform handles it seamlessly under one roof.
			</p>
			</div>
			<a href="" class="btn btn-secondary rounded">More On About Us</a>
			</div>
		</div>
	</div> 
 </section>
    <!--Courses-->
	<section class ="py-5 bg-light">
	   <div class="text-center form-floating mb-4">
	    <h2 class="">Courses</h2>
		<p class="text-muted">
		 An educational site used to deliver learning materials, assignments, or virtual classes.
		</p>
	   </div>
	   
	   <div class="container py-10">
		<div class="row g-4">
		<?php
		$query = mysqli_query($conn , "SELECT * FROM courses");
		while($course = mysqli_fetch_object($query)){	
		?>
		  <div class="col-md-6 col-lg-4 d-flex">
		   <div class="card h-100 w-100 shadow-sm">
		     <div>
			 <img src = "./dist/uploads/<?php echo $course->image?>"  class="card-img-top" alt="<?php echo $course->name; ?>">
			 </div>
		    <div class="card-body d-flex flex-column">
				 <h5 class="card-title"><?php echo $course->name?></h5>
				  <p class="card-text mb-3">
				   <strong>Duration: </strong><?php echo $course->duration?><br>
				   <strong>Duration: </strong> 2399-/ Rs
				  </p>
				<a href="#" class="btn btn-primary btn-enroll">
					Click To Enroll Now
				</a>		   
				</div>
		   </div>
		  </div>
		<?php } ?>
		</div>
	   </div>
	</section>
	<!--Trainers-->
  <section class ="py-5 bg-light">
	   <div class="text-center form-floating mb-5">
	    <h2 class="">Trainers</h2>
		<p class="text-muted">
		 An educational site used to deliver learning materials, assignments, or virtual classes.
		</p>
	   </div>
		<div class="container py-10">
			<div class="row g-4">
			<?php for($i=0; $i < 8; $i++)  { ?>
				<div class="col-lg-3 my-5">
					<div class="card">
					<div class="col-7 position-absolute  start-45 translate-middle-x" style="top:-55px; left:53%">
						<img src="./assets/img/anonymous.jpg" alt="" class="border rounded-circle" style="width:120px;">
					</div>
						<div class="card-body text-center pt-5 mt-4">
						<h4 class="card-title">Teacher Name</h4>
						<p class="card-text">
						<b>Courses:</b> 5 <br>
							<b>Ratings: </b> 5
						</p>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
	   </section>
	   <!-- Footer -->
<footer class="bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row">

            <!-- About -->
            <div class="col-lg-4 mb-4">
                <h3 class="fw-bold text-danger">School Management System</h3>
                <p class="text-light">
                    Empowering schools with smart digital solutions.
                    Manage admissions, attendance, fees, results, and
                    communication all in one place.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 mb-4">
                <h5 class="fw-bold">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-decoration-none text-light">Home</a></li>
                    <li><a href="#" class="text-decoration-none text-light">About</a></li>
                    <li><a href="#" class="text-decoration-none text-light">Courses</a></li>
                    <li><a href="#" class="text-decoration-none text-light">Teachers</a></li>
                    <li><a href="#" class="text-decoration-none text-light">Contact</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="col-lg-3 mb-4">
                <h5 class="fw-bold">Contact Us</h5>

                <p>
                    <i class="fas fa-map-marker-alt me-2 text-danger"></i>
                    Mumbai, Maharashtra
                </p>

                <p>
                    <i class="fas fa-phone me-2 text-danger"></i>
                    +91 91429 45786
                </p>

                <p>
                    <i class="fas fa-envelope me-2 text-danger"></i>
                    zaidahmed45786@gmail.com
                </p>
            </div>

            <!-- Social -->
            <div class="col-lg-3 mb-4">
                <h5 class="fw-bold">Follow Us</h5>

                <a href="#" class="btn btn-outline-light me-2">
                    <i class="fab fa-facebook-f"></i>
                </a>

                <a href="https://youtu.be/sHv0JW9m-2U?si=rwwyGcz9izyzCcrK" class="btn btn-outline-light me-2">
                    <i class="fab fa-youtube"></i>
                </a>
				<a href="https://youtu.be/sHv0JW9m-2U?si=rwwyGcz9izyzCcrK" class="btn btn-outline-light me-2">
                    <i class="fab fa-whatsapp"></i>
                </a>

                <a href="https://x.com/" class="btn btn-outline-light me-2">
                    <i class="fab fa-x"></i>
                </a>

                <a href="#" class="btn btn-outline-light">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>

        </div>

        <hr class="border-secondary">

        <div class="text-center">
            <p class="mb-0">
                © 2026 School Management System. All Rights Reserved.
                <br>
                Designed by <span class="text-danger fw-bold">Zaid</span>
            </p>
        </div>
    </div>
</footer>
<?php include('footer.php')?>

