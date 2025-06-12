@extends ('newFrontend.master')

@section('content')
<link href="{{ asset('newFrontend/Clasifico/assets/css/userdashboard.css') }}" rel="stylesheet">
<style>


    .active-category {
        background-color:rgb(175, 76, 76) !important;
        color: white !important;
    }

    .active-subcategory {
        background-color: rgb(175, 76, 76) !important;
        color: white !important;
    }



.main-categories {
    margin: 20px 0;
}

.category-item {
    display: flex;
    align-items: center;
    cursor: pointer;
    margin-bottom: 10px;
    padding: 10px;
    background-color: #f7f7f7;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.category-item:hover {
    background-color: #e0e0e0;
}

.category-name {
    font-size: 18px;
    flex-grow: 1;
}

.right-arrow {
    font-size: 18px;
    transition: transform 0.3s ease;
}

.subcategory-list-container {
    margin-top: 10px;
    margin-bottom: 10px;
    margin-left: 20px;
    padding: 15px;
    border-left: 2px solid #dc3545;
    /* background-color: #fff8f8; */

}

.subcategory-title {
    font-size: 16px;
    margin-bottom: 10px;
    color: #b02a37;
    font-weight: bold;
}

/* Search box style */
.subcategory-search {
    width: 100%;
    padding: 10px;
    margin-bottom: 16px; /* Increase spacing to separate from items */
    border-radius: 10px;
    border: 1px solid #b02a37;
    outline: none;
    background-color: #fff;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
    font-size: 14px;
}

/* Subcategory item */
.subcategory-item {
    background-color: #fff;
    padding: 8px 12px;
    margin-bottom: 6px;
    border: 1px solid #ddd;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.2s ease;
    font-size: 14px;
}

.subcategory-item:hover {
    background-color: #ffe5e5;
    border-color: #dc3545;
    font-weight: 500;
}

/* Empty or error message style */
.no-subcategories,
.subcategory-error {
    color: #888;
    font-style: italic;
}







</style>

<section  class="page-title style-two banner-part" style="background-image: url(assets/images/background/page-title.jpg); height:350px">
        <div class="auto-container">
            @if(Auth::check() && Auth::user()->roles != 'staff')
            <div class="mr-0 content-box centred">
                <div class="title">
                    <h1>@lang('messages.Dashboard')</h1>
                </div>
                <ul class="clearfix bread-crumb">
                    <li><a href="{{ route('/') }}">@lang('messages.Home')</a></li>
                    <li>@lang('messages.Dashboard')</li>
                </ul>
            </div>
            @endif
        </div>
    </section>
    <!-- End Page Title -->

        <section class="mb-4 dash-header-part">
                    <div class="container" >
                        <div class="dash-header-card"  style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); min-height:230px; height:auto" >
                            <div class="row">
                                <div class="col-lg-5">
                                <div class="dash-header-left">
                                  <div class="dash-avatar">
                                        @if(Auth::check() && Auth::user()->profileImage)
                                            <a href="#"><img src="{{ url('storage/profile_images/' . Auth::user()->profileImage) }}"
                                            alt="user"></a>
                                        @else
                                            <a href="#"><img src="{{ url('web/images/user.png') }}" alt="user"></a>
                                        @endif
                                    </div>

                                    <div class="dash-intro">
                                        <h4><a href="#">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a></h4>
                                        <h5>{{ Auth::user()->email }}</h5>

                                        <ul class="dash-meta">
                                            <li>
                                                <i class="fas fa-phone"></i>
                                                <span>{{ Auth::user()->phone_number }}</span>
                                            </li>
                                            <li>
                                                <i class="fas fa-envelope"></i>
                                                <span>{{ Auth::user()->email }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                                @if(Auth::check() && Auth::user()->roles != 'staff')
                                <div class="col-lg-7">
                                    <div class="dash-header-right">
                                        <div class="dash-focus dash-list">
                                            <h2>Post</h2>
                                            <p>Your Ads</p>
                                        </div>
                                        <div class="dash-focus dash-book">
                                            <h2>Need</h2>
                                            <p> To Buy</p>
                                        </div>
                                        <div class="dash-focus dash-rev">
                                            <h2>Boost</h2>
                                            <p>Your Ads'</p>
                                        </div>
                                    </div>
                                </div>
                                @endif
            </div>



                <div class="row">
                    <div class="col-lg-12">
                        <div class="dash-menu-list">
                            <ul>
                                @if(Auth::check() && Auth::user()->roles != 'staff')
                                <li><a href="{{route('user.dashboard')}}">@lang('messages.Dashboard')</a></li>
                                @endif
                                <li><a  class="active" href="{{route('user.ad_posts.categories')}}">@lang('messages.ad post')</a></li>@if(Auth::check() && Auth::user()->roles != 'staff')
                                <li><a href="{{route('user.my_ads')}}" >@lang('messages.my ads')</a></li>
                                <li><a href="{{route('user.profile')}}">@lang('messages.Profile')</a></li>@endif
                                {{-- <li><a href="">@lang('messages.message')</a></li> --}}
                                <li>
                                    <a href="{{route('user.logout')}}">@lang('messages.Logout')</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="setting-part">
    <div class="container">
        <div class="row">
            <div class="mb-3 col-lg-6">
                <div class="p-4 account-card alert fade show" style="border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                    <h4> @lang('messages.Main Categories')</h4>

                    <!-- Main Category List -->
                <div class="main-categories">
                    @foreach($categories->take(14) as $category)
                        <div class="category-item-wrapper">
                            <div class="category-item" onclick="toggleSubcategories('{{ $category->id }}', this)">
                                <div class="main-category-name" style="color:black;font-weight: 500; margin: 8px 0;">
                                    @lang('messages.' . $category->name)
                                </div>
                            </div>
                            <div id="subcategories-{{ $category->id }}" class="subcategory-list"></div>
                        </div>
                    @endforeach
                </div>

                </div>
            </div>



            <!-- Submit Button -->
            <div class="mt-2 mb-4 col-lg-12">
                <button type="button" onclick="submitSelection()" class="theme-btn-one">
                    <span>Continue</span>
                </button>
            </div>
        </div>
    </div>
</div>



<script>
 let selectedCategoryId = null;
let selectedSubcategoryId = null;

function toggleSubcategories(categoryId, categoryElement) {
    selectedCategoryId = categoryId;

    // Highlight selected main category
    document.querySelectorAll('.category-item').forEach(el => el.classList.remove('active-category'));
    categoryElement.classList.add('active-category');

    const subcategoryDiv = document.getElementById(`subcategories-${categoryId}`);

    if (subcategoryDiv.style.display === 'block') {
        subcategoryDiv.style.display = 'none';
        return;
    }

    document.querySelectorAll('.subcategory-list').forEach(div => {
        div.style.display = 'none';
        div.innerHTML = '';
    });

    fetch(`/fetch-subcategories/${categoryId}`)
        .then(res => res.json())
        .then(data => {
            let html = `
                <div class="subcategory-list-container">
                    <h5 class="subcategory-title">Subcategories</h5>
                    <input type="text" class="subcategory-search" placeholder="Search..." onkeyup="filterSubcategories(this)">
                    <div class="subcategory-items">
            `;

            if (data.length > 0) {
                data.forEach(sub => {
                    html += `
                        <div class="subcategory-item" onclick="selectSubcategory('${sub.id}', this)">
                            ${sub.name}
                        </div>
                    `;
                });
            } else {
                html += `<p class="no-subcategories">No subcategories found.</p>`;
            }

            html += `
                    </div>
                </div>
            `;
            subcategoryDiv.innerHTML = html;
            subcategoryDiv.style.display = 'block';
        })
        .catch(err => {
            subcategoryDiv.innerHTML = '<p class="subcategory-error">Error loading subcategories. Please try again.</p>';
            subcategoryDiv.style.display = 'block';
        });
}


function filterSubcategories(input) {
    const filter = input.value.toLowerCase();
    const items = input.closest('.subcategory-list-container').querySelectorAll('.subcategory-item');

    items.forEach(item => {
        const text = item.textContent.toLowerCase();
        item.style.display = text.includes(filter) ? '' : 'none';
    });
}




function selectSubcategory(subcategoryId, subcategoryElement) {
    // Track the selected subcategory and mark it as active
    selectedSubcategoryId = subcategoryId;

    // Remove active class from all subcategories and add it to the selected one
    const allSubcategoryItems = document.querySelectorAll('.subcategory-item');
    allSubcategoryItems.forEach(item => {
        item.classList.remove('active-subcategory');
    });
    subcategoryElement.classList.add('active-subcategory');
}

function submitSelection() {
    if (selectedCategoryId && selectedSubcategoryId) {
        // Redirect with the selected categories as query parameters
        window.location.href = `/user/ad_posts/location?cat_id=${selectedCategoryId}&sub_cat_id=${selectedSubcategoryId}`;
    } else {
        alert('Please select both a category and a subcategory.');
    }
}


</script>





@endsection

