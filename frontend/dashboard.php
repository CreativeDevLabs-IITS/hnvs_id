
<?php include 'partials/_head.php' ?>

    <div style="height: 100vh; background-color: #f1f1f1; " class="dashboard">
        <div style="position: sticky; top: 0; z-index: 5">
            <?php include 'partials/_navbar.php' ?>
        </div>
        
        <div style="display: grid; grid-template-columns: 250px 1fr">
            <?php include 'partials/_sidebar.php' ?>
            <div class="py-3 pe-3 ps-5">
                <div class="fs-4">Dashboard</div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>


<?php include 'partials/_footer.php' ?>
