@extends ('newFrontend.master')

@section('content')
    <style>
        /* Base Styles */
        #adsCarousel .carousel-inner {
            height: 400px;
        }

        .carousel-item-content {
            position: relative;
            height: 100%;
        }

        .widget-title h3 {
            padding: 10px 0;
            margin: 0;
            line-height: 1.4;
        }

        .widget-title {
            overflow: visible;
        }

        .sticky-banner {
            position: -webkit-sticky;
            /* For Safari */
            position: sticky;
            align-self: flex-start;
            top: 20px;
            width: 160px !important;
            height: 600px !important;
            margin: 0 auto;
        }

        .banner-img {
            position: relative;
            width: 160px !important;
            height: 600px !important;
            object-fit: cover;
        }

        /* Main Layout Grid */
        .main-layout {
            display: grid;
            grid-template-columns: 300px 1fr 160px;
            grid-template-areas: "sidebar content banner";
            gap: 20px;
            min-height: 600px;
        }

        .sidebar-area {
            grid-area: sidebar;
        }

        .content-area {
            grid-area: content;
        }

        .banner-area {
            position: relative;
            top: 10rem;
            left: 1rem;
            display: flex;
            justify-content: right;
            right: 8rem;
            height: fit-content;
            grid-area: banner;
        }

        /* Content Grid for Ads */
        .ads-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        /* Ad Card Styling */
        .ad-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .ad-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .ad-image {
            height: 180px;
            overflow: hidden;
            position: relative;
        }

        .ad-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .ad-content {
            padding: 15px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .ad-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .ad-price {
            font-size: 18px;
            font-weight: bold;
            color: #e74c3c;
            margin-bottom: 8px;
        }

        .ad-location {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
        }

        .ad-meta {
            font-size: 12px;
            color: #999;
            margin-top: auto;
        }

        /* Badge Styling */
        .ad-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            color: white;
        }

        .badge-top {
            background: #28a745;
        }

        .badge-urgent {
            background: #dc3545;
        }

        .badge-super {
            background: #007bff;
        }

        .badge-jump {
            background: #ffc107;
            color: #333;
        }

        /* Carousel Styling */
        .carousel-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .carousel-caption {
            bottom: 10%;
            left: 5%;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }

        .carousel-caption p {
            font-size: 20px;
            color: white;
        }

        .top-left-image {
            position: absolute;
            top: 5px;
            left: 5px;
            width: 70px;
            height: auto;
        }

        /* Animation Styles */
        @keyframes blinking-border {
            0% {
                border-color: transparent;
            }

            50% {
                border-color: rgba(0, 255, 0, 0.8);
            }

            100% {
                border-color: transparent;
            }
        }

        @keyframes blinking-border-blue {
            0% {
                border-color: transparent;
            }

            50% {
                border-color: rgba(0, 159, 245, 0.8);
            }

            100% {
                border-color: transparent;
            }
        }

        @keyframes blinking-border-red {
            0% {
                border-color: transparent;
            }

            50% {
                border-color: red;
            }

            100% {
                border-color: transparent;
            }
        }

        .top-ad {
            animation: blinking-border 1.5s infinite;
            border: 2px solid transparent;
            border-radius: 10px;
        }

        .super-ad {
            animation: blinking-border-blue 1.5s infinite;
            border: 2px solid transparent;
            border-radius: 10px;
        }

        .urgent-ad {
            animation: blinking-border-red 1.5s infinite;
            border: 2px solid transparent;
            border-radius: 10px;
        }

        @keyframes blink {
            0% {
                border-color: blue;
            }

            50% {
                border-color: transparent;
            }

            100% {
                border-color: blue;
            }
        }

        .blink-border {
            border: 2px solid blue;
            animation: blink 1s infinite;
        }

        .blink-border-wrapper {
            position: relative;
            border: 3px solid #007bff;
            border-radius: 4px;
            overflow: hidden;
            box-sizing: border-box;
            padding: 0px;
            height: 100%;
            animation: blink 1.5s infinite;
            margin: 2px;
        }

        .image-container {
            position: relative;
            max-height: 100%;
            width: 100%;
            overflow: hidden;
            border-radius: 8px;
        }

        .carousel-item-content img {
            height: 100%;
            width: 100%;
            object-fit: contain;
            position: relative;
            z-index: 1;
        }

        .carousel-item {
            transition: transform 0.6s ease;
        }

        /* Filter Button Styles */
        .mobile-filter-toggle {
            display: none;
        }

        .red-filter-button {
            background: #e74c3c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            transition: background 0.3s ease;
            width: 100%;
            justify-content: center;
        }

        .red-filter-button:hover {
            background: #c0392b;
        }

        .filter-icon {
            width: 20px;
            height: 20px;
            fill: white;
        }

        /* Location Filter Styles */
        #location-filter {
            max-width: 500px;
            margin: 20px auto;
        }

        .results-container {
            border: 1px solid #ddd;
            margin-top: 10px;
            max-height: 300px;
            overflow-y: auto;
        }

        .district-item,
        .city-item {
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
        }

        .district-item:hover,
        .city-item:hover {
            background-color: #f5f5f5;
        }

        .back-button {
            margin-bottom: 10px;
            padding: 5px 10px;
            background: #7E0202;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #district-search {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        /* Pagination Styles */
        .pagination {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            justify-content: center;
            padding: 10px 0;
        }

        .pagination li {
            list-style: none;
        }

        .pagination li a,
        .pagination li span {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s ease;
            background-color: white;
        }

        .pagination li a:hover {
            border-color: #aaa;
            color: #000;
        }

        .pagination li.current a,
        .pagination li.current span {
            background-color: #b30000;
            color: white;
            font-weight: bold;
            border-color: transparent;
        }

        .pagination li.disabled a,
        .pagination li.disabled span {
            pointer-events: none;
        }

        /* Modal Styles */
        .filter-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            width: 90%;
            max-width: 500px;
            max-height: 80vh;
            overflow-y: auto;
            border-radius: 5px;
            position: relative;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .close-modal {
            font-size: 28px;
            cursor: pointer;
            color: #666;
        }

        .close-modal:hover {
            color: #000;
        }

        .carousel.no-animation .carousel-item {
            transition: none !important;
            -webkit-transition: none !important;
        }

        .badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: red;
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            z-index: 1;
            clip-path: polygon(100% 0%, 100% 100%, 50% 80%, 0 100%, 0 0);
        }

        @media (min-width: 3700px) {
            .main-layout {
                grid-template-columns: 320px 1fr 200px;
                gap: 40px;
            }

            .sticky-banner {
                position: -webkit-sticky;
                /* For Safari */
                position: sticky;
                align-self: flex-start;
            }
            .item-shorting {
                width: 10rem;
            }
            .banner-img {
                width: 400px !important;
                height: 600px !important;
                object-fit: cover;
            }

            .ads-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 30px;
            }

            .banner-area {
                right: 14rem;
            }

            /* .screen-info::after {
                            content: " - 2700px+";
                        } */
        }

        /* For screens 1700px to 2699px */
        @media (min-width: 1701px) and (max-width: 3699px) {
            .main-layout {
                grid-template-columns: 320px 1fr 200px;
                gap: 30px;
            }

            .sticky-banner {
                position: -webkit-sticky;
                /* For Safari */
                position: sticky;
                align-self: flex-start;
            }

            ,
            .banner-img {
                width: 400px !important;
                height: 600px !important;
                object-fit: cover;
            }

            .ads-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 25px;
            }

            .banner-area {
                right: 8rem;
            }

        }


        /* RESPONSIVE STYLES */
        @media (min-width: 1401px) and (max-width: 1699px) {
            .main-layout {
                grid-template-columns: 320px 1fr 200px;
                gap: 30px;
            }

            .sticky-banner {
                position: -webkit-sticky;
                /* For Safari */
                position: sticky;
                align-self: flex-start;
                width: 200px !important;
                height: 600px !important;
            }

            .banner-img {
                width: 200px !important;
                height: 600px !important;
                object-fit: cover;
            }

            .banner-area {
                right: -4rem;
            }

            .ads-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 25px;
            }
            .item-shorting {
                width: 150%;
            }

            #adsCarousel .carousel-inner {
                height: 500px;
            }
        }

        /* For screens 1700px and larger */
        @media (min-width: 1700px) {
            .main-layout {
                grid-template-columns: 320px 1fr 200px;
                gap: 30px;
            }

            .sticky-banner {
                position: -webkit-sticky;
                /* For Safari */
                position: sticky;
                align-self: flex-start;
                width: 200px !important;
                height: 600px !important;
            }

            .banner-img {
                width: 200px !important;
                height: 600px !important;
                object-fit: cover;
            }

            .banner-area {
                right: 4rem;
            }

            .ads-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 25px;
            }
            .item-shorting {
                width: 150%;
            }

            #adsCarousel .carousel-inner {
                height: 500px;
            }
        }

        /* Extra Large Screens (1400px and up) */
        @media (min-width: 1400px) {
            .main-layout {
                grid-template-columns: 320px 1fr 200px;
                gap: 30px;
            }

            .sticky-banner {
                width: 200px !important;
                height: 600px !important;
                position: -webkit-sticky;
                /* For Safari */
                position: sticky;
                top: 20px;
                /* distance from top when sticking */
                align-self: flex-start;
                /* keeps it at top of its grid column */
            }

            .banner-img {
                width: 200px !important;
                height: 60rem !important;
                object-fit: cover;
            }

            .banner-area {
                right: 6rem;
            }

            .ads-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 25px;
            }
            .item-shorting {
                width: 150%;
            }

            #adsCarousel .carousel-inner {
                height: 500px;
            }
        }

        /* Large Screens (1200px to 1399px) */
        @media (min-width: 1201px) and (max-width: 1399px) {
            .n-sale {
                margin-right: 127px;
            }

            .banner-area {
                right: 2rem;
            }

            .sticky-banner {
                position: -webkit-sticky;
                /* For Safari */
                position: sticky;
                align-self: flex-start;
                width: 160px !important;
                height: 600px !important;
            }

            .banner-img {
                width: 160px !important;
                height: 600px !important;
                object-fit: cover;
            }

            .ads-grid {
                grid-template-columns: repeat(3, 1fr);
            }
            .item-shorting {
                width: 135%;
            }
        }

        /* Medium-Large Screens (993px to 1200px) */
        @media (min-width: 993px) and (max-width: 1200px) {
            .mobile-filter-toggle {
                display: none;
            }

            .main-layout {
                grid-template-columns: 250px 1fr 140px;
                gap: 15px;
            }

            .sticky-banner {
                position: -webkit-sticky;
                /* For Safari */
                position: sticky;
                align-self: flex-start;
                width: 140px !important;
                height: 500px !important;
            }

            .banner-img {
                width: 140px !important;
                height: 500px !important;
                object-fit: cover;
            }

            .banner-area {
                right: 1rem;
            }

            .ads-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 18px;
            }

            .item-shorting {
                width: 135%;
            }

            #adsCarousel .carousel-inner {
                height: 350px;
            }

            .ad-image {
                height: 160px;
            }

            .feature-block {
                flex: 0 0 100% !important;
                max-width: 100% !important;
                margin-bottom: 15px !important;
                height: fit-content !important;
            }

            .feature-block-one .inner-box {
                flex-direction: row !important;
                gap: 15px;
            }

            .image-box {
                width: 40% !important;
                flex-shrink: 0;
            }

            .image-box img {
                height: 120px !important;
                width: 100% !important;
            }

            .lower-content {
                width: 60% !important;
                padding-right: 10px !important;
            }
        }

        /* Tablets and Small Laptops (769px to 992px) */
        @media (min-width: 769px) and (max-width: 992px) {
            .sidebar-side-mobile {
                display: none;
            }

            .main-layout {
                grid-template-columns: 1fr 120px;
                grid-template-areas: "content banner";
                gap: 15px;
            }

            .sidebar-area {
                display: none;
            }

            .banner-area {
                position: relative;
                right: 2rem;
                display: flex;
                justify-content: center;
                grid-area: banner;
            }

            .sticky-banner {
                position: -webkit-sticky;
                /* For Safari */
                position: sticky;
                align-self: flex-start;
                width: 120px !important;
                height: 400px !important;
                margin: 0;
            }

            .banner-img {
                width: 120px !important;
                height: 400px !important;

            }

            .ads-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .mobile-filter-toggle {
                display: flex;
                flex-direction: row;
                margin-bottom: 20px;
            }

            .sidebar-search,
            .sidebar-category {
                display: none;
            }

            .item-shorting {
                width: 135%;
            }

            #adsCarousel .carousel-inner {
                height: 300px;
            }

            .ad-image {
                height: 150px;
            }

            .ad-title {
                font-size: 15px;
            }

            .ad-price {
                font-size: 16px;
            }
        }

        /* Small Tablets (577px to 768px) */
        @media (min-width: 577px) and (max-width: 768px) {
            .main-layout {
                grid-template-columns: 1fr;
                grid-template-areas:
                    "content"
                    "banner";
                gap: 20px;
            }

            .sidebar-area {
                display: none;
            }

            .banner-area {
                position: relative;
                right: auto;
                display: flex;
                justify-content: center;
                grid-area: banner;
                margin: 20px 0;
            }

            .sticky-banner {
                position: static;
                width: 100% !important;
                height: 200px !important;
                max-width: 500px;
            }

            .banner-img {
                width: 100% !important;
                height: 200px !important;
                object-fit: cover;
                border-radius: 8px;
            }

            .ads-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }

            .mobile-filter-toggle {
                display: flex;
                margin-bottom: 20px;
            }

            #adsCarousel .carousel-inner {
                height: 250px;
            }

            .ad-image {
                height: 140px;
            }

            .ad-content {
                padding: 12px;
            }

            .carousel-caption p {
                font-size: 16px;
            }

            .pagination {
                gap: 4px;
            }

            .pagination li a,
            .pagination li span {
                width: 32px;
                height: 32px;
                font-size: 13px;
            }
        }

        /* Mobile Devices (480px to 576px) */
        @media (min-width: 480px) and (max-width: 576px) {
            .main-layout {
                grid-template-columns: 1fr;
                grid-template-areas:
                    "content"
                    "banner";
                gap: 15px;
            }

            .sidebar-area {
                display: none;
            }

            .banner-area {
                position: relative;
                right: auto;
                display: flex;
                justify-content: center;
                grid-area: banner;
                margin: 15px 0;
            }

            .sticky-banner {
                position: static;
                width: 100% !important;
                height: 180px !important;
                max-width: 400px;
            }

            .banner-img {
                width: 100% !important;
                height: 180px !important;
                object-fit: cover;
                border-radius: 8px;
            }

            .ads-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .mobile-filter-toggle {
                display: flex;
                margin-bottom: 15px;
            }

            .red-filter-button {
                padding: 8px 15px;
                font-size: 14px;
            }

            #adsCarousel .carousel-inner {
                height: 200px;
            }

            .ad-image {
                height: 120px;
            }

            .ad-content {
                padding: 10px;
            }

            .ad-title {
                font-size: 14px;
                -webkit-line-clamp: 2;
            }

            .ad-price {
                font-size: 15px;
            }

            .ad-location {
                font-size: 13px;
            }

            .ad-meta {
                font-size: 11px;
            }

            .carousel-caption p {
                font-size: 14px;
            }

            .pagination {
                gap: 3px;
            }

            .pagination li a,
            .pagination li span {
                width: 30px;
                height: 30px;
                font-size: 12px;
            }

            .modal-content {
                margin: 10% auto;
                width: 95%;
                max-height: 85vh;
                padding: 15px;
            }
        }

        /* Small Mobile Devices (320px to 479px) */
        @media (max-width: 479px) {
            .main-layout {
                grid-template-columns: 1fr;
                grid-template-areas:
                    "content"
                    "banner";
                gap: 10px;
                padding: 0 10px;
            }

            .auto-container {
                padding: 0 10px;
            }

            .sidebar-area {
                display: none;
            }

            .banner-area {
                position: relative;
                right: auto;
                display: flex;
                justify-content: center;
                grid-area: banner;
                margin: 10px 0;
            }

            .sticky-banner {
                position: static;
                width: 100% !important;
                height: 150px !important;
                max-width: 300px;
            }

            .banner-img {
                width: 100% !important;
                height: 150px !important;
                object-fit: cover;
                border-radius: 6px;
            }

            .ads-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .mobile-filter-toggle {
                display: flex;
                margin-bottom: 15px;
                gap: 8px;
            }

            .red-filter-button {
                padding: 8px 12px;
                font-size: 13px;
                border-radius: 20px;
            }

            #adsCarousel .carousel-inner {
                height: 180px;
            }

            .ad-card {
                border-radius: 6px;
            }

            .ad-image {
                height: 150px;
            }

            .ad-content {
                padding: 8px;
            }

            .ad-title {
                font-size: 14px;
                -webkit-line-clamp: 2;
                margin-bottom: 6px;
            }

            .ad-price {
                font-size: 15px;
                margin-bottom: 6px;
            }

            .ad-location {
                font-size: 12px;
                margin-bottom: 6px;
            }

            .ad-meta {
                font-size: 10px;
            }

            .ad-badge {
                padding: 3px 6px;
                font-size: 10px;
                top: 5px;
                left: 5px;
            }

            .carousel-caption {
                bottom: 5%;
                left: 3%;
            }

            .carousel-caption p {
                font-size: 12px;
            }

            .top-left-image {
                width: 50px;
            }

            .pagination {
                gap: 2px;
                padding: 8px 0;
            }

            .pagination li a,
            .pagination li span {
                width: 28px;
                height: 28px;
                font-size: 11px;
            }

            .modal-content {
                margin: 5% auto;
                width: 95%;
                max-height: 90vh;
                padding: 12px;
            }

            .modal-header h3 {
                font-size: 18px;
            }

            .close-modal {
                font-size: 24px;
            }

            /* Feature block mobile optimizations */
            .feature-block {
                flex: 0 0 100% !important;
                max-width: 100% !important;
                margin-bottom: 10px !important;
                height: fit-content !important;
            }

            .feature-block-one .inner-box {
                flex-direction: column !important;
                gap: 10px;
            }

            .image-box {
                width: 100% !important;
            }

            .image-box img {
                height: 150px !important;
                width: 100% !important;
            }

            .lower-content {
                width: 100% !important;
                padding: 0 !important;
            }

            .sale {
                top: 5px !important;
                right: 5px !important;
            }

            .category,
            .far.fa-clock {
                display: none !important;
            }

            h4 {
                -webkit-line-clamp: 2 !important;
                margin-top: 0 !important;
                font-size: 14px !important;
            }

            .icon img {
                height: 18px !important;
            }

            .time-dff {
                margin-left: -20px !important;
            }

            .btn-box a {
                width: max-content;
                padding: 6px 12px;
                font-size: 12px;
            }
        }

        /* Very Small Mobile Devices (max 320px) */
        @media (max-width: 320px) {
            .main-layout {
                padding: 0 5px;
                gap: 8px;
            }

            .auto-container {
                padding: 0 5px;
            }

            .sticky-banner {
                height: 120px !important;
            }

            .banner-img {
                height: 120px !important;
            }

            #adsCarousel .carousel-inner {
                height: 150px;
            }

            .ad-image {
                height: 130px;
            }

            .ad-content {
                padding: 6px;
            }

            .red-filter-button {
                padding: 6px 10px;
                font-size: 12px;
            }

            .modal-content {
                padding: 10px;
            }

            .pagination li a,
            .pagination li span {
                width: 26px;
                height: 26px;
                font-size: 10px;
            }
        }

        /* Landscape Mobile Orientation */
        @media (max-width: 768px) and (orientation: landscape) {
            #adsCarousel .carousel-inner {
                height: 150px;
            }

            .sticky-banner {
                height: 120px !important;
            }

            .banner-img {
                height: 120px !important;
            }

            .modal-content {
                margin: 5% auto;
                max-height: 90vh;
            }
        }

        /* Print Styles */
        @media print {

            .banner-area,
            .mobile-filter-toggle,
            .carousel,
            .filter-modal {
                display: none !important;
            }

            .main-layout {
                grid-template-columns: 1fr !important;
                grid-template-areas: "content" !important;
            }

            .ads-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 10px !important;
            }

            .ad-card {
                break-inside: avoid;
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }

        /* Accessibility Improvements */
        @media (prefers-reduced-motion: reduce) {

            .ad-card,
            .carousel-item,
            .top-ad,
            .super-ad,
            .urgent-ad,
            .blink-border,
            .blink-border-wrapper {
                animation: none !important;
                transition: none !important;
            }

            .ad-card:hover {
                transform: none;
            }
        }

        /* High Contrast Mode */
        @media (prefers-contrast: high) {
            .ad-card {
                border: 2px solid #000;
            }

            .ad-badge {
                border: 1px solid #000;
            }

            .red-filter-button {
                border: 2px solid #000;
            }
        }

        /* High-DPI Display Support */
        @media only screen and (-webkit-min-device-pixel-ratio: 2),
        only screen and (min--moz-device-pixel-ratio: 2),
        only screen and (-o-min-device-pixel-ratio: 2/1),
        only screen and (min-device-pixel-ratio: 2),
        only screen and (min-resolution: 192dpi),
        only screen and (min-resolution: 2dppx) {

            .banner-img,
            .ad-image img {
                image-rendering: -webkit-optimize-contrast;
                image-rendering: crisp-edges;
            }
        }

        /* Bold text for sidebar sections */
        .sidebar-search * {
            font-weight: bold !important;
        }

        .sidebar-category * {
            font-weight: bold !important;
            font-size: 13px !important;
        }
    </style>

    <!-- Page Title -->
    <section class="page-title style-two banner-part" style="background-image: url(assets/images/background/page-title.jpg);">
        <div class="auto-container">
            <div class="mr-0 content-box centred">
                <div class="title">
                    <h1>{{ $category ? __('messages.' . $category->name) : __('messages.All Categories') }}</h1>
                </div>
                <ul class="clearfix bread-crumb">
                    <li><a href="{{ route('/') }}">@lang('messages.Home')</a></li>
                    <li>@lang('messages.Browse Ads')</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- ad - banner-section start -->
    <section class="mb-0 ad-banner-container">
        <div id="ad-banner-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                @foreach ($all_banners as $key => $banner)
                    @if ($banner->type == 0)
                        @if (isset($banner->url))
                            <a href="{{ $banner->url }}" target="_blank">
                        @endif
                        <div class="carousel-item ad-carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ url('banners/' . $banner->img) }}" class="mx-auto d-block" alt="Banner Image">
                        </div>
                        @if (isset($banner->url))
                            </a>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- ad - banner-section end -->
    <!-- End Page Title -->
    <!-- Add this before your sidebar section -->
    <!-- Add this in your HTML -->

    <!-- Add this at the bottom of your page -->
    <div class="filter-modal" id="filterModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Location Filters</h3>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <div id="location-filter-mob">
                    <!-- District Search -->
                    <div class="district-section form-group">
                        <input class="form-control" type="text" id="district-search-mob"
                            value="{{ $selectedCityName ?? '' }}" placeholder="Type 3 Letters to Filter">
                        <div id="district-results-mob" class="results-container"></div>
                    </div>

                    <!-- City Selection (Hidden Initially) -->
                    <div class="city-section" style="display: none;">
                        <button class="back-button">&larr; Back</button>
                        <div id="city-results-mob" class="results-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="filter-modal" id="filterModalCat">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Category Filters</h3>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <div class="mt-4 mb-4 auto-container">
                    <div class="clearfix row">
                        <div class="col-md-12 sidebar-side">
                            <div class="default-sidebar category-sidebar">
                                <div class="sidebar-category sidebar-widget">
                                    <div class="widget-title">
                                        <h3>@lang('messages.Categories')</h3>
                                    </div>
                                    <div class="widget-content">
                                        <ul class="category-list">
                                            <li>
                                                <label>
                                                    <input type="radio" name="category" value="all"
                                                        onchange="window.location='{{ route('browse-ads') }}'"
                                                        {{ !request()->input('category') ? 'checked' : '' }}>
                                                    <span class="text-dark">
                                                        <i class="fas fa-th-large"
                                                            style="margin-right: 8px; color: #b30000; width: 16px;"></i>
                                                        @lang('messages.All Categories')
                                                    </span>

                                                </label>
                                            </li>

                                            @foreach ($categories->take(14) as $category)
                                                <li class="{{ $category->subcategories->isNotEmpty() ? 'dropdown' : '' }}">
                                                    <label>
                                                        <input type="radio" name="category" value="{{ $category->id }}"
                                                            onchange="window.location='{{ route('browse-ads', ['category' => $category->id]) }}'"
                                                            {{ request()->input('category') == $category->id ? 'checked' : '' }}>
                                                        <span>
                                                            @php
                                                                $categoryIcons = [
                                                                    'Electronics' => 'fas fa-laptop',
                                                                    'Motor vehicles' => 'fas fa-car',
                                                                    'Home, lands & buildings' => 'fas fa-home',
                                                                    'Home & Garden' => 'fas fa-seedling',
                                                                    'Pets' => 'fas fa-paw',
                                                                    'Services' => 'fas fa-tools',
                                                                    'Business And Industry' => 'fas fa-industry',
                                                                    'leisure,kids items & sports' => 'fas fa-gamepad',
                                                                    'Fancy & Cosmetics' => 'fas fa-gem',
                                                                    'Daily Essentials' => 'fas fa-shopping-basket',
                                                                    'Education' => 'fas fa-graduation-cap',
                                                                    'Agriculture' => 'fas fa-tractor',
                                                                    'Jobs & Overseas jobs' => 'fas fa-briefcase',
                                                                    'Other Ads' => 'fas fa-list',
                                                                    'Testing' => 'fas fa-flask',
                                                                ];
                                                                $iconClass =
                                                                    $categoryIcons[$category->name] ?? 'fas fa-tag';
                                                            @endphp
                                                            <i class="{{ $iconClass }}"
                                                                style="margin-right: 8px; color: #b30000; width: 16px;"></i>
                                                            @lang('messages.' . $category->name)
                                                        </span>
                                                    </label>

                                                    @if ($category->subcategories->isNotEmpty())
                                                        <ul>
                                                            @foreach ($category->subcategories as $subcategory)
                                                                <li>
                                                                    <label>
                                                                        <input type="radio" name="subcategory"
                                                                            value="{{ $subcategory->id }}"
                                                                            onchange="window.location='{{ route('browse-ads', ['category' => $category->id, 'subcategory' => $subcategory->id]) }}'"
                                                                            {{ request()->input('subcategory') == $subcategory->id ? 'checked' : '' }}>
                                                                        <span> @lang('messages.' . $subcategory->name)</span>
                                                                    </label>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 mb-4 auto-container">
        <!-- Mobile Filter Buttons -->
        <div class="row" style="margin: auto;">
            <div class="col-6 mobile-filter-toggle">
                <button id="filterToggle" class="red-filter-button">
                    <i style="font-size:14px" class="fa">&#xf041;</i>
                    <span>{{ $selectedCityName ?? 'Locations' }}</span>
                </button>
            </div>
            <div class="col-6 mobile-filter-toggle">
                <button id="filterToggleCat" class="red-filter-button">
                    <i style="font-size:14px" class="fa">&#xf022;</i>
                    <span>{{ $selectedCategoryName ?? 'Categories' }}</span>
                </button>
            </div>
        </div>

        <!-- Main Layout Grid -->
        <div class="main-layout">
            <!-- Sidebar Area -->
            <div class="sidebar-area">
                <div class="col-lg-12 col-md-12 col-sm-12 sidebar-side sidebar-side-mobile">
                    <div class="default-sidebar category-sidebar">
                        <div class="sidebar-search sidebar-widget">
                            <div class="widget-title ">
                                <h3>@lang('messages.Location')</h3>
                            </div>
                            <div class="widget-content">
                                <div id="location-filter">
                                    <!-- District Search -->
                                    <div class="district-section form-group" style="position: relative;">
                                        <input class="form-control" type="text" id="district-search"
                                            value="{{ $selectedCityName ?? '' }}" placeholder="Type 3 Letters to Filter"
                                            style="padding-left: 35px; position: relative;">
                                        <i class="fas fa-map-marker-alt"
                                            style="position: absolute; left: 12px; top: 12px; color: #b30000; z-index: 999; pointer-events: none;"></i>
                                        <div id="district-results" class="results-container"></div>

                                        <!-- new: apply district button (hidden until a district selected) -->
                                        <div style="margin-top:8px;">
                                            <button id="apply-district" class="btn btn-sm btn-primary"
                                                style="display:none;">Apply District</button>
                                        </div>
                                    </div>

                                    <!-- City Selection (Hidden Initially) -->
                                    <div class="city-section" style="display: none;">
                                        <button class="back-button">&larr; Back</button>
                                        <div id="city-results" class="results-container"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-category sidebar-widget">
                            <div class="widget-title">
                                <h3>@lang('messages.Categories')</h3>
                            </div>
                            <div class="widget-content">
                                <ul class="category-list">
                                    <li>
                                        <label>
                                            <input type="radio" name="category" value="all"
                                                onchange="window.location='{{ route('browse-ads') }}'"
                                                {{ !request()->input('category') ? 'checked' : '' }}>
                                            <span class="text-dark">
                                                <i class="fas fa-th-large"
                                                    style="margin-right: 8px; color: #b30000; width: 16px;"></i>
                                                @lang('messages.All Categories')
                                            </span>

                                        </label>
                                    </li>

                                    @foreach ($categories->take(14) as $category)
                                        <li class="{{ $category->subcategories->isNotEmpty() ? 'dropdown' : '' }}">
                                            <label>
                                                <input type="radio" name="category" value="{{ $category->id }}"
                                                    onchange="window.location='{{ route('browse-ads', ['category' => $category->id]) }}'"
                                                    {{ request()->input('category') == $category->id ? 'checked' : '' }}>
                                                <span>
                                                    @php
                                                        $categoryIcons = [
                                                            'Electronics' => 'fas fa-laptop',
                                                            'Motor vehicles' => 'fas fa-car',
                                                            'Home, lands & buildings' => 'fas fa-home',
                                                            'Home & Garden' => 'fas fa-seedling',
                                                            'Pets' => 'fas fa-paw',
                                                            'Services' => 'fas fa-tools',
                                                            'Business And Industry' => 'fas fa-industry',
                                                            'leisure,kids items & sports' => 'fas fa-gamepad',
                                                            'Fancy & Cosmetics' => 'fas fa-gem',
                                                            'Daily Essentials' => 'fas fa-shopping-basket',
                                                            'Education' => 'fas fa-graduation-cap',
                                                            'Agriculture' => 'fas fa-tractor',
                                                            'Jobs & Overseas jobs' => 'fas fa-briefcase',
                                                            'Other Ads' => 'fas fa-list',
                                                            'Testing' => 'fas fa-flask',
                                                        ];
                                                        $iconClass = $categoryIcons[$category->name] ?? 'fas fa-tag';
                                                    @endphp
                                                    <i class="{{ $iconClass }}"
                                                        style="margin-right: 8px; color: #b30000; width: 16px;"></i>
                                                    @lang('messages.' . $category->name)
                                                </span>
                                            </label>

                                            @if ($category->subcategories->isNotEmpty())
                                                <ul>
                                                    @foreach ($category->subcategories as $subcategory)
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="subcategory"
                                                                    value="{{ $subcategory->id }}"
                                                                    onchange="window.location='{{ route('browse-ads', ['category' => $category->id, 'subcategory' => $subcategory->id]) }}'"
                                                                    {{ request()->input('subcategory') == $subcategory->id ? 'checked' : '' }}>
                                                                <span> @lang('messages.' . $subcategory->name)</span>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                <div class="col-lg-12 col-md-12 col-sm-12 content-side">
                    <div class="category-details-content">
                        <div class="clearfix item-shorting">
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <h6 style="margin: 0; display: inline-block;">@lang('messages.Buy, Sell, Rent or Find Anything in Sri Lanka')</h6>
                                <form action="{{ route('browse-ads') }}" method="GET" class="search-form"
                                    id="search-form-main"
                                    style="display: flex; align-items: center; gap: 10px; margin: 0;">
                                    <input type="hidden" name="location" id="location-main">
                                    <input type="hidden" name="city" id="cityId-main">
                                    <div class="form-group" style="margin: 0;">
                                        <input type="search" name="search-field"
                                            style="padding: 8px 15px; border: 1px solid #ddd; border-radius: 25px; width: 24rem;"
                                            placeholder="@lang('messages.Type anything you are looking')..."
                                            value="{{ request()->input('search-field') }}" oninput="this.form.submit()">
                                    </div>
                                </form>
                            </div>
                            <p style="margin: 0; font-size: 12px; color: #666;"><span>@lang('messages.Search Results'):</span>
                                @lang('messages.Showing')
                                {{ $ads->firstItem() }}-{{ $ads->lastItem() }} @lang('messages.of') {{ $ads->total() }}
                                @lang('messages.Listings')</p>
                        </div>
                        <div id="adsCarousels" class="carousel slide">
                            <div class="carousel-inner">
                                @php
                                    $hasAdWithImage = false;
                                @endphp

                                @foreach ($superAds as $key => $ad)
                                    @php $hasAdWithImage = true; @endphp

                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                        <div class="blink-border-wrapper">
                                            @if ($ad->post_type)
                                                <button class="sale"
                                                    style="position: absolute; top: 10px; right: 10px; width: 50px; height: 25px; border-radius: 2px; background-color: red; color: white; font-weight: bold; font-size: 12px; border: none; z-index: 2;">
                                                    {{ $ad->post_type }}
                                                </button>
                                            @endif

                                            <a href="{{ route('ads.details', ['adsId' => $ad->adsId]) }}"
                                                style="display: block; height: 100%; text-decoration: none;">
                                                <div class="carousel-item-content">
                                                    <div class="image-container"
                                                        style="position: relative; max-height: 385px; overflow: hidden; text-align: center;">
                                                        <img src="{{ asset('storage/' . $ad->mainImage) }}"
                                                            alt="{{ $ad->title }}"
                                                            style="max-height: 385px !important; width: 100%; object-fit: contain;"
                                                            onerror="this.style.display='none';
                                                                        const msg = document.createElement('div');
                                                                        msg.innerText = 'Ad is not available';
                                                                        msg.style.color = 'red';
                                                                        msg.style.fontWeight = 'bold';
                                                                        msg.style.fontSize = '1.2rem';
                                                                        msg.style.padding = '50px 0';
                                                                        msg.style.textAlign = 'center';
                                                                        this.parentNode.appendChild(msg);" />
                                                    </div>

                                                    <div class="carousel-overlay"></div>
                                                    <div class="badge">
                                                        <img src="{{ asset('02.png') }}" alt="Top Ad"
                                                            style="width: 30px; height: 30px;">
                                                    </div>

                                                    <div class="carousel-caption d-sm-block text-start">
                                                        <p>{{ $ad->title }}</p>
                                                        <p>@lang('messages.Rs')
                                                            {{ number_format($ad->price, 2) }}</p>
                                                        <p><i class="fas fa-map-marker-alt"></i>
                                                            @php
                                                                $locale = App::getLocale();
                                                                $locationName = 'name_' . $locale;
                                                            @endphp
                                                            {{ $ad->main_location ? $ad->main_location->$locationName : 'N/A' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                                @if (!$hasAdWithImage)
                                    <div class="text-center"
                                        style="color: red; font-weight: bold; padding: 50px 0; font-size: 1.2rem;">
                                        Ad is not available
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- Ads Grid -->
                        <div class="ads-grid">
                            @foreach ($ads as $ad)
                                <div
                                    class="ad-card {{ $ad->ads_package == 3 ? 'top-ad' : ($ad->ads_package == 4 ? 'urgent-ad' : ($ad->ads_package == 6 ? 'super-ad' : '')) }}">
                                    <a href="{{ route('ads.details', ['adsId' => $ad->adsId]) }}"
                                        style="text-decoration: none; color: inherit; height: 100%; display: flex; flex-direction: column;">
                                        <div class="ad-image">
                                            <img src="{{ asset('storage/' . $ad->mainImage) }}"
                                                alt="{{ $ad->title }}">

                                            @if ($ad->ads_package == 3)
                                                <div class="ad-badge badge-top">
                                                    <img src="{{ asset('01.png') }}" alt="Top Ad"
                                                        style="width: 20px; height: 20px;">
                                                </div>
                                            @elseif($ad->ads_package == 4)
                                                <div class="ad-badge badge-urgent">Urgent</div>
                                            @elseif($ad->ads_package == 6)
                                                <div class="ad-badge badge-super">
                                                    <img src="{{ asset('02.png') }}" alt="Super Ad"
                                                        style="width: 20px; height: 20px;">
                                                </div>
                                            @elseif($ad->ads_package == 5)
                                                <div class="ad-badge badge-jump">
                                                    <img src="{{ asset('04.png') }}" alt="Jump Ad"
                                                        style="width: 20px; height: 20px;">
                                                </div>
                                            @endif

                                            @if ($ad->post_type)
                                                <div class="ad-badge"
                                                    style="right: 10px; left: auto; background: #dc3545;">
                                                    {{ $ad->post_type }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="ad-content">
                                            <div class="ad-title">{{ $ad->title }}</div>
                                            <div class="ad-price">@lang('messages.Rs') {{ number_format($ad->price, 2) }}
                                            </div>
                                            <div class="ad-location">
                                                <i class="fas fa-map-marker-alt"></i>
                                                @php
                                                    $locale = App::getLocale();
                                                    $locationName = 'name_' . $locale;
                                                @endphp
                                                {{ $ad->main_location ? $ad->main_location->$locationName : 'N/A' }}
                                            </div>
                                            <div class="ad-meta">
                                                <div>@lang('messages.' . $ad->category->name)</div>
                                                <div>{{ $ad->created_at->diffForHumans() }}</div>
                                                @php
                                                    $start = \Carbon\Carbon::now();
                                                    $end = \Carbon\Carbon::parse($ad->package_expire_at);
                                                    $totalHours = $start->diffInHours($end);
                                                    $days = intdiv($totalHours, 24);
                                                    $hours = $totalHours % 24;
                                                @endphp
                                                <div style="color: #dc3545;">
                                                    @if ($days == 0 && $hours == 0)
                                                        Expired
                                                    @else
                                                        Expires in {{ $days }}D {{ $hours }}H
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @php
                            $current = $ads->currentPage();
                            $last = $ads->lastPage();
                            $start = max(1, $current - 2);
                            $end = min($last, $current + 2);
                            $query = request()->query();
                            unset($query['page']);
                        @endphp

                        <div class="pagination-wrapper centred">
                            <ul class="clearfix pagination">

                                {{-- Prev --}}
                                @if ($ads->onFirstPage())
                                    <li class="disabled"><span><i class="fas fa-angle-left"></i> Prev</span></li>
                                @else
                                    <li><a href="{{ $ads->appends($query)->previousPageUrl() }}"><i
                                                class="fas fa-angle-left"></i> Prev</a></li>
                                @endif

                                {{-- First Page --}}
                                @if ($start > 1)
                                    <li><a href="{{ $ads->url(1) }}">1</a></li>
                                    @if ($start > 2)
                                        <li class="disabled"><span>…</span></li>
                                    @endif
                                @endif

                                {{-- Windowed Page Numbers --}}
                                @for ($i = $start; $i <= $end; $i++)
                                    <li class="{{ $i == $current ? 'current' : '' }}">
                                        <a href="{{ $ads->appends($query)->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                {{-- Last Page --}}
                                @if ($end < $last)
                                    @if ($end < $last - 1)
                                        <li class="disabled"><span>…</span></li>
                                    @endif
                                    <li><a href="{{ $ads->url($last) }}">{{ $last }}</a></li>
                                @endif

                                {{-- Next --}}
                                @if ($ads->hasMorePages())
                                    <li><a href="{{ $ads->appends($query)->nextPageUrl() }}">Next <i
                                                class="fas fa-angle-right"></i></a></li>
                                @else
                                    <li class="disabled"><span>Next <i class="fas fa-angle-right"></i></span></li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Banner Area -->
            <div class="banner-area">
                <div class="col-md-12">
                    @if ($banners)
                        <div id="bannerCarousel" class="carousel slide no-animation sticky-banner" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($banners as $key => $banner)
                                    @if (isset($banner->url))
                                        <a href="{{ $banner->url }}" target="_blank">
                                    @endif
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <div class="banner d-flex justify-content-center">
                                            <img src="{{ asset('banners/' . $banner->img) }}" alt="Banner Image"
                                                class="img-fluid banner-img">
                                        </div>
                                    </div>
                                    @if (isset($banner->url))
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/search-ads.js') }}"></script>
    <!-- Script to Initialize Carousel -->
    <script>
        var myCarousel = document.querySelector('#adsCarousel');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 2000, // Set interval for auto sliding (5 seconds)
            ride: 'carousel' // Enable auto sliding
        });
    </script>
    <script>
        var myCarousel = document.querySelector('#adsCarousels');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 2000, // Set interval for auto sliding (5 seconds)
            ride: 'carousel' // Enable auto sliding
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterToggle = document.getElementById('filterToggle');
            const filterModal = document.getElementById('filterModal');
            const closeModal = document.querySelector('.close-modal');

            // Open modal
            filterToggle.addEventListener('click', () => {
                filterModal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            });

            // Close modal
            closeModal.addEventListener('click', () => {
                filterModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            });

            // Close when clicking outside
            window.addEventListener('click', (event) => {
                if (event.target === filterModal) {
                    filterModal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });

            // Close on escape key
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && filterModal.style.display === 'block') {
                    filterModal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterToggleCat = document.getElementById('filterToggleCat');
            const filterModalCat = document.getElementById('filterModalCat');
            const closeModal = document.querySelector('.close-modal');

            // Open modal
            filterToggleCat.addEventListener('click', () => {
                filterModalCat.style.display = 'block';
                document.body.style.overflow = 'hidden';
            });

            // Close modal
            closeModal.addEventListener('click', () => {
                filterModalCat.style.display = 'none';
                document.body.style.overflow = 'auto';
            });

            // Close when clicking outside
            window.addEventListener('click', (event) => {
                if (event.target === filterModalCat) {
                    filterModalCat.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });

            // Close on escape key
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && filterModalCat.style.display === 'block') {
                    filterModalCat.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // store last selected district id so city click can send both
            let selectedDistrictId = null;

            function submitLocationForm(locationId = '', cityId = '') {
                const locationInput = document.getElementById('location-main');
                const cityInput = document.getElementById('cityId-main');
                const searchForm = document.getElementById('search-form-main');

                if (locationInput) locationInput.value = locationId || '';
                if (cityInput) cityInput.value = cityId || '';

                // close mobile modal if open
                const filterModal = document.getElementById('filterModal');
                if (filterModal) filterModal.style.display = 'none';
                document.body.style.overflow = 'auto';

                // submit form (preserves other GET inputs like category, search-field)
                if (searchForm) {
                    // remove page param to reset pagination
                    const pageInput = searchForm.querySelector('input[name="page"]');
                    if (pageInput) pageInput.remove();
                    searchForm.submit();
                } else {
                    // fallback: rebuild url
                    const url = new URL(window.location.href);
                    if (locationId) url.searchParams.set('location', locationId);
                    else url.searchParams.delete('location');
                    if (cityId) url.searchParams.set('city', cityId);
                    else url.searchParams.delete('city');
                    url.searchParams.delete('page');
                    window.location.href = url.toString();
                }
            }

            // when a district is clicked: DON'T submit immediately.
            // instead load its cities and show city-section, allow user to pick city or apply district-only.
            $(document).on('click', '.district-item', function(e) {
                e.preventDefault();

                const districtId = $(this).data('id');
                const districtName = $(this).data('name') || $(this).text().trim();

                selectedDistrictId = districtId;

                // update visible search fields
                $('#district-search').val(districtName);
                if ($('#district-search-mob').length) $('#district-search-mob').val(districtName);

                // show apply button so user can submit district-only if desired
                $('#apply-district').show();

                // fetch cities for this district (API route required, see note)
                // expected JSON: [{id:1, name_en:'Buttala', district_id: X}, ...]
                $('#city-results').empty();
                $('#city-results-mob').empty();

                fetch(`/api/districts/${districtId}/cities`)
                    .then(res => {
                        if (!res.ok) throw new Error('Network response not ok');
                        return res.json();
                    })
                    .then(data => {
                        if (!Array.isArray(data) || data.length === 0) {
                            $('#city-results').html('<div class="city-item">No cities found</div>');
                            $('#city-results-mob').html('<div class="city-item">No cities found</div>');
                        } else {
                            data.forEach(city => {
                                const cityEl = $(`
                            <div class="city-item" data-id="${city.id}" data-name="${(city.name_en||city.name)}" data-district-id="${districtId}">
                                ${city.name_en || city.name}
                            </div>
                        `);
                                $('#city-results').append(cityEl);
                                // mobile
                                const cityElMob = $(`
                            <div class="city-item" data-id="${city.id}" data-name="${(city.name_en||city.name)}" data-district-id="${districtId}">
                                ${city.name_en || city.name}
                            </div>
                        `);
                                $('#city-results-mob').append(cityElMob);
                            });
                        }

                        // show city section and hide raw district results to guide user
                        $('.city-section').show();
                        $('#district-results').hide();
                        $('#district-results-mob').hide();
                    })
                    .catch(err => {
                        console.error('Failed to load cities:', err);
                        // still show city section but with message
                        $('#city-results').html('<div class="city-item">Failed to load cities</div>');
                        $('#city-results-mob').html(
                            '<div class="city-item">Failed to load cities</div>');
                        $('.city-section').show();
                        $('#district-results').hide();
                        $('#district-results-mob').hide();
                    });
            });

            // back button to go back to district list
            $(document).on('click', '.back-button', function() {
                $('.city-section').hide();
                $('#district-results').show();
                $('#district-results-mob').show();
                $('#apply-district').hide();
            });

            // apply district-only (submit with location only)
            $(document).on('click', '#apply-district', function() {
                if (!selectedDistrictId) return;
                submitLocationForm(selectedDistrictId, '');
            });

            // when city is clicked -> submit both district and city (page will refresh as desired)
            $(document).on('click', '.city-item', function() {
                const cityId = $(this).data('id');
                const cityName = $(this).data('name') || $(this).text().trim();
                const districtId = $(this).data('district-id') || selectedDistrictId || '';

                // update visible field(s)
                $('#district-search').val(cityName);
                if ($('#district-search-mob').length) $('#district-search-mob').val(cityName);

                submitLocationForm(districtId, cityId);
            });

            // optional: close city section if user clicks outside (keeps behavior consistent)
            $(document).on('click', function(e) {
                if (!$(e.target).closest(
                        '#location-filter, .city-section, .district-section, #district-results, #city-results'
                        ).length) {
                    // hide dropdown lists but do not clear selectedDistrictId
                    $('#district-results').hide();
                    $('#city-results').hide();
                    $('#district-results-mob').hide();
                    $('#city-results-mob').hide();
                }
            });
        });
    </script>

@endsection
