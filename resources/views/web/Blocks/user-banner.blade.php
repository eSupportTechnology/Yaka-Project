<section class="banner-part" style="height:350px !important;">
    <div class="container">
        <div class="banner-content">
            @php
                use Stichoza\GoogleTranslate\GoogleTranslate;

                try {
                    $bannerHeading = GoogleTranslate::trans(
                        'You can #Buy, #Rent, #Booking anything from here.', 
                        app()->getLocale()
                    );
                    $bannerDescription = GoogleTranslate::trans(
                        'Buy and sell everything from used cars to mobile phones and computers, or search for property, jobs and more in Sri Lanka.', 
                        app()->getLocale()
                    );
                } catch (\Exception $e) {
                    // Fallback to the original text in case of an error
                    $bannerHeading = 'You can #Buy, #Rent, #Booking anything from here.';
                    $bannerDescription = 'Buy and sell everything from used cars to mobile phones and computers, or search for property, jobs and more in Sri Lanka.';
                }
            @endphp
            
            <h1>{{ $bannerHeading }}</h1>
            <p>{{ $bannerDescription }}</p>
        </div>
    </div>
</section>
