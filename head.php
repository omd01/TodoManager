<head>
  <style>
          * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.logo img {
    width: 60px;
}

.main-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 40px;
    background-color: #1f2937;
    height: 5rem;
    position: relative;
}

.nav-list {
    display: flex;
    gap: 1.5rem;
    align-items: center;
    list-style-type: none;
}

.nav-link:link,
.nav-link:visited {
    color: rgb(203, 213, 224);
    font-size: 1.2rem;
    font-weight: 400;
    text-decoration: none;
}
.nav-link:hover,
.nav-link:active {
    color: #fff;
}

.nav-link.login:link,
.nav-link.login:visited {
    background-color: rgb(203, 213, 224);
    color: black;
    padding: 10px 30px;
    border-radius: 15px;
    transition: background-color 0.3s;
}

.nav-link.login:hover,
.nav-link.login:active {
    background-color: rgb(139, 156, 174);
}

.menu-btn ion-icon[name="close-outline"] {
    display: none;
}

.menu-btn {
    background-color: transparent;
    border: none;
    cursor: pointer;
    display: none;
}

.menu-btn ion-icon {
    color: rgb(203, 213, 224);
    height: 2.5rem;
    width: 2.5rem;
}

@media (max-width: 640px) {
    .menu-btn {
        display: block;
    }

    .main-nav {
        /* display: none; */
        width: 100%;
        height: 100vh;
        background-color: #1f2937;
        position: absolute;
        top: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        /* display: none; */
        opacity: 0;
        pointer-events: none;
        visibility: hidden;
        transform: translateX(100%);
        transition: all 0.3s ease-in;
    }

    .nav-list {
        flex-direction: column;
        gap: 4rem;
    }

    .open-nav .main-nav {
        opacity: 1;
        pointer-events: auto;
        visibility: visible;
        transform: translateX(0%);
    }

    .open-nav .menu-btn ion-icon[name="close-outline"] {
        display: block;
    }
    .open-nav .menu-btn ion-icon[name="menu-outline"] {
        display: none;
    }
}

      </style></head>

<header class="main-header">
            <a class="logo" href=""><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6e/Microsoft_To-Do_icon.svg/2515px-Microsoft_To-Do_icon.svg.png" alt="logo" /></a>
            <nav class="main-nav">
                <ul class="nav-list">
                    <li><a class="nav-link" href="http://localhost/todomanager/index.php">Todo List</a></li>
                    <li><a class="nav-link" href="http://localhost/todomanager/clock">Clock</a></li>
                    <li><a class="nav-link" href="http://localhost/todomanager/Stopwatch/">Stopwatch</a></li>
                    <li><a class="nav-link" href="http://localhost/todomanager/weather/">Weather</a></li>
                    <li><a class="nav-link login" href="./logout.php">Logout</a></li>
                </ul>
            </nav>

            <button class="menu-btn">
                <ion-icon name="menu-outline"></ion-icon>
                <ion-icon name="close-outline"></ion-icon>
            </button>
        </header>


        <script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
        <script>
          const headerEl = document.querySelector(".main-header");
          const navToggleEl = document.querySelector(".menu-btn");
          navToggleEl.addEventListener("click", function () {
          headerEl.classList.toggle("open-nav");
          });
        </script>
