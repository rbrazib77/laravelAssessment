@extends('admin.layouts.bashboard_master')
@section('title', 'Admin User')
@section('admin')
    <div class="content">
        <!-- Start Content-->
        <div class="container-xxl">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Admin User</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>E-mail</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $users->firstItem() + $loop->index }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->created_at }}</td>
                                                <td>
                                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm delete-btn"
                                                        data-url="{{ route('user.destroy', $user->id) }}">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end mt-3">
                                    {{ $users->links() }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('delete-btn')) {
                const url = e.target.dataset.url;
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action will delete.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            }
        });
    </script>
@endpush
