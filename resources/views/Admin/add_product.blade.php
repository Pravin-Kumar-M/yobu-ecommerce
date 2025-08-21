<!DOCTYPE html>
<html lang="en">

<head>
    @include('Admin.headTag')

    <style>
        .heading {
            font-weight: bold;
            color: black;
        }

        .form-select {
            border-radius: 0.5rem;
            width: 100%;
            padding: 5px;
        }
    </style>
</head>

<body>
    @include('Admin.header')

    <div class="d-flex align-items-stretch">
        @include('Admin.sidebar')

        <div class="page-content w-100">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Add Products</h2>
                </div>
            </div>


            <div class="container-fluid mt-5">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card shadow-lg border-0">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">Add New Product</h4>
                            </div>
                            <div class="card-body bg-white p-5">
                                <form action="{{url('upload_product')}}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <h5 class="mb-3 fw-bold text-primary">Product Information</h5>
                                    <div class="row mb-4">

                                        {{-- Product Name --}}

                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label heading">Product Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter product name" required>
                                        </div>

                                        {{-- Product Code --}}

                                        <div class="col-md-6 mb-3">
                                            <label for="product_code" class="form-label heading">Product Code (Optional)</label>
                                            <input type="text" class="form-control" name="product_code" id="product_code" placeholder="e.g., SKU-12345">
                                        </div>

                                        {{-- Description --}}

                                        <div class="col-12 mb-3">
                                            <label for="description" class="form-label heading">Description <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="description" id="description" rows="4" placeholder="Provide a detailed description of the product..." required></textarea>
                                        </div>

                                        {{-- Product Image --}}

                                        <div class="col-12 mb-3">
                                            <label for="image" class="form-label d-block heading">Product Image <span class="text-danger">*</span></label>

                                            <div id="drop-area" class="border border-dashed rounded-3 p-4 text-center">
                                                <p class="text-muted">Drag & drop image here or click to browse</p>
                                                <input type="file" name="image" id="image" accept="image/*"
                                                    style="opacity: 0; width: 1px; height: 1px; position: absolute;" required>
                                                <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('image').click()">Browse</button>
                                            </div>

                                            <div id="preview" class="mt-3 text-center"></div>

                                            <small class="form-text text-muted">Upload a clear image of your product (Max file size: 2MB).</small>
                                        </div>

                                    </div>

                                    <h5 class="mt-4 mb-3 fw-bold text-primary">Pricing Details</h5>
                                    <div class="row mb-4">

                                        {{-- Store Price --}}

                                        <div class="col-md-6 mb-3">
                                            <label for="store_price" class="form-label heading">Store Price <span class="text-danger">*</span></label>
                                            <input type="number" step="0.01" class="form-control" name="store_price" id="store_price" placeholder="e.g., $79.99" required>
                                            <small class="form-text text-muted">Input '$' values only</small>
                                        </div>

                                        {{-- Original Price --}}

                                        <div class="col-md-6 mb-3">
                                            <label for="original_price" class="form-label heading">Original Price (Optional)</label>
                                            <input type="number" step="0.01" class="form-control" name="original_price" id="original_price" placeholder="e.g., $99.99">
                                            <small class="form-text text-muted">Leave blank if no discount applies.</small>
                                        </div>
                                    </div>

                                    <h5 class="mt-4 mb-3 fw-bold text-primary">Categorization & Attributes</h5>
                                    <div class="row mb-4">

                                        {{-- Product Category --}}

                                        <div class="col-md-6 mb-3">
                                            <label for="category" class="form-label heading">Category <span class="text-danger">*</span></label>
                                            <select class="form-select" name="category" id="category" required>
                                                <option value="" class="text-muted" selected disabled hidden>Select Category</option>
                                                @foreach($category as $category)
                                                <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- Brand --}}

                                        <div class="col-md-6 mb-3">
                                            <label for="brand" class="form-label heading">Brand</label>
                                            <input type="text" class="form-control" name="brand" id="brand" placeholder="e.g., Nike, Samsung">
                                        </div>

                                        {{-- Size and Color --}}

                                        <div class="col-md-6 mb-3">
                                            <label for="size" class="form-label heading">Size (e.g., S, M, L, XL or 6, 8, 10)</label>
                                            <input type="text" class="form-control" name="size" id="size" placeholder="e.g., M, 10, One Size">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="color" class="form-label heading">Color</label>
                                            <input type="text" class="form-control" name="color" id="color" placeholder="e.g., Red, Blue, Black">
                                        </div>
                                    </div>

                                    <h5 class="mt-4 mb-3 fw-bold text-primary">Product Status & Visibility</h5>
                                    <div class="row mb-4">

                                        {{-- Quantity  --}}

                                        <div class="col-md-4 mb-3">
                                            <label for="stock" class="form-label heading">Stock Quantity <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="quantity" id="quantity" min="0" required>
                                            <small class="form-text text-muted">Current number of items in stock.</small>
                                        </div>

                                        {{-- Product Status --}}

                                        <div class="col-md-4 mb-3">
                                            <label for="status" class="form-label heading">Product Status <span class="text-danger">*</span></label>
                                            <select class="form-select" name="status" id="status" required>
                                                <option value="active" selected>Active</option>
                                                <option value="inactive">Inactive</option>

                                            </select>
                                        </div>

                                        {{-- SEO Slug --}}

                                        <div class="col-md-4 mb-3">
                                            <label for="slug" class="form-label heading">SEO Slug (optional)</label>
                                            <input type="text" class="form-control" name="slug" id="slug" placeholder="auto-generated if empty">
                                            <small class="form-text text-muted">Friendly URL for search engines.</small>
                                        </div>
                                    </div>

                                    <h5 class="mt-4 mb-3 fw-bold text-primary">Product Tags & Highlights</h5>
                                    <div class="row mb-4">

                                        {{-- Tags --}}

                                        <div class="col-md-6 mb-3">
                                            <label for="trending" class="form-label heading">Mark as Trending?</label>
                                            <select class="form-select" name="trending" id="trending">
                                                <option value="no" selected>No</option>
                                                <option value="yes">Yes</option>
                                            </select>
                                        </div>

                                        {{-- Featured --}}

                                        <div class="col-md-6 mb-3">
                                            <label for="featured" class="form-label heading">Mark as Featured?</label>
                                            <select class="form-select" name="featured" id="featured">
                                                <option value="no" selected>No</option>
                                                <option value="yes">Yes</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex mt-4 justify-content-center" style="gap: 15px;">
                                        <button type="submit"
                                            class="btn btn-primary px-4 py-2 rounded-pill shadow fw-semibold"
                                            onclick="confirmAdd(event, this)">
                                            <i class="bi bi-plus-circle me-2"></i> Add Product
                                        </button>

                                        <a href="{{ url('view_product') }}"
                                            class="btn btn-outline-secondary px-4 py-2 rounded-pill fw-semibold">
                                            <i class="bi bi-arrow-left me-2"></i> Back
                                        </a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('admincss/js/front.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmAdd(event, element) {
            event.preventDefault();

            const form = element.closest('form');

            // Check if form is valid before proceeding
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            Swal.fire({
                title: 'Are you sure you want to add this product?',
                text: "Please confirm to proceed.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirm',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    form.submit();
                }
            });
        }
    </script>

    <!-- drag and drop -->
    <script>
        const dropArea = document.getElementById('drop-area');
        const input = document.getElementById('image');
        const preview = document.getElementById('preview');

        // Highlight on drag
        ['dragenter', 'dragover'].forEach(event => {
            dropArea.addEventListener(event, e => {
                e.preventDefault();
                dropArea.classList.add('bg-light');
            });
        });

        // Unhighlight
        ['dragleave', 'drop'].forEach(event => {
            dropArea.addEventListener(event, e => {
                e.preventDefault();
                dropArea.classList.remove('bg-light');
            });
        });

        // Handle drop
        dropArea.addEventListener('drop', e => {
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                input.files = e.dataTransfer.files; // Assign dropped file to input
                showPreview(file);
            }
        });

        // Handle manual selection
        input.addEventListener('change', e => {
            const file = input.files[0];
            if (file && file.type.startsWith('image/')) {
                showPreview(file);
            }
        });

        function showPreview(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
            <div class="position-relative d-inline-block">
                <img src="${e.target.result}" alt="Preview" class="img-thumbnail" style="max-width: 250px; max-height: 250px;">
                <span class="position-absolute top-0 end-0 m-1 bg-light rounded-5" 
                      role="button" 
                      onclick="removePreview()" 
                      title="Remove" 
                      style="cursor: pointer; padding: 4px;">
                    <i class="bi bi-x-circle text-danger fs-4"></i>
                </span>
            </div>
        `;
            };
            reader.readAsDataURL(file);
        }


        function removePreview() {
            preview.innerHTML = '';
            input.value = ''; // This clears the selected file
        }
    </script>





</body>

</html>