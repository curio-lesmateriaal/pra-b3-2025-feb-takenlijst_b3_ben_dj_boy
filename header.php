<body>
    <div class="wrapper">
        <header>
            <div class="title">
            <img src="/img/logo.png" alt="logo">
            <h1>Task Manager</h1>
            </div>
            <div class="buttonsNav">
                <nav>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="<?php echo $base_url; ?>/logout.php"><button>Uitloggen</button></a>
            <?php else: ?>
                <a href="/login/login.php"><button>Inloggen</button></a>
            <?php endif; ?>
                    <a href="/index.php"><button>Home</button></a>
                    <a href="/task/index.php"><button>Taken Lijst</button></a>
                    <a href="/task/create.php"><button>Nieuwe Taak</button></a>
                    <a href="/task/done.php"><button>Voltooide taken</button></a>
                    <a href="/task/filter.php"><button>Filter</button></a>
                </nav>
            </div>
            <header>



        </header>