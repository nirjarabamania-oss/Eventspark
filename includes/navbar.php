 <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">

    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand fw-bold fs-3 text-primary" href="index.php">
            <i class="bi bi-mortarboard-fill"></i>
            EventSpark
        </a>

        <!-- Mobile Menu Button -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        <!-- Navigation -->
        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav mx-auto">

                <li class="nav-item">
                    <a class="nav-link active" href="index.php">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="student/events.php">
                        Events
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php#categories">
                        Study Areas
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php#colleges">
                        Colleges
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php#why">
                        About
                    </a>
                </li>

            </ul>


            <!-- Login Dropdown -->
            <div class="dropdown me-2">

                <button class="btn btn-outline-primary dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">

                    Login

                </button>

                <ul class="dropdown-menu">

                    <li>
                        <a class="dropdown-item" href="student/login.php">
                            Student Login
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="college/login.php">
                            College Login
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="admin/login.php">
                            Admin Login
                        </a>
                    </li>

                </ul>

            </div>


            <!-- Register Dropdown -->
            <div class="dropdown">

                <button class="btn btn-primary dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">

                    Register

                </button>

                <ul class="dropdown-menu">

                    <li>
                        <a class="dropdown-item" href="student/register.php">
                            Student Register
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="college/register.php">
                            College Register
                        </a>
                    </li>

                </ul>

            </div>

        </div>

    </div>

</nav>