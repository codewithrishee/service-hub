@extends('layouts.admin')

@section('title', 'Categories')

@section('content')

    <div class="admin-page-header d-flex justify-content-between align-items-center">

        <div>

            <span class="admin-page-eyebrow">
                ServiceHub admin
            </span>

            <h1>Categories</h1>

            <p>Manage all service categories.</p>

        </div>

        <a href="{{ route('admin.categories.create') }}"
           class="btn btn-success">

            <i class="bi bi-plus-lg me-1"></i>
            Add Category

        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show mb-4"
             role="alert">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Validation / Error Message --}}
    @if($errors->any())

        <div class="alert alert-danger alert-dismissible fade show mb-4"
             role="alert">

            <i class="bi bi-exclamation-triangle-fill me-2"></i>

            Please check the form and try again.

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <div class="admin-card">

        <div class="admin-card-header">

            <div>

                <h3>All Categories</h3>

                <p>
                    {{ $categories->count() }} categories found
                </p>

            </div>

        </div>


        <div class="table-responsive">

            <table class="admin-table">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Name</th>

                        <th>Slug</th>

                        <th>Description</th>

                        <th>Status</th>

                        <th>Created</th>

                        <th>Actions</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($categories as $category)

                        <tr>

                            {{-- ID --}}
                            <td>

                                {{ $loop->iteration }}

                            </td>


                            {{-- Name + Icon --}}
                            <td>

                                @if($category->icon)

                                    <i class="{{ $category->icon }} me-2"></i>

                                @endif

                                <strong>
                                    {{ $category->name }}
                                </strong>

                            </td>


                            {{-- Slug --}}
                            <td>

                                <span class="text-muted">

                                    {{ $category->slug }}

                                </span>

                            </td>


                            {{-- Description --}}
                            <td>

                                <span>

                                    {{ \Illuminate\Support\Str::limit($category->description, 45) }}

                                </span>

                            </td>


                            {{-- Status --}}
                            <td>

                                @if($category->status)

                                    <span class="admin-status status-completed">

                                        Active

                                    </span>

                                @else

                                    <span class="admin-status status-cancelled">

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            {{-- Created --}}
                            <td>

                                {{ $category->created_at?->format('d M Y') ?? '—' }}

                            </td>


                            {{-- Actions --}}
                            <td>

                                <div class="d-flex align-items-center gap-2">

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       title="Edit">

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    {{-- Delete --}}
                                    <form
                                        action="{{ route('admin.categories.destroy', $category) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this category?');"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Delete"
                                        >

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7">

                                <div class="admin-empty-state">

                                    <i class="bi bi-tags"></i>

                                    <h4>No categories found</h4>

                                    <p>
                                        Create your first service category.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

@endsection