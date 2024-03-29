@extends('dashboard')

@section('content')
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
        {{-- <li class="add-box">
            <div class="icon"><i class="fa-solid fa-plus"></i></div>
            <p>Add new note</p>
        </li> --}}
    </div>


    <div class="dashboard-container">
        <div class="card total">
            <div class="info">
                <div class="info-detail">
                    <h3>Users</h3>
                    <p></p>
                    <h2>{{ \App\Models\User::all()->count() }}<br> <span>Jumlah Total</span></h2>
                </div>
                <div class="info-image">
                    <i class="fa-solid fa-users-line"></i>
                </div>
            </div>
        </div>

        <div class="card total">
            <div class="info">
                <div class="info-detail">
                    <h3>Events</h3>
                    <p></p>
                    <h2>{{ \App\Models\EventLomba::all()->count() }} <br> <span>Jumlah Total</span></h2>
                </div>
                <div class="info-image">
                    <i class="fa-solid fa-calendar"></i>
                </div>
            </div>
        </div>

        <div class="card total">
            <div class="info">
                <div class="info-detail">
                    <h3>Admins</h3>
                    <p></p>
                    <h2>{{ \App\Models\Admin::all()->count() }}<br> <span>Jumlah Total</span></h2>
                </div>
                <div class="info-image">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
            </div>
        </div>

        <div class="card total">
            <div class="info">
                <div class="info-detail">
                    <h3>Penyelenggara</h3>
                    <p></p>
                    <h2>{{ \App\Models\Penyelenggara::all()->count() }}<br> <span>Jumlah Total</span></h2>
                </div>
                <div class="info-image">
                    <i class="fa-solid fa-newspaper"></i>
                </div>
            </div>
        </div>

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
@endsection
