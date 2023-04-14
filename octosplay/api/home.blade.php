@extends('layouts.master')

@section('content')
@php
    $username = $datauser['username'] ?? "";

    if( $agent->isMobile() ){
        $platform = "mobile";
    }

    if( $agent->isTablet() ){
        $platform = "tablet";
    }

    if( $agent->isDesktop() ){
        $platform = "web";
    }

    $dataRedis = getRedis('webconfig');
    $config = $dataRedis['data']['config'];
    $slider1 = $dataRedis['data']['baner_slidshow'];

    shuffle($slider1);
@endphp
<div style="background-color: #0A0033;">
    <!-- Banner -->
    <div class="content-banner  mt-2 mb-4">
        <div class="row g-2">
            <div class="col-md-6 col-sm-12 banner">
                <div id="owl-banner-1" class="owl-carousel owl-theme">
                    @foreach ( $slider1 as $value)
                        <div class="item"><img src="{{ $value['image_url'] }}" class="d-block w-100" alt="$value['title']"></div>
                    @endforeach
                </div>
            </div>
            @php
                shuffle($slider1);
            @endphp
            <div class="col-md-6 col-sm-12 banner align-self-start">
                <div id="owl-banner-2" class="owl-carousel owl-theme">
                    @foreach ( $slider1 as $value)
                        <div class="item"><img src="{{ $value['image_url'] }}" class="d-block w-100" alt="$value['title']"></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="container-jackpot mt-2 mb-4 ">
        <img src="{{ asset('img/jackpot.webp') }}" alt="Snow" class="d-block img-jackpot mx-auto">
        <div class="centered">
            <h1 class="jackpot-body">
                <span id="curs-jackpot">IDR. </span><span id="jackpot"></span>
            </h1>
        </div>
    </div>

    <div class="row justify-content-start text-center  perhatian mb-5">
        <div class="col-2">
            <button class="btn btn-sm" style="background-color: transparent;" aria-label="announcement">
                <img src="{{ asset('svg/icon/volume-up-fill.svg') }}" width="15px" height="15px" alt="">
            </button>
        </div>
        <div class="col-7">
            <marquee width="100%" direction="left">
                {{ strtoupper($config[5]['value']) }}
            </marquee>
        </div>
        <div class="col-3 align-self-end">
            <button class="btn btn-sm" style="background-color: #070022;color:white;" aria-label="time" id="time">
            </button>
        </div>
    </div>

    <!-- permainan Popular -->
    <div class="list-game-home container-fluid" style="background-color: #0A0033;">
        <div class="row nav-game">
            <div class="col-8 col-md-10">
                <header class="d-flex align-items-center pb-3 mb-3">
                    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                        <img class="text-center game" src="{{ asset('svg/hot permainan.svg') }}" width="35px" height="35px" alt="">
                        <span class="header-list-game">Permainan Populer</span>
                    </a>
                </header>
            </div>
            <div class="col-4 col-md-2 pt-2">
                <button class="btn btn-md rounded-pill button-semua-permainan" href="#">Semua <img src="{{ asset('svg/icon/chevron-down.svg') }}" width="10px" height="10px" alt=""></button>
            </div>
        </div>
    </div>
    <div class="list-game-home mb-5 px-5 responsive-game-images">
        <div class="row px-md-3">
            <div class="list-game">
                <div class="col-md-12 ">
                    <div id="popular-game" class="owl-carousel owl-theme">
                        @foreach( $populargamelist as $item )
                            @php
                                $url = env('GAME_URL', 'https://api-staging.octosplay.com').'/api/568win/login?portfolio=seamlessgame&';
                                $gpid = $item['gpid'];
                                $gid = $item['gameid'];
                            @endphp
                            <div class="item post-slide">
                                <div class="post-img">
                                    <img src="{{ $item['image'] }}"  class="card-img-top" alt="{{ $item['image']  }}">
                                </div>
                                <div class="post-content text-center ">
                                    <span class="post-title">
                                        {{ $item['name'] }}
                                    </span>
                                    <br><button type="button" class="btn btn-sm btn-main" onclick="opengame( {{ Js::from($url) }}, {{ Js::from($username) }}, {{ Js::from($gpid) }}, {{ Js::from($gid) }}, {{ Js::from($platform) }} );">Main</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- permainan  Baru-->
    <div class="list-game-home container-fluid" style="background-color: #0A0033;">
        <div class="row nav-game">
            <div class="col-8 col-md-10">
                <header class="d-flex align-items-center pb-3 mb-3">
                    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                        <img class="text-center game" src="{{ asset('img/new.webp') }}" width="35px" height="35px" alt="">
                        <span class="header-list-game">Permainan Terbaru</span>
                    </a>
                </header>
            </div>
            <div class="col-4 col-md-2 pt-2">
                <button class="btn btn-md rounded-pill button-semua-permainan" href="#">Semua <img src="{{ asset('svg/icon/chevron-down.svg') }}" width="10px" height="10px" alt=""></button>
            </div>
        </div>
    </div>
    <div class="list-game-home mb-5 px-5 responsive-game-images">
        <div class="row px-md-3">
            <div class="list-game">
                <div class="col-md-12 ">
                    <div id="new-game" class="owl-carousel owl-theme">
                        @foreach( $hotgamelist as $item )
                            @php
                                $url = env('GAME_URL', 'https://api-staging.octosplay.com').'/api/568win/login?portfolio=seamlessgame&';
                                $gpid = $item['gpid'];
                                $gid = $item['gameid'];
                            @endphp
                            <div class="item post-slide">
                                <div class="post-img">
                                    <img src="{{ $item['image'] }}"  class="card-img-top" alt="{{ $item['image'] }}">
                                </div>
                                <div class="post-content text-center ">
                                    <span class="post-title">
                                        {{ $item['name'] }}
                                    </span>
                                    <br><button type="button" class="btn btn-sm btn-main" onclick="opengame( {{ Js::from($url) }}, {{ Js::from($username) }}, {{ Js::from($gpid) }}, {{ Js::from($gid) }}, {{ Js::from($platform) }} );">Main</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- permainan  Slot-->
    <div class="list-game-home container-fluid" style="background-color: #0A0033;">
        <div class="row nav-game">
            <div class="col-8 col-md-10">
                <header class="d-flex align-items-center pb-3 mb-3">
                    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                        <img class="text-center game" src="{{ asset('img/icon-slot.webp') }}" width="35px" height="35px" alt="">
                        <span class="header-list-game">Permainan Kemenangan Tinggi</span>
                    </a>
                </header>
            </div>
            <div class="col-4 col-md-2 pt-2">
                <button class="btn btn-md rounded-pill button-semua-permainan" href="#">Semua <img src="{{ asset('svg/icon/chevron-down.svg') }}" width="10px" height="10px" alt=""></button>
            </div>
        </div>
    </div>
    <div class="list-game-home mb-5 px-5 responsive-game-images">
        <div class="row px-md-3">
            <div class="list-game">
                <div class="col-md-12 ">
                    <div id="slot-game" class="owl-carousel owl-theme">
                        @foreach( $slotgamelist as $item )
                            @php
                                $url = env('GAME_URL', 'https://api-staging.octosplay.com').'/api/568win/login?portfolio=seamlessgame&';
                                $gpid = $item['gpid'];
                                $gid = $item['gameid'];
                            @endphp
                            <div class="item post-slide">
                                <div class="post-img">
                                    <img src="{{ $item['image'] }}"  class="card-img-top" alt="{{ $item['image']  }}">
                                </div>
                                <div class="post-content text-center ">
                                    <span class="post-title">
                                        {{ $item['name'] }}
                                    </span>
                                    <br><button type="button" class="btn btn-sm btn-main" onclick="opengame( {{ Js::from($url) }}, {{ Js::from($username) }}, {{ Js::from($gpid) }}, {{ Js::from($gid) }}, {{ Js::from($platform) }} );">Main</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Sponsor -->
    <div class="list-sponsor container-fluid mb-5">
        <div class="row g-2">
            <div class="col-md-4 mb-4">
                <div class="card card-pembayaran me-2 bg-transparent">
                    <div class="card-body text-white">
                        <header class=" d-flex align-items-center px-4 py-2 border-bottom">
                            <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                                <img class="text-center " src="{{ asset('svg/ant-design_pay-circle-filled.svg') }}" width="35px" height="35px" alt="">
                                <span class="fs-4 mx-2" style="color:#FFFFFF"><small>Sistem Pembayaran</small></span>
                            </a>
                        </header>
                        <div class="row justify-content-start mb-2 py-3 px-4">
                            <div class="col-6 col-md-6 col-sm-6 col-xs-6 logo-pembayaran  py-3 px-2">
                                <img class="sprite-pembayaran pembayaran_bca " alt="" src="data:image/webp;base64,iVBORw0KGgoAAAANSUhEUgAAAlgAAADoAQMAAAAJ/QjDAAAAA1BMVEX///+nxBvIAAAAAXRSTlMAQObYZgAAAChJREFUeNrtwTEBAAAAwqD1T20KP6AAAAAAAAAAAAAAAAAAAAAAAD4GROAAAVu+ji8AAAAASUVORK5CYII=">
                            </div>
                            <div class="col-6 col-md-6 col-sm-6 col-xs-6 logo-pembayaran py-3 px-2">
                                <img class="sprite-pembayaran pembayaran_bni " alt="" src="data:image/webp;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAAAxAQMAAAAC1sL3AAAAA1BMVEX///+nxBvIAAAAAXRSTlMAQObYZgAAABFJREFUeNpjYBgFo2AUDCcAAAPUAAHA7bkbAAAAAElFTkSuQmCC">
                            </div>
                            <div class="col-6 col-md-6 col-sm-6 col-xs-6 logo-pembayaran py-3 px-2">
                                <img class="sprite-pembayaran pembayaran_bri " alt="" src="data:image/webp;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAAAnAQMAAADXWSNxAAAAA1BMVEX///+nxBvIAAAAAXRSTlMAQObYZgAAABBJREFUeNpjYBgFo2AUgAAAAwwAAYYaqw4AAAAASUVORK5CYII=">
                            </div>
                            <div class="col-6 col-md-6 col-sm-6 col-xs-6 logo-pembayaran py-3 px-2">
                                <img class="sprite-pembayaran pembayaran_mandiri " alt="" src="data:image/webp;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAAApAQMAAADtU0IBAAAAA1BMVEX///+nxBvIAAAAAXRSTlMAQObYZgAAABBJREFUeNpjYBgFo2AUkAIAAzQAAYZ0IuMAAAAASUVORK5CYII=">
                            </div>
                            <div class="col-6 col-md-6 col-sm-6 col-xs-6 logo-pembayaran py-3 px-2">
                                <img class="sprite-pembayaran pembayaran_ovo " alt="" src="data:image/webp;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABEAQMAAABZOV6FAAAAA1BMVEX///+nxBvIAAAAAXRSTlMAQObYZgAAABRJREFUeNpjYBgFo2AUjIJRQA0AAAVQAAE949GwAAAAAElFTkSuQmCC">
                            </div>
                            <div class="col-6 col-md-6 col-sm-6 col-xs-6 logo-pembayaran py-3 px-2">
                                <img class="sprite-pembayaran pembayaran_paypal " alt="" src="data:image/webp;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABVAQMAAACRs4+7AAAAA1BMVEX///+nxBvIAAAAAXRSTlMAQObYZgAAABZJREFUeNpjYBgFo2AUjIJRMAoGJwAABqQAAe+UK5sAAAAASUVORK5CYII=">
                            </div>
                            <div class="col-6 col-md-6 col-sm-6 col-xs-6 logo-pembayaran py-3 px-2">
                                <img class="sprite-pembayaran pembayaran_dana " alt="" src="data:image/webp;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAAA6AQMAAABoETI0AAAAA1BMVEX///+nxBvIAAAAAXRSTlMAQObYZgAAABJJREFUeNpjYBgFo2AUjIKBBQAEiAABQj3aLAAAAABJRU5ErkJggg==">
                            </div>
                            <div class="col-6 col-md-6 col-sm-6 col-xs-6 logo-pembayaran py-3 px-2">
                                <img class="sprite-pembayaran pembayaran_linkaja " alt="" src="data:image/webp;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABMAQMAAAC1atzoAAAAA1BMVEX///+nxBvIAAAAAXRSTlMAQObYZgAAABRJREFUeNpjYBgFo2AUjIJRMBIAAAXwAAHZXfFnAAAAAElFTkSuQmCC">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-sponsor ms-2 bg-transparent">
                    <div class="card-body  text-white">
                        <header class=" d-flex align-items-center mb-3 px-4 py-2  border-bottom">
                            <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                                <img class="text-center " src="{{ asset('svg/eos-icons_service-instance.svg') }}" width="35px" height="35px" alt="">
                                <span class="fs-4 mx-2" style="color:#FFFFFF"><small>Sponsor</small></span>
                            </a>
                        </header>
                        <div class="row g-2 justify-content-start mb-2 px-2">
                            <div class="col-6 col-md-3 col-sm-6 col-xs-6 logo-sponsor">
                                <img class="sprite sponsor_pgs " alt="" src="data:image/webp;base64,iVBORw0KGgoAAAANSUhEUgAAAIIAAABDAQMAAABqeU+vAAAAA1BMVEX///+nxBvIAAAAAXRSTlMAQObYZgAAABJJREFUeNpjYBgFo2AUjIKhBAAEtgABaCn4jwAAAABJRU5ErkJggg==">
                            </div>
                            <div class="col-6 col-md-3 col-sm-6 col-xs-6 logo-sponsor py-2 px-2">
                                <img class="sprite sponsor_image-26 " alt="" src="data:image/webp;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAAvAQMAAAASIZzeAAAAA1BMVEX///+nxBvIAAAAAXRSTlMAQObYZgAAAA9JREFUeNpjYBgFo2DkAAAC8AABeuT+bgAAAABJRU5ErkJggg==">
                            </div>
                            <div class="col-6 col-md-3 col-sm-6 col-xs-6 logo-sponsor py-2 px-2">
                                <img class="sprite sponsor_jdb " alt="" src="data:image/webp;base64,iVBORw0KGgoAAAANSUhEUgAAAGgAAAAyAQMAAACKxwxzAAAAA1BMVEX///+nxBvIAAAAAXRSTlMAQObYZgAAAA9JREFUeNpjYBgFo2BoAgACvAABARqrRwAAAABJRU5ErkJggg==">
                            </div>
                            <div class="col-6 col-md-3 col-sm-6 col-xs-6 logo-sponsor py-2 px-2">
                                <img class="sprite sponsor_slot-88 " alt="" src="data:image/webp;base64,iVBORw0KGgoAAAANSUhEUgAAAIIAAAAyAQMAAACqB5HLAAAAA1BMVEX///+nxBvIAAAAAXRSTlMAQObYZgAAABFJREFUeNpjYBgFo2AUDCQAAAOEAAGduY02AAAAAElFTkSuQmCC">
                            </div>
                            <div class="col-6 col-md-3 col-sm-6 col-xs-6 logo-sponsor py-2 px-2">
                                <img class="sprite sponsor_cq9 " alt="" src="data:image/webp;base64,iVBORw0KGgoAAAANSUhEUgAAAIIAAAAyAQMAAACqB5HLAAAAA1BMVEX///+nxBvIAAAAAXRSTlMAQObYZgAAABFJREFUeNpjYBgFo2AUDCQAAAOEAAGduY02AAAAAElFTkSuQmCC">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tentang -->
    <div class="col-12 d-flex justify-content-center py-4">
        <div class="card mb-5 tentang bg-transparent">
            <div class="card-body text-left">
                <h2 class="card-title" style="color: #FFD754;">Tentang {{env("APP_NAME", "Lunatoire")}}</h2>
                <hr style="color: white;">
                <p class="card-text text-white">{{env("APP_NAME", "Lunatoire")}} adalah situs slot online terpercaya dan terbaik di Indonesia. Dimana kami adalah salah satu bandar judi bola online, casino online dan poker online terbaik yang mencakup seluruh bidang permainan game online via livechat, SMS maupun telepon</p>
            </div>
        </div>
    </div>


</div>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: #070022;color: #fff !important; font-size: 17px !important">
            <div class="modal-header" style="border:unset !important;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: #fff !important;">X</button>
            </div>
            <div class="modal-body">
                <form class=" form-login"  method="POST" action="/proses-login" style="float:unset !important;">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" style="width:100%  !important;">
                        @error('username')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kata Sandi"  style=width:100%  !important;">
                        @error('password')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="from-group" style="margin-right:10px;margin-left: 30px;">
                            <button type="submit" class="btn button-login">
                                <span class="button__text">Masuk</span>
                            </button>
                        </div>
                        <div class="from-group" style="margin-right:10px">
                            <button type="button" class="btn button-register register">Daftar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/jquery-3.6.0.min.js')}}" ></script>
<script src="{{ asset('js/timer.js')}}"></script>
@endsection
