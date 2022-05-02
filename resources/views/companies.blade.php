@extends('layouts.master')
@section('css')
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الشركات المنتجة</h4>
            </div>

            <!-- breadcrumb -->
            @endsection
            @section('content')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session()->has('Add'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('Add') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(session()->has('delete'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('delete') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(session()->has('edit'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('edit') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <!-- row -->
                <div class="row">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card mg-b-20">
                                <div class="card-header pb-0">
                                    <div class="d-flex justify-content-between">
                                        <a class="modal-effect btn btn-outline-primary btn-block"
                                           data-effect="effect-scale"
                                           data-toggle="modal" href="#modaldemo8">إضافة شركة</a>

                                    </div>

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="table key-buttons text-md-nowrap">
                                            <thead>
                                            <tr>
                                                <th class="border-bottom-0"> رقم الشركة</th>
                                                <th class="border-bottom-0"> اسم الشركة</th>
                                                <th class="border-bottom-0"> وصف الشركة</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php $i = 0; ?>
                                            @foreach ($companies as $x)
                                                <?php $i++; ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td> {{ $x->name }}</td>
                                                    <td>{{ $x->description }}</td>
                                                    <td>
                                                        <a class="modal-effect btn btn-sm btn-info"
                                                           data-effect="effect-scale" data-id="{{ $x->id }}"
                                                           data-name="{{ $x->name }}"
                                                           data-description="{{ $x->description }}"


                                                           data-toggle="modal"
                                                           href="#exampleModal2" title="تعديل"><i
                                                                class="las la-pen"></i></a>

                                                        <a class="modal-effect btn btn-sm btn-danger"
                                                           data-effect="effect-scale" data-id="{{ $x->id }}"
                                                           data-name="{{ $x->name }}"
                                                           data-description="{{ $x->description }}"
                                                           data-toggle="modal"
                                                           href="#modaldemo9" title="حذف"><i
                                                                class="las la-trash"></i></a>

                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Basic modal -->

                            <div class="modal" id="modaldemo8">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title">اضافة شركة</h6>
                                            <button aria-label="Close"
                                                    class="close" data-dismiss="modal" type="button"><span
                                                    aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('companies.store') }}" method="post">
                                                {{ csrf_field() }}

                                                <div class="form-group">
                                                    <label for="name">اسم الشركة</label>
                                                    <input type="text" class="form-control" id="name" name="name">
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1"> وصف الشركة </label>
                                                    <input type="text" class="form-control" id="email"
                                                           name="description">
                                                </div>


                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">تاكيد</button>
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">اغلاق
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Basic modal -->
                            </div>


                            <!-- edit -->
                            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">تعديل الشركة</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <form action="companies/update" method="post" autocomplete="off">
                                                {{method_field('patch')}}
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <input type="hidden" name="id" id="id" value="">
                                                    <label for="recipient-name" class="col-form-label">اسم
                                                        الشركة:</label>
                                                    <input class="form-control" name="name" id="name" type="text">
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" name="id" id="id" value="">
                                                    <label for="recipient-name" class="col-form-label">وصف الشركة
                                                        :</label>
                                                    <input class="form-control" name="description" id="description"
                                                           type="text">
                                                </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">تاكيد</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق
                                            </button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- delete -->

                            <div class="modal" id="modaldemo9">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title">حذف شركة</h6>
                                            <button aria-label="Close" class="close" data-dismiss="modal"
                                                    type="button"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <form action="companies/destroy" method="post">
                                            {{method_field('delete')}}
                                            {{csrf_field()}}
                                            <div class="modal-body">
                                                <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                                <input type="hidden" name="id" id="id" value="">
                                                <input class="form-control" name="name" id="name" type="text" readonly>
                                                <input class="form-control" name="description" id="email" type="text"
                                                       readonly>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    الغاء
                                                </button>
                                                <button type="submit" class="btn btn-danger">تاكيد</button>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>

                            <!-- row closed -->
                        </div>
                        <!-- Container closed -->
                    </div>
                    <!-- main-content closed -->
                    @endsection
                    @section('js')
                        <!-- Internal Data tables -->
                        <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
                        <script
                            src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
                        <script
                            src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
                        <script
                            src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
                        <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
                        <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
                        <script
                            src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
                        <script
                            src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
                        <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
                        <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
                        <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
                        <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
                        <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
                        <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
                        <script
                            src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
                        <script
                            src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
                        <!--Internal  Datatable js -->
                        <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
                        <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
                        {{-- edit button --}}
                        <script>
                            $('#exampleModal2').on('show.bs.modal', function (event) {
                                var button = $(event.relatedTarget)
                                // var id = button.data('id')
                                var name = button.data('name')
                                var description = button.data('description')


                                var modal = $(this)
                                // modal.find('.modal-body #id').val(id);
                                modal.find('.modal-body #name').val(name);
                                modal.find('.modal-body #description').val(description);


                            })
                        </script>
                        {{-- delete button --}}
                        <script>
                            $('#modaldemo9').on('show.bs.modal', function (event) {
                                var button = $(event.relatedTarget)
                                // var id = button.data('id')
                                var name = button.data('name')
                                var description = button.data('description')


                                var modal = $(this)
                                // modal.find('.modal-body #id').val(id);
                                modal.find('.modal-body #name').val(name);
                                modal.find('.modal-body #description').val(description);

                            })
                        </script>
@endsection
