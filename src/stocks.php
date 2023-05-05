<?php include __DIR__ . '/header.php';  ?>
    <body>
        <?php include __DIR__ . '/nav.php';  ?>
        <div class="container my-5">
        <div class="alert alert-success" role="alert" style="display:none" id="successful_message">
            The query was completed successfully
        </div>
        <h1>Stock</h1>
            <section class="content" id="stock">
                <div class="card">
                    <div class="card-body login-card-body">
                    <p class="login-box-msg">Enter the symbol stock to search</p>
                    <form class="form-horizontal" id="formDefault">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control redondeado" name="searchStock" id="searchStock" required="">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="fa-sharp fa-solid fa-money-bill-trend-up"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding-top: 10px">
                        <div class="col-5">
                            <button type="submit" class="btn btn-primary btn-block" onclick="SearchStock()">Search</button>
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

<!-- This is a PHP file named "stocks.php". It includes the header, navigation, 
and footer files, and has a form to search for stock information using an API. 
It also has a table to display the stock information, which includes the stock 
name, symbol, date, time, open price, high price, low price, close price, and 
volume. There is a JavaScript function "VerificarToken()" called at the end of 
the file. -->