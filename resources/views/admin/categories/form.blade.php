@extends('layouts.admin')

@section('title', isset($category) ? 'Edit Category' : 'Add Category')

@section('content')

    <div class="admin-page-header">

        <span class="admin-page-eyebrow">
            ServiceHub admin
        </span>

        <h1>
            {{ isset($category) ? 'Edit Category' : 'Add Category' }}
        </h1>

        <p>
            {{ isset($category)
                ? 'Update the details of this service category.'
                : 'Create a new service category.'
            }}
        </p>

    </div>


    <div class="admin-card">

        <div class="admin-card-header">

            <div>

                <h3>
                    Category Information
                </h3>

                <p>
                    Enter the category details below.
                </p>

            </div>

        </div>


        <div class="p-4">

            <form
                action="{{ isset($category)
                    ? route('admin.categories.update', $category)
                    : route('admin.categories.store')
                }}"
                method="POST"
            >

                @csrf

                @if(isset($category))
                    @method('PUT')
                @endif


                <div class="row g-4">


                    {{-- Name --}}
                    <div class="col-md-6">

                        <label for="name" class="form-label">
                            Category Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $category->name ?? '') }}"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="e.g. Home Cleaning"
                        >

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Slug --}}
                    <div class="col-md-6">

                        <label for="slug" class="form-label">
                            Slug
                        </label>

                        <input
                            type="text"
                            id="slug"
                            name="slug"
                            value="{{ old('slug', $category->slug ?? '') }}"
                            class="form-control @error('slug') is-invalid @enderror"
                            placeholder="e.g. home-cleaning"
                        >

                        @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Icon --}}
                    <div class="col-md-6">

                        <label for="icon" class="form-label">
                            Icon
                        </label>

                        <input
                            type="text"
                            id="icon"
                            name="icon"
                            value="{{ old('icon', $category->icon ?? '') }}"
                            class="form-control @error('icon') is-invalid @enderror"
                            placeholder="e.g. bi bi-house"
                        >

                        <small class="text-muted">
                            Enter Bootstrap Icons class.
                        </small>

                        @error('icon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Description --}}
                    <div class="col-12">

                        <label for="description" class="form-label">
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Enter category description..."
                        >{{ old('description', $category->description ?? '') }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Status --}}
                    <div class="col-md-6">

                        <label for="status" class="form-label">
                            Status
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="form-select @error('status') is-invalid @enderror"
                        >

                            <option
                                value="1"
                                {{ old('status', $category->status ?? 1) == 1 ? 'selected' : '' }}
                            >
                                Active
                            </option>

                            <option
                                value="0"
                                {{ old('status', $category->status ?? 1) == 0 ? 'selected' : '' }}
                            >
                                Inactive
                            </option>

                        </select>

                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                </div>


                {{-- Buttons --}}
                <div class="mt-4 d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-success"
                    >

                        <i class="bi bi-check-lg me-1"></i>

                        {{ isset($category) ? 'Update Category' : 'Save Category' }}

                    </button>


                    <a
                        href="{{ route('admin.categories.index') }}"
                        class="btn btn-light border"
                    >

                        <i class="bi bi-arrow-left me-1"></i>

                        Cancel

                    </a>

                </div>


            </form>

        </div>

    </div>

@endsection