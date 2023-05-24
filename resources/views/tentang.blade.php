@extends('layouts.mainlayout')
@section('title', 'Tentang')
<!-- partial -->
@section('content')
    <div class="card" style="border-radius: 2px;">
        <div class="card-body">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Tentang</h2>
                        <p> S-kepuharjo merupakan aplikasi berbasis website dan mobile kepuharjo ini dapat
                            digunakan oleh pihak masyarakat,
                            RT, dan RW serta website khusus untuk
                            pihak Admin Kelurahan yang digunakan untuk menampung surat sekaligus digunakan untuk data master
                            dari masyarakat, dan
                            diharapkan juga aplikasi pengajuan surat untuk masyarakat ini dapat dilakukan dimanapun dan
                            kapanpun sehingga menjadi
                            lebih efektif dan efisien.
                        </p>
                        <p>
                            S-Kepuharjo termasuk upaya meningkatkan transparansi, kontrol serta
                            akuntabilitas kinerja kelurahan dalam
                            proses penanganan surat pengajuan dari
                            masyarakat. Memperbaiki kualitas pelayanan publik untuk pengajuan surat pada tahap RT/RW,
                            terutama dalam hal
                            efektivitas dan efisiensi yang bisa memakan waktu berhari hari karena situasi pandemi.
                            Mempermudah masyarakat dalam melakukan pengajuan berbagai macam jenis surat kepada pihak
                            kelurahan
                        </p>
                        <p>
                            Fitur Fitur Aplikasi S-Kepuharjo
                        </p>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('image/icon-laman-tentang (1).png') }}" alt="About Image" class="img-fluid">
                    </div>
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
