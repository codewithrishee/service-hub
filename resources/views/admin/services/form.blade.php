@extends('layouts.admin')

@section('title', isset($service) ? 'Edit Service' : 'Add Service')

@section('content')

    <div class="admin-page-header">

        <span class="admin-page-eyebrow">
            ServiceHub admin
        </span>

        <h1>
            {{ isset($service) ? 'Edit Service' : 'Add Service' }}
        </h1>

        <p>
            {{ isset($service)
                ? 'Update the details of this service.'
                : 'Create a new service for your customers.'
            }}
        </p>

    </div>


    <div class="admin-card">

        <div class="admin-card-header">

            <div>

                <h3>Service Information</h3>

                <p>
                    Enter complete service details below.
                </p>

            </div>

        </div>


        <div class="p-4">

            <form
                action="{{ isset($service)
                    ? route('admin.services.update', $service)
                    : route('admin.services.store')
                }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @if(isset($service))
                    @method('PUT')
                @endif


                <div class="row g-4">


                    {{-- CATEGORY --}}

                    <div class="col-md-6">

                        <label for="category_id" class="form-label">
                            Category
                        </label>

                        <select
                            id="category_id"
                            name="category_id"
                            class="form-select @error('category_id') is-invalid @enderror"
                        >

                            <option value="">
                                Select Category
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id', $service->category_id ?? '') == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- SERVICE NAME --}}

                    <div class="col-md-6">

                        <label for="name" class="form-label">
                            Service Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $service->name ?? '') }}"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="e.g. Full Home Deep Cleaning"
                        >

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- SLUG --}}

                    <div class="col-md-6">

                        <label for="slug" class="form-label">
                            Slug
                        </label>

                        <input
                            type="text"
                            id="slug"
                            name="slug"
                            value="{{ old('slug', $service->slug ?? '') }}"
                            class="form-control @error('slug') is-invalid @enderror"
                            placeholder="e.g. full-home-deep-cleaning"
                        >

                        @error('slug')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- MAIN IMAGE --}}

                    <div class="col-md-6">

                        <label for="image" class="form-label">
                            Main Image
                        </label>

                        <input
                            type="file"
                            id="image"
                            name="image"
                            class="form-control @error('image') is-invalid @enderror"
                            accept="image/jpeg,image/png,image/webp"
                        >

                        <small class="text-muted">
                            JPG, PNG or WebP — Maximum 2MB.
                        </small>

                        @if(isset($service) && $service->image)

                            <div class="mt-3">

                                <img
                                    src="{{ str_starts_with($service->image, 'http')
                                        ? $service->image
                                        : asset('storage/' . $service->image)
                                    }}"
                                    alt="{{ $service->name }}"
                                    style="width: 120px; height: 80px; object-fit: cover; border-radius: 8px;"
                                >

                                <div class="small text-muted mt-1">
                                    Current image
                                </div>

                            </div>

                        @endif

                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- PRICE --}}

                    <div class="col-md-4">

                        <label for="price" class="form-label">
                            Starting Price
                        </label>

                        <input
                            type="number"
                            id="price"
                            name="price"
                            value="{{ old('price', $service->price ?? '') }}"
                            class="form-control @error('price') is-invalid @enderror"
                            placeholder="e.g. 799"
                            min="0"
                            step="0.01"
                        >

                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- DURATION --}}

                    <div class="col-md-4">

                        <label for="duration" class="form-label">
                            Duration (Minutes)
                        </label>

                        <input
                            type="number"
                            id="duration"
                            name="duration"
                            value="{{ old('duration', $service->duration ?? '') }}"
                            class="form-control @error('duration') is-invalid @enderror"
                            placeholder="e.g. 90"
                            min="1"
                        >

                        @error('duration')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- RATING --}}

                    <div class="col-md-2">

                        <label for="rating" class="form-label">
                            Rating
                        </label>

                        <input
                            type="number"
                            id="rating"
                            name="rating"
                            value="{{ old('rating', $service->rating ?? 0) }}"
                            class="form-control @error('rating') is-invalid @enderror"
                            min="0"
                            max="5"
                            step="0.1"
                            placeholder="4.9"
                        >

                        @error('rating')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- REVIEWS --}}

                    <div class="col-md-2">

                        <label for="review_count" class="form-label">
                            Reviews
                        </label>

                        <input
                            type="number"
                            id="review_count"
                            name="review_count"
                            value="{{ old('review_count', $service->review_count ?? 0) }}"
                            class="form-control @error('review_count') is-invalid @enderror"
                            min="0"
                            placeholder="128"
                        >

                        @error('review_count')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- DESCRIPTION --}}

                    <div class="col-12">

                        <label for="description" class="form-label">
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Enter complete service description..."
                        >{{ old('description', $service->description ?? '') }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- GALLERY --}}

                    <div class="col-12">

                        <label for="gallery" class="form-label">
                            Gallery Images
                        </label>

                        <input
                            type="file"
                            id="gallery"
                            name="gallery[]"
                            class="form-control @error('gallery') is-invalid @enderror"
                            accept="image/jpeg,image/png,image/webp"
                            multiple
                        >

                        <small class="text-muted">
                            Select multiple images. Maximum 6 images, 2MB each.
                        </small>

                        @error('gallery')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror


                        @error('gallery.*')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror


                        @if(isset($service) && is_array($service->gallery) && count($service->gallery))

                            <div class="row g-3 mt-2">

                                @foreach($service->gallery as $galleryImage)

                                    <div class="col-md-2">

                                        <img
                                            src="{{ str_starts_with($galleryImage, 'http')
                                                ? $galleryImage
                                                : asset('storage/' . $galleryImage)
                                            }}"
                                            alt="Gallery Image"
                                            style="width:100%; height:100px; object-fit:cover; border-radius:8px;"
                                        >

                                    </div>

                                @endforeach

                            </div>

                            <small class="text-muted d-block mt-2">
                                Select new gallery images only if you want to replace the current gallery.
                            </small>

                        @endif

                    </div>


                    {{-- INCLUDED --}}

                    <div class="col-md-6">

                        <label class="form-label">
                            What's Included
                        </label>

                        @for($i = 0; $i < 8; $i++)

                            <input
                                type="text"
                                name="included[]"
                                value="{{ old('included.' . $i, $service->included[$i] ?? '') }}"
                                class="form-control mb-2"
                                placeholder="Included item {{ $i + 1 }}"
                            >

                        @endfor

                    </div>


                    {{-- EXCLUDED --}}

                    <div class="col-md-6">

                        <label class="form-label">
                            What's Not Included
                        </label>

                        @for($i = 0; $i < 4; $i++)

                            <input
                                type="text"
                                name="excluded[]"
                                value="{{ old('excluded.' . $i, $service->excluded[$i] ?? '') }}"
                                class="form-control mb-2"
                                placeholder="Excluded item {{ $i + 1 }}"
                            >

                        @endfor

                    </div>


                    {{-- HOW IT WORKS --}}

                    <div class="col-12">

                        <label class="form-label">
                            How It Works
                        </label>

                        <div class="row g-3">

                            @for($i = 0; $i < 3; $i++)

                                <div class="col-md-4">

                                    <label class="form-label text-muted">
                                        Step {{ $i + 1 }}
                                    </label>

                                    <input
                                        type="text"
                                        name="how_it_works[]"
                                        value="{{ old('how_it_works.' . $i, $service->how_it_works[$i] ?? '') }}"
                                        class="form-control"
                                        placeholder="e.g. Book"
                                    >

                                </div>

                            @endfor

                        </div>

                    </div>


                    {{-- SERVICE AREA --}}

                    <div class="col-md-6">

                        <label for="service_area" class="form-label">
                            Service Area
                        </label>

                        <input
                            type="text"
                            id="service_area"
                            name="service_area"
                            value="{{ old('service_area', $service->service_area ?? '') }}"
                            class="form-control @error('service_area') is-invalid @enderror"
                            placeholder="e.g. Delhi NCR"
                        >

                        @error('service_area')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- AVAILABILITY --}}

                    <div class="col-md-6">

                        <label for="availability" class="form-label">
                            Availability
                        </label>

                        <input
                            type="text"
                            id="availability"
                            name="availability"
                            value="{{ old('availability', $service->availability ?? '') }}"
                            class="form-control @error('availability') is-invalid @enderror"
                            placeholder="e.g. Mon - Sun"
                        >

                        @error('availability')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- VERIFIED --}}

                    <div class="col-md-6">

                        <label for="verified" class="form-label">
                            Verified Service
                        </label>

                        <select
                            id="verified"
                            name="verified"
                            class="form-select @error('verified') is-invalid @enderror"
                        >

                            <option
                                value="1"
                                {{ old('verified', $service->verified ?? 0) == 1 ? 'selected' : '' }}
                            >
                                Verified
                            </option>

                            <option
                                value="0"
                                {{ old('verified', $service->verified ?? 0) == 0 ? 'selected' : '' }}
                            >
                                Not Verified
                            </option>

                        </select>

                        @error('verified')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- STATUS --}}

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
                                {{ old('status', $service->status ?? 1) == 1 ? 'selected' : '' }}
                            >
                                Active
                            </option>

                            <option
                                value="0"
                                {{ old('status', $service->status ?? 1) == 0 ? 'selected' : '' }}
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


                {{-- BUTTONS --}}

                <div class="mt-4 d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-success"
                    >

                        <i class="bi bi-check-lg me-1"></i>

                        {{ isset($service) ? 'Update Service' : 'Save Service' }}

                    </button>


                    <a
                        href="{{ route('admin.services.index') }}"
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