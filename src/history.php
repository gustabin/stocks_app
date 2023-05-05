<?php include __DIR__ . '/header.php';  ?>
    <body>
        <?php include __DIR__ . '/nav.php';  ?>
        <div class="container my-5">
        <h1>History</h1>
            <section class="content" id="history">
                <div class="card">
                    <div class="card-body login-card-body">
                    <p class="login-box-msg">Enter the user id to search</p>
                    <form class="form-horizontal" id="formDefault">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control redondeado" name="searchId" id="searchId" required="">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding-top: 10px">
                        <div class="col-5">
                            <button type="submit" class="btn btn-primary btn-block" onclick="SearchHistory()">Search</button>
                        </div>
                        </div>
                    </form>
                    </div>
                </div>
                <table id="stockTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Symbol</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Open</th>
                            <th>High</th>
                            <th>Low</th>
                            <th>Close</th>
                            <th>Volume</th>
                            <th>User Name</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                    </tbody>
                </table>            
            </section>
        </div>
        <?php include __DIR__ . '/footer.php';  ?>
        <script>VerificarToken();</script>
    </body>
</html>
<!-- The file history.php is a PHP file that includes the header.php and nav.php files, 
and displays a web page where a user can search for historical stock data. The user 
enters a user ID and clicks on the "Search" button to retrieve the historical data 
associated with that user. The historical data is displayed in a table that includes 
columns for the stock name, symbol, date, time, open, high, low, close, volume, and 
user name. The page also includes a script to verify the user's token. -->