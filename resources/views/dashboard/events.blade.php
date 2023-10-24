@extends('dashboard')

@section('content')
<h1>Events</h1>
<p>Welcome to the Events.</p>
<div class="card detail">
    <div class="detail-header">
        <h2>All</h2>
        <div class="crud">
            <button><i class="fa-solid fa-pen-clip"></i> <h5>Add</h5></button>
            <button><i class="fa-solid fa-trash"></i> <h5>Delete</h5></button>
        </div>
    </div>
    <table>
        <tr>
            <th>Code #</th>
            <th>Name</th>
            <th>Deskripsi</th>
            <th>Tempat</th>
            <th>Kuota</th>
            <th>Pendaftaran</th>
            <th>Penutupan</th>
            <th>Pelaksanaan</th>
            <th>Penyelenggara</th>
            <th>Action</th>
        </tr>
        <tr>
            <td class="show-tr-modal" data-tr-modal="tr-modal-1">#PW-0001</td>
            <td>Potential Corp</td>
            <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugiat fuga optio iste doloribus architecto suscipit repellendus ea. Nihil, modi! Sint?</td>
            <td>Aula Teknokrat</td>
            <td>
                <span class="status confirmed"><i class="fa-solid fa-user-group">30</i></span>
            </td>
            <td>11 Apr 2023</td>
            <td>20 Aug 2023</td>
            <td>1 Sep 2023</td>
            <td>HIMA FTIK</td>
            <td>
                <span class="edit-container">
                    <a href="#" title="Edit" class="show-modal" data-modal="editModal">Edit</a>
                </span>
                <span class="delete-container">
                    <a href="#" title="Delete" class="show-modal" data-modal="deleteModal">Del</a>
                </span>
            </td>
        </tr>
    </table>
    <div id="tr-modal-1" class="tr-modal">
        <!-- Isi tr-modal -->
        <div class="tr-modal-content">
            <div class="tr-det">
                <h2>Potential Corp</h2>
                <strong> #PW-0001</strong>
            </div>
            <ul>
                <li><strong>Deskripsi:</strong> <br>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fugiat fuga optio iste doloribus architecto suscipit repellendus ea. Nihil, modi! Sint?</li>
                <li class="tr-det inf">
                    <strong><i class="fa-solid fa-map-location-dot"></i>Aula Teknokrat</strong>
                    <strong><i class="fa-solid fa-users-line"></i>30</strong>
                </li>
                <li><strong>Pendaftaran:</strong>11 Apr 2023</li>
                <li><strong>Penutupan:</strong>20 Aug 2023</li>
                <li><strong>Pelaksanaan:</strong>1 Sep 2023</li>
                <li><strong><i class="fa-solid fa-people-group"></i></strong>HIMA FTIK</li>
            </ul>
        </div>
    </div>
    
    
    <div class="modal-overlay"></div>

    <!-- Modal Edit -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h2>Edit</h2>
            <p>Informasi untuk tombol Edit.</p>
            <button onclick="closeModal('editModal')">Tutup</button>
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