@extends('layouts.mainlayout')
@section('title', 'Tentang')
<!-- partial -->
@section('content')
    <div class="main-panel">
        <h4 class="font-weight-bold text-dark">Ini Halaman Tentang</h4>
        <div class="title">
            <h1>Tentang</h1>
        </div>

            <h3>Sistem Informasi Pengajuan Surat</h3>
            <p style="align=justify;" > S-kepuharjo merupakan aplikasi berbasis website dan mobile kepuharjo ini dapat
                digunakan oleh pihak masyarakat,
                RT, dan RW serta website khusus untuk
                pihak Admin Kelurahan yang digunakan untuk menampung surat sekaligus digunakan untuk data master
                dari masyarakat, dan
                diharapkan juga aplikasi pengajuan surat untuk masyarakat ini dapat dilakukan dimanapun dan
                kapanpun sehingga menjadi
                lebih efektif dan efisien.</p>
            <p style="align=justify;"> S-Kepuharjo termasuk upaya meningkatkan transparansi, kontrol serta
                akuntabilitas kinerja kelurahan dalam
                proses penanganan surat pengajuan dari
                masyarakat. Memperbaiki kualitas pelayanan publik untuk pengajuan surat pada tahap RT/RW,
                terutama dalam hal
                efektivitas dan efisiensi yang bisa memakan waktu berhari hari karena situasi pandemi.
                Mempermudah masyarakat dalam melakukan pengajuan berbagai macam jenis surat kepada pihak
                kelurahan</p>


    <div class="image-section">
        {{-- <img src="images/icon-laman-tentang.png"> --}}
    </div>
    <div class="image-section">
        {{-- <img src="images/icon-laman-tentang.png"> --}}
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
