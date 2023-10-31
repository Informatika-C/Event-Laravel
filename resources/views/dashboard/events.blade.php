@extends('dashboard')

@section('content')
<h1>Events</h1>
<p>Welcome to the Events.</p>
<div class="card detail">
    <div class="detail-header">
        <h2>All</h2>
        <div class="crud">
            <button title="Add" class="show-modal" data-modal="addModal"><i class="fa-solid fa-pen-clip"></i> <h5>Add</h5></button>
            <button title="Delete" class="show-modal" data-modal="deleteModal"><i class="fa-solid fa-trash"></i> <h5>Delete</h5></button>
        </div>
    </div>
    <table>
        <thead>
        <tr>
            <th>
                <span class="custom-checkbox">
                    <input type="checkbox" id="checkbox_selectAll">
                    <label for="checkbox_selectAll"></label>
                </span>
            </th>
            <th>Code #</th>
            <th>Banner</th>
            <th>Name</th>
            <th>Deskripsi</th>
            <th>Tempat</th>
            {{-- <th>Kuota</th> --}}
            <th>Pendaftaran</th>
            <th>Penutupan</th>
            <th>Pelaksanaan</th>
            <th>Penyelenggara</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <span class="custom-checkbox">
                    <input type="checkbox" id="checkbox_selectAll">
                    <label for="checkbox_selectAll"></label>
                </span>
            </td>
            <td class="show-tr-modal" data-tr-modal="tr-modal-1">#PW-0001</td>
            <td><img class="banner" src="{{ asset('assets/images/card.png') }}" alt="banner"></td>
            <td>Campus Expo</td>
            <td class="descript">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugiat fuga optio iste doloribus architecto suscipit repellendus ea. Nihil, modi! Sint?</td>
            <td>Universitas Teknokrat Indonesia</td>
            {{-- <td>
                <span class="status confirmed"><i class="fa-solid fa-user-group">30</i></span>
            </td> --}}
            <td>11 Apr 2023</td>
            <td>20 Aug 2023</td>
            <td>1 Sep 2023</td>
            <td>HIMA FTIK</td>
            <td class="action">
                <span class="edit-container">
                    <a href="#" title="Edit" class="show-modal" data-modal="editModal">Edit</a>
                </span>
                <span class="delete-container">
                    <a href="#" title="Delete" class="show-modal" data-modal="deleteModal">Del</a>
                </span>
            </td>
        </tr>
        </tbody>
    </table>
    <div id="tr-modal-1" class="tr-modal">
        <!-- Isi tr-modal -->
        <div class="tr-modal-content">
            <div class="tr-det">
                <h2>Campus Expo</h2>
                <strong> #PW-0001</strong>
            </div>
            <ul>
                <li><strong>Deskripsi:</strong> <br>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugiat fuga optio iste doloribus architecto suscipit repellendus ea. Nihil, modi! Sint?</li>
                <li class="tr-det inf">
                    <strong><i class="fa-solid fa-map-location-dot"></i>Universitas Teknokrat Indonesia</strong>
                    {{-- <strong><i class="fa-solid fa-users-line"></i>30</strong> --}}
                    <strong><i class="fa-solid fa-people-group"></i>HIMA FTIK</strong>
                </li>
                <li><strong>Pendaftaran:</strong>11 Apr 2023</li>
                <li><strong>Penutupan:</strong>20 Aug 2023</li>
                <li><strong>Pelaksanaan:</strong>1 Sep 2023</li>
            </ul>
        </div>
    </div>
    
    
    <div class="modal-overlay"></div>

    <!-- Modal Add -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <h2>Add</h2>
            <form method="post">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>

                <label for="description">Description:</label>
                <textarea name="description" id="description" required></textarea>

                <label for="location">Location:</label>
                <input type="text" name="location" id="location" required>

                <label for="registration_date">Registration Date:</label>
                <input type="text" name="registration_date" id="registration_date" required>

                <label for="closing_date">Closing Date:</label>
                <input type="text" name="closing_date" id="closing_date" required>

                <label for="event_date">Event Date:</label>
                <input type="text" name="event_date" id="event_date" required>

                <label for="organizer">Organizer:</label>
                <input type="text" name="organizer" id="organizer" required>

            </form>
            <button type="submit">Add</button>
            <button onclick="closeModal('addModal')">Close</button>
        </div>
    </div>


    <!-- Modal Edit -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h2>Edit</h2>
            <form method="post">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>

                <label for="description">Description:</label>
                <textarea name="description" id="description" required></textarea>

                <label for="location">Location:</label>
                <input type="text" name="location" id="location" required>

                <label for="registration_date">Registration Date:</label>
                <input type="text" name="registration_date" id="registration_date" required>

                <label for="closing_date">Closing Date:</label>
                <input type="text" name="closing_date" id="closing_date" required>

                <label for="event_date">Event Date:</label>
                <input type="text" name="event_date" id="event_date" required>

                <label for="organizer">Organizer:</label>
                <input type="text" name="organizer" id="organizer" required>

            </form>
            <button type="submit">Confirm</button>
            <button onclick="closeModal('editModal')">Close</button>
        </div>
    </div>

    <!-- Modal Delete -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h2>Delete</h2>
            <p>Informasi untuk tombol Delete.</p>
            <button onclick="closeModal('deleteModal')">Tutup</button>
        </div>
    </div>

</div>
<script src="{{ asset('assets/js/modal.js') }}"></script>
@endsection