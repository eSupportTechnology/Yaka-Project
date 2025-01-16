@extends('web.layout.layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12 pt-5 pb-5">
        <h2 class="text-center mt-5 mb-4">{{ GoogleTranslate::trans('Banner Ads', app()->getLocale()) }}</h2>
        <p class="text-center mb-4">{{ GoogleTranslate::trans('Banner ads are a great way to attract and engage with your target audience.', app()->getLocale()) }}</p>
        
        <ul class="banner-ads-list text-center">
          <li class="mb-2"><strong>{{ GoogleTranslate::trans('Number 1:', app()->getLocale()) }}</strong> {{ GoogleTranslate::trans('It is cost effective! Using banners is one of the cheapest methods of advertising available. Banners are often a better option financially compared to TV or radio station advertisements.', app()->getLocale()) }}</li>
          <li class="mb-2"><strong>{{ GoogleTranslate::trans('Number 2:', app()->getLocale()) }}</strong> {{ GoogleTranslate::trans('They target your main audience. Whether you hang up your banner at a sponsored event or outside your business location, you will have a much higher chance of gaining potential customers.', app()->getLocale()) }}</li>
          <li class="mb-2"><strong>{{ GoogleTranslate::trans('Number 3:', app()->getLocale()) }}</strong> {{ GoogleTranslate::trans('It’s a sustainable method for increasing customers. By placing your banner in a high-profile spot, it will influence customers, giving you a wider client base.', app()->getLocale()) }}</li>
          <li class="mb-2"><strong>{{ GoogleTranslate::trans('Number 4:', app()->getLocale()) }}</strong> {{ GoogleTranslate::trans('Banners are extremely memorable. A strategically designed banner will make future customers more likely to remember your business and the information they see.', app()->getLocale()) }}</li>
          <li class="mb-2"><strong>{{ GoogleTranslate::trans('Number 5:', app()->getLocale()) }}</strong> {{ GoogleTranslate::trans('Your banners can be used multiple times. If you decide to move to a new building or attend an important event, your banner is reusable.', app()->getLocale()) }}</li>
          <li class="mb-2"><strong>{{ GoogleTranslate::trans('Number 6:', app()->getLocale()) }}</strong> {{ GoogleTranslate::trans('It is an effective method of advertising. Banner advertising has always worked, as signage is directly available to the masses.', app()->getLocale()) }}</li>
          <li class="mb-2"><strong>{{ GoogleTranslate::trans('Number 7:', app()->getLocale()) }}</strong> {{ GoogleTranslate::trans('Durable and able to withstand harsh weather conditions. High-quality materials mean our banners can be used for very long periods.', app()->getLocale()) }}</li>
          <li class="mb-2"><strong>{{ GoogleTranslate::trans('Number 8:', app()->getLocale()) }}</strong> {{ GoogleTranslate::trans('Ideal for promoting special offers and upcoming sales. A bold banner is the perfect way to spread the word about your business.', app()->getLocale()) }}</li>
          <li class="mb-2"><strong>{{ GoogleTranslate::trans('Number 9:', app()->getLocale()) }}</strong> {{ GoogleTranslate::trans('A well-designed banner will be memorable. Including your logo and important information such as slogans or contact details increases the chances of having a memorable design, leading to more customers.', app()->getLocale()) }}</li>
          <li class="mb-2"><strong>{{ GoogleTranslate::trans('Number 10:', app()->getLocale()) }}</strong> {{ GoogleTranslate::trans('Banners are straightforward to create. Made from vinyl, the process of producing banners is much faster than other advertising methods.', app()->getLocale()) }}</li>
        </ul>

        <h3 class="text-center mt-5">Leaderboard Banners</h3>
        <img style="width: 100%" src="https://leadsdubai.com/wp-content/uploads/target-banner-advertising.jpg" alt="Leaderboard Banner" class="img-fluid mb-4">
        <p class="text-center mb-4">{{ GoogleTranslate::trans("Leaderboard banners can run at a premium because of their coveted spot at the top of the webpage. However, it's important to note that they can also appear below the fold, just above the footer. The good news is that studies have found click-through rates are even higher in this position, as users have already scrolled down and engaged with the content. In some cases, your banner can occupy both top and bottom slots for maximum impact.", app()->getLocale()) }}</p>

        <h3 class="text-center mt-5">Skyscraper Banners</h3>
        <img style="width: 100%" src="https://www.mediaimpact.de/data/uploads/2023/07/skyscraper-622x350.jpg" alt="Leaderboard Banner" class="img-fluid mb-4">
        <p class="text-center mb-4">{{ GoogleTranslate::trans("Since skyscraper banner ads are long and thin, achieving the right balance in your banner design is essential. You'll want to include your company logo, your value proposition, and a strong call to action—all of which require adequate space. This is where strong banner ad design skills come in, along with insights into what resonates with your target audience.", app()->getLocale()) }}</p>

        <p class="text-center mt-4">{{ GoogleTranslate::trans('Purchase your banners for your business today!', app()->getLocale()) }}</p>
      </div>
    </div>
  </div>
@endsection
