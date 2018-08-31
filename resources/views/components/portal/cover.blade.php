{{-- Cover --}}
<div class="cover-wrap">
    <div id="star-container">
    </div>
    <div id="no-stars" class="no-stars"></div>
    <div class="cover">
        <div class="cover-text">
            <h1><span>{{ $title }}</span><span>{{ $tagline }}</span></h1>
        </div>
        <div class="cover-figures">
            @include('mixins.img', [ 'src' => asset('img/figures/spaceman.png'), 'alt' => 'spaceman figure' ])
            @include('mixins.img', [ 'src' => asset('img/figures/moon.png'), 'alt' => 'small moon' ])
            @include('mixins.img', [ 'src' => asset('img/figures/spaceship.png'), 'alt' => 'spaceship figure' ])
            @include('mixins.img', [ 'src' => asset('img/figures/moon-saturn.png'), 'alt' => 'moon saturn ring' ])
        </div>
    </div>
    <div class="svg-container">
        <svg id="curves" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 356.03" preserveAspectRatio="xMinYMax slice">
            <title>Cover svg curves</title>
            <path id="curve2" class="curve" d="M0,48.62s261.42,160,565.27,165c7.5.11,15.1.31,22.61.61,29.51,1.12,137.66.61,296-54.06q24.6-8.52,47.82-18C1000.07,114.64,1302.21-2.3,1498.7,0c7.1.11,14.11.11,21.21,0,46.12-.5,240.81,4,401,108V356H0Z" transform="translate(0 0)"/>
            <path id="curve1" class="curve" d="M0,87.81S263.12,269.64,568.27,274.22c6.4.11,12.8.21,19.11.41,19,.51,72.83.71,153.27-10.79,85.34-12.21,161.77-34.49,229.4-58.61C1081.31,165.35,1224.57,66,1509.71,66c0,0,240.91,7.84,411.19,125.37V356H0Z" transform="translate(0 0)"/>
            <path id="curve0" class="curve" d="M.9,193.63s268.93,120.2,578.87,120.2c0,0,119.26,8,309.35-39.5,14.3-3.6,28.31-7.4,42.12-11.4,68.53-19.7,382-106.3,578.57-101.2,0,0,228.1-8,411.19,76.8V356H0Z" transform="translate(0 0)"/>
        </svg>
    </div>
</div>