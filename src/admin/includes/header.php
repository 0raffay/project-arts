<header class="dashboard--header">
    <div class="container-fluid py-3 border-bottom-hr px-5">
        <div class="row align-items-center justify-content-between">
            <div class="logo col-2">
                <a href="dashboard.php"><img src="../assets/images/logos/logo-black.png" alt="Logo"></a>
            </div>

            <div class="row text-center col-6 pt-4">
                <div class="col-6">
                    <ul class="list-group">
                        <li class="list-group-item bg-secondary fc-white">Net Sales:</li>
                        <li class="list-group-item"><?php echo $currencySymbol; ?>0</li>
                    </ul>
                </div>
                <div class="col-6">
                    <ul class="list-group">
                        <li class="list-group-item bg-secondary fc-white">Total Sales:</li>
                        <li class="list-group-item"><?php echo $currencySymbol; ?>0</li>
                    </ul>
                </div>
            </div>

            <div class="wrapper col-2  d-flex align-items-center justify-content-center gap-10">
                <div class="home">
                    <a class="fs-18 fc-secondary addHover" href="../index.php">View Site</a>
                </div>
                <div class="dashboard--profile">
                    <button><i class="ri-user-3-line"></i></button>
                </div>
            </div>
        </div>
    </div>
</header>