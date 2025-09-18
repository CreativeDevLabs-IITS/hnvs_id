<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/log-in.css">
</head>
<body>
    

    <div class="d-flex justify-content-center align-items-center main_con" style="height: 100vh;">
        <form class="form" >
            <div class="d-flex flex-column justify-content-center align-items-center">
                <img src="https://hnvs-id-be.creativedevlabs.com/assets/logo.png" style="width: 18%;" alt="">
                <div class="fw-semibold" style="font-size: 10px;">HILONGOS NATIONAL VOCATIONAL SCHOOL</div>
            </div>
            <p class="fw-semibold d-flex justify-content-center mt-4" style="font-size: 15px;">Welcome Back! </p>
            <label>
                <input class="input" type="email" placeholder="" required="" id="email" style="background-color: transparent;">
                <span>Email</span>
            </label> 
                
            <label>
                <input class="input" type="password" placeholder="" required="" id="password">
                <span>Password</span>
            </label>
            <button class="btn btn-primary fw-semibold d-flex justify-content-center" style="font-size: 12px; padding: 12px 0" id="login">
                <div id="submitText">Submit</div>
                <div class="loader2 me-2" style="display: none" id="loginLoader"></div>
            </button>
        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <?php include 'partials/config.php' ?>

    <script>
        const APP_URL = "<?= APP_URL ?>"
        const FRONTEND_URL = "<?= FRONTEND_URL ?>"

        document.addEventListener('DOMContentLoaded', () => {
            const token = localStorage.getItem('token');
            if(token) {
                location.replace(`${FRONTEND_URL}/dashboard.php`);
            }else {
                if (window.history && window.history.pushState) {
                    window.history.pushState(null, null, location.href);
                    window.onpopstate = function () {
                        window.history.pushState(null, null, location.href); // Prevent back
                    };
                }
            }
            
        });


        $(document).on('click', '#login', function(e) {
            document.getElementById('submitText').style.display = 'none';
            document.getElementById('loginLoader').style.display = 'block'
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            fetch(`${APP_URL}/api/login`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'Application/json',
                    'Accept' : 'Application/json',
                },
                body: JSON.stringify({email, password})
            })
            .then(response => response.json())
            .then(res => {
                if (res.token) {
                    localStorage.setItem('token', res.token);
                    localStorage.setItem('role',res.role);
                    location.replace(`${FRONTEND_URL}/dashboard.php`);
                }else {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        color: "#fff",
                        background: "#cc0202",
                        width: 350,
                        toast: true,
                        title: res.error,
                        showConfirmButton: false,
                        timer: 5000
                    })
                }
            })
            .finally(() => {
                document.getElementById('loginLoader').style.display = 'none'
                document.getElementById('submitText').style.display = 'block';
            })
        })

    </script>

</body>
</html>
