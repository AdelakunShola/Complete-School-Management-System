@extends('admin.admin_dashboard')
@section('admin')

<div class="content container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Settings</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="settings.html">Settings</a></li>
                    <li class="breadcrumb-item active">General Settings</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="settings-menu-links">
        <ul class="nav nav-tabs menu-tabs">
            <li class="nav-item active">
                <a class="nav-link" href="settings.html">All Applications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="localization-details.html">Localization</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="payment-settings.html">Payment Settings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="email-settings.html">Email Settings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="social-settings.html">Social Media Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="social-links.html">Social Links</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="seo-settings.html">SEO Settings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="others-settings.html">Others</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <a href="{{ route('add.application') }}" class="btn btn-outline-primary me-2"><i
                                        class="fas fa-plus"></i> ADD APPLICATION </a>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                    Download</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table
                            class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                            <thead class="student-thread">
                                <tr>
                                    <th>S/N</th>
                                    <th>Position</th>
                                    <th>Applicant Name</th>
                                    <th>Email</th>
                                    <th>Cover Letter</th>
                                    <th>CV</th>
                                    <th>Date Submitted</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allapplications as $key=> $item ) <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->vacancy ? $item->vacancy->name : 'Vacancy Not Found' }}</td>
                                    <td>{{ $item->applicant_name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        <a 
                                            class="btn btn-primary"> Cover Letter</a>
                                    </td>
                                    <td>
                                        <a  class="btn btn-primary"> CV</a>
                                    </td>
                                    <td>{{ $item->created_at->format('d M Y H:i:s') }}</td>
                                    <td>
                                        @if ($item->status == '0')
                                        <span class="text-success">Apllied</span>
                                        @elseif ($item->status == '1')
                                        <span class="text-info">onReview</span>
                                        @elseif ($item->status == '2')
                                        <span class="text-success">Interview</span>
                                        @elseif ($item->status == '3')
                                        <span class="text-success">Offered</span>
                                        @elseif ($item->status == '4')
                                        <span class="text-success">Hired</span>
                                        @elseif ($item->status == '5')
                                        <span class="text-danger">Declined</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <div class="actions">
                                        <a href="{{ route('edit.application', $item->id) }}"
                                                class="btn btn-sm text-success bg-success-light me-2"><i
                                                    class="feather-edit"></i></a>

                                            <a href="{{ route('view.application', $item->id) }}"
                                                class="btn btn-sm text-success bg-success-light me-2"><i
                                                    class="feather-eye"></i></a>
                                            <a class="btn btn-sm text-danger"
                                                onclick="confirmDelete('{{ route('delete.application', $item->id) }}')"><i
                                                    class="feather-trash"></i></a>
                                        </div>
                                    </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
