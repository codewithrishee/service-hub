@forelse($categories as $category)

    <div>
        <h3>{{ $category->name }}</h3>

        <p>{{ $category->description }}</p>

    </div>

@empty

    <p>No categories available.</p>

@endforelse