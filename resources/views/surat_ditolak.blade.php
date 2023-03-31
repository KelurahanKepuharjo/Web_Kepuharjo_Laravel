@extends('layouts.mainlayout')
@section('title', 'Surat Ditolak')
<!-- partial -->
@section('content')

    <h4 class="font-weight-bold text-dark">Ini Halaman Surat Masuk</h4>
    <table id="myTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Kampus</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Edy Atthoillah</td>
                <td>Web Dev</td>
                <td>Lumajang</td>
                <td>20</td>
                <td>2002-10-20</td>
                <td>Politeknik Negeri Jember</td>
                <td>
                    <a class="btn btn-warning fa fa-pencil" data-toggle="modal" data-target="#exampleModal"
                        style="color: white;" href="#"></a>
                    <a class="btn btn-danger icon-trash" href="#" data-toggle="modal" data-target="#exampleModal"
                        style="margin-left: 10px; "></a>
                </td>
            </tr>
            <tr>
                <td>Nadia Ayu</td>
                <td>Web Dev</td>
                <td>Jember</td>
                <td>19</td>
                <td>2003-12-26</td>
                <td>Politeknik Negeri Jember</td>
                <td>
                    <a class="btn btn-warning fa fa-pencil" data-toggle="modal" data-target="#exampleModal"
                        style="color: white;" href="#"></a>
                    <a class="btn btn-danger icon-trash" data-toggle="modal" data-target="#exampleModal" href="#"
                        style="margin-left: 10px; "></a>
                </td>
            </tr>
            <tr>
                <td>Kurrota Akyun</td>
                <td>Web Dev</td>
                <td>Jember</td>
                <td>20</td>
                <td>2003-12-26</td>
                <td>Politeknik Negeri Jember</td>
                <td>
                    <a class="btn btn-warning fa fa-pencil" data-toggle="modal" data-target="#exampleModal"
                        style="color: white;" href="#"></a>
                    <a class="btn btn-danger icon-trash" data-toggle="modal" data-target="#exampleModal" href="#"
                        style="margin-left: 10px; "></a>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tempat, Tanggal Lahir </label>
                        <input type="text" name="ttl" class="form-control" value="" maxlength="50"
                            required="">
                    </div>
                    <div class="form-group">
                        <label>Kartu Keluarga</label>
                        <input type="hidden" id="idsurat" value="" />

                    </div>
                    <div class="form-group">
                        <img src="{{ asset('template/images/logo.png') }}" class="img-thumbnail" alt="Responsive image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
