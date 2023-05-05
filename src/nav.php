    <nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container">
			<a class="navbar-brand" href="#">PHP Challenge</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav ml-auto">
                    <?php
                        session_start();
                        $userId = isset($_SESSION['userId']);
                        if (!isset($userId)) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>   
                    <?php
                        } else {
                    ?>	
                        <li class="nav-item">
                            <a class="nav-link" onclick="DoLogout()">Logout</a> 
                        </li>   
                    <?php 
                        }
                    ?>				
                    <li class="nav-item">
						<a class="nav-link" href="create.php">Create a new User</a>
					</li>          
                    <li class="nav-item">
                        <a class="nav-link" href="stocks.php">Request a stock quote</a>
					</li>         
                    <li class="nav-item">
                        <a class="nav-link" href="history.php">History</a>
					</li>        
				</ul>
			</div>
		</div>
	</nav>
    <!-- This file is a navigation bar written in HTML and PHP. It includes a 
    Bootstrap navbar component and contains links to various pages such as Login, 
    Create a new User, Request a stock quote, and History. It also checks if the 
    user is logged in by checking for the existence of the `userId` session variable, 
    and displays the appropriate links based on that. -->