@extends('layouts.mainlayout')
@section('title', 'Tentang')
<!-- partial -->
@section('content')
    <div class="main-panel">
        <h4 class="font-weight-bold text-dark">Ini Halaman Tentang</h4>
    </div>
    <!-- tombol untuk membuka modal -->
    <button onclick="openModal()">Buka Modal</button>

    <!-- modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Kartu Keluarga</h2>
            <div class="row">
                <div class="col-25">
                    <label for="nama">Nama:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="nama" name="nama">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="alamat">Alamat:</label>
                </div>
                <div class="col-75">
                    <textarea id="alamat" name="alamat"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="pekerjaan">Pekerjaan:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="pekerjaan" name="pekerjaan">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="telepon">Telepon:</label>
                </div>
                <div class="col-75">
                    <input type="text" id="telepon" name="telepon">
                </div>
            </div>
        </div>
    </div>

@endsection

<style>
    /* style untuk modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    /* style untuk konten modal */
    .modal-content {
        background-color: white;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 60%;
        border-radius: 10px;
    }

    /* style untuk tombol close */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* style untuk form dalam modal */
    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 10px 0;
    }

    .col-25 {
        flex: 25%;
        padding: 0 10px;
    }

    .col-75 {
        flex: 75%;
        padding: 0 10px;
    }

    input[type=text],
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
    }

    button {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }
</style>
{{--
<script>
    // mendapatkan modal
    var modal = document.getElementById("myModal");

    // mendapatkan tombol untuk membuka modal
    var btn = document.getElementsByTagName("
</script> --}}
