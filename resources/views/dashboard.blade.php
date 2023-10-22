<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800&display=swap" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}" />
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image"><img src="{{ asset('assets/images/uti.png') }}" alt="" /></div>
            <span class="logo_name">Tvent</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li>
                    <a href="/">
                        <i class="fa-solid fa-house"></i>
                        <span class="link-name">Home</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-clipboard"></i>
                        <span class="link-name">Dahsboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span class="link-name">Events</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-users"></i>
                        <span class="link-name">Contestants</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-calendar-day"></i>
                        <span class="link-name">Schedule</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-handshake-angle"></i>
                        <span class="link-name">Sponsor</span>
                    </a>
                </li>
                <li class="mode">
                    <a href="#">
                        <i class="fa-solid fa-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>

            <ul class="logout-mode">
                <li>
                    <a href="#">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="link-name">Logout</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-gear"></i>
                        <span class="link-name">Settings</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <input type="checkbox" id="toggle" />
            <label class="side-toggle sidebar-toggle" for="toggle"><span class="fas fa-bars"></span></label>

            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search here..." />
            </div>
            <div class="profile">
                <img class="profile-image" alt="no avaible image" src="{{ asset('assets/images/3.svg') }}" />
                <p class="profile-name">Adityamfu</p>
            </div>
        </div>
        <div class="popup-box">
            <div class="popup">
                <div class="content">
                    <header>
                        <p></p>
                        <i class="fa-solid fa-xmark"></i>
                    </header>
                    <form action="#">
                        <div class="row title">
                            <label>Title</label>
                            <input type="text" spellcheck="false" />
                        </div>
                        <div class="row description">
                            <label>Description</label>
                            <textarea spellcheck="false"></textarea>
                        </div>
                        <button></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="wrapper">
            <li class="add-box">
                <div class="icon"><i class="fa-solid fa-plus"></i></div>
                <p>Add new note</p>
            </li>
        </div>

        <main>
            <div class="dashboard-container">
                <!-- 4 cards top -->
                <div class="card total1">
                    <div class="info">
                        <div class="info-detail">
                            <h3>Users</h3>
                            <p>Lorem ipsem dolor</p>
                            <h2>1,873,250 <span>People</span></h2>
                        </div>
                        <div class="info-image">
                            <i class="fa-solid fa-users-line"></i>
                        </div>
                    </div>
                </div>

                <div class="card total2">
                    <div class="info">
                        <div class="info-detail">
                            <h3>Events</h3>
                            <p>Lorem ipsem dolor</p>
                            <h2>10,890 <span>Events</span></h2>
                        </div>
                        <div class="info-image">
                            <i class="fa-solid fa-calendar"></i>
                        </div>
                    </div>
                </div>

                <div class="card total3">
                    <div class="info">
                        <div class="info-detail">
                            <h3>Admins</h3>
                            <p>Lorem ipsem dolor</p>
                            <h2>340 <span>Admins</span></h2>
                        </div>
                        <div class="info-image">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                    </div>
                </div>

                <div class="card total4">
                    <div class="info">
                        <div class="info-detail">
                            <h3>News</h3>
                            <p>Lorem ipsem dolor</p>
                            <h2>56 <span>News</span></h2>
                        </div>
                        <div class="info-image">
                            <i class="fa-solid fa-newspaper"></i>
                        </div>
                    </div>
                </div>

                <!-- 2 cards bottom -->
                <div class="card detail">
                    <div class="detail-header">
                        <h2>All</h2>
                        <button>See More</button>
                    </div>
                    <table>
                        <tr>
                            <th>Code #</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Quantity</th>
                            <th>Created</th>
                            <th>Last Updated</th>
                        </tr>
                        <tr>
                            <td>#PW-0001</td>
                            <td>Potential Corp</td>
                            <td>
                                <span class="status onprogress"><i class="fas fa-circle"> ONPROGRESS</i></span>
                            </td>
                            <td>300 Ppl</td>
                            <td>Apr 11, 2021</td>
                            <td>Today</td>
                        </tr>
                        <tr>
                            <td>#PW-0002</td>
                            <td>Webcode inc</td>
                            <td>
                                <span class="status confirmed"><i class="fas fa-circle"> CONFIRMED</i></span>
                            </td>
                            <td>50 Ppl</td>
                            <td>Mar 29, 2021</td>
                            <td>Yesteday</td>
                        </tr>
                        <tr>
                            <td>#PW-0003</td>
                            <td>Codding time</td>
                            <td>
                                <span class="status fulfilled"><i class="fas fa-circle"> FULFILLED</i></span>
                            </td>
                            <td>100 Ppl</td>
                            <td>Feb 10, 2020</td>
                            <td>Feb 21, 2021</td>
                        </tr>
                        <tr>
                            <td>#PW-0004</td>
                            <td>Microsoft</td>
                            <td>
                                <span class="status fulfilled"><i class="fas fa-circle"> FULFILLED</i></span>
                            </td>
                            <td>6,239.5</td>
                            <td>Dec 11, 2020</td>
                            <td>Jan 23, 2021</td>
                        </tr>
                        <tr>
                            <td>#PW-0005</td>
                            <td>Apple inc</td>
                            <td>
                                <span class="status confirmed"><i class="fas fa-circle"> CONFIRMED</i></span>
                            </td>
                            <td>187.13 USD</td>
                            <td>Nov 20, 2020</td>
                            <td>Jan 09, 2021</td>
                        </tr>
                        <tr>
                            <td>#PW-0006</td>
                            <td>Penerang</td>
                            <td>
                                <span class="status onprogress"><i class="fas fa-circle"> ONPROGRESS</i></span>
                            </td>
                            <td>624.65 USD</td>
                            <td>Nov 01, 2020</td>
                            <td>Dec 15, 2020</td>
                        </tr>
                        <tr>
                            <td>#PW-0007</td>
                            <td>Paralon Corp</td>
                            <td>
                                <span class="status confirmed"><i class="fas fa-circle"> CONFIRMED</i></span>
                            </td>
                            <td>2,483.09 USD</td>
                            <td>Oct 13, 2020</td>
                            <td>Oct 21, 2020</td>
                        </tr>
                        <tr>
                            <td>#PW-0008</td>
                            <td>Coding Scale</td>
                            <td>
                                <span class="status onprogress"><i class="fas fa-circle"> ONPROGRESS</i></span>
                            </td>
                            <td>1,247.00 USD</td>
                            <td>Sep 20, 2020</td>
                            <td>Oct 13, 2020</td>
                        </tr>
                    </table>
                </div>
                <div class="card customer">
                    <h2>Events Activities</h2>
                    <div class="customer-wrapper">
                        <img class="customer-image" alt="no avaible image" src="{{ asset('assets/images/uti.png') }}" />
                        <div class="customer-name">
                            <h4>Mollitia rerum</h4>
                            <p>Lorem ipsum dolor sit amet.</p>
                        </div>
                        <p class="customer-date">Today</p>
                    </div>
                    <div class="customer-wrapper">
                        <img class="customer-image" alt="no avaible image" src="{{ asset('assets/images/uti.png') }}" />
                        <div class="customer-name">
                            <h4>Mollitia rerum</h4>
                            <p>Lorem ipsum dolor sit amet.</p>
                        </div>
                        <p class="customer-date">Today</p>
                    </div>
                </div>
            </div>
        </main>
    </section>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
</body>

</html>