<aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link <?php if ($_SERVER['PHP_SELF'] == '/admin/dashboard.php') {echo 'active';} ?>" href="dashboard.php?page=1" aria-expanded="false">
                        <i class="mdi me-2 mdi-gauge"></i><span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link <?php if ($_SERVER['PHP_SELF'] == '/admin/invoice.php') {echo 'active';} ?>" href="invoice.php?page=1" aria-expanded="false">
                        <i class="mdi me-2 mdi-file-multiple"></i><span class="hide-menu">Invoice</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link <?php if ($_SERVER['PHP_SELF'] == '/admin/product.php') {echo 'active';} ?>" href="product.php?page=1" aria-expanded="false">
                        <i class="mdi me-2 mdi-barcode-scan"></i><span class="hide-menu">Product</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link <?php if ($_SERVER['PHP_SELF'] == '/admin/client.php') {echo 'active';} ?>" href="client.php?page=1" aria-expanded="false">
                        <i class="mdi me-2 mdi-account-multiple"></i><span class="hide-menu">Client</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link <?php if ($_SERVER['PHP_SELF'] == '/admin/payment.php') {echo 'active';} ?>" href="payment.php?page=1" aria-expanded="false">
                        <i class="mdi me-2 mdi-cash-usd"></i><span class="hide-menu">Payment</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a target="blind"
                        class="sidebar-link waves-effect waves-dark sidebar-link <?php if ($_SERVER['PHP_SELF'] == '/admin/collection-report.php') { echo 'active';} ?>" href="collection-report.php" aria-expanded="false">
                        <i class="mdi me-2 mdi-chart-bar"></i><span class="hide-menu">Reports</span>
                    </a>
                </li>
            </ul>

        </nav>
    </div>
</aside>