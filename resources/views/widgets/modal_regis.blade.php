<div id='join-lomba-modal' class="modal bg-modal">
    <div class="modal-content">
        <div style="font-size: 2em; margin-bottom: 0.5em;">
            Join 
            <span id="nama-lomba-modal"></span>
        </div>
        <div id='form-join-lomba'></div>
    </div>
</div>

<div id='solo-form' style="display: none">
    <form method="POST" action="/lomba/register/solo">
        @csrf
        <input id='lomba-id-input' type="hidden" name="lomba_id">

        <label for="password">Konfirmasi Password:</label>
        <input autocomplete="off" type="password" name="password" id="password" placeholder="Password" required>

        <div class="CC">
            <button type="submit">Daftar</button>
            <button type="button" id="closeButton">Close</button>
        </div>
    </form>
</div>