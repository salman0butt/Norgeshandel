@extends('layouts.landingSite')

@section('page_content')
<style>
    .hero.secondary {
        --reach-menu-button: 1;
        -webkit-font-smoothing: antialiased;
        font: 14px/1.5 Finntype, HelveticaTweaked, Arial, Helvetica, sans-serif;
        color: #474445;
        box-sizing: border-box;
        display: block;
        background-image: url(//theme.zdassets.com/theme_assets/190164/f386c229de9b3124e0cdb614ef980d446d2e74ce.png);
        background-size: cover;
        padding: 0 20px;
        text-align: center;
        width: 100%;
        margin-bottom: 60px;
        background-position: bottom;
        height: 130px;
    }

    .search input[type=search] {
        -webkit-font-smoothing: antialiased;
        font: inherit;
        margin: 0;
        line-height: normal;
        font-size: 14px;
        font-weight: 300;
        max-width: 100%;
        outline: none;
        transition: border .12s ease-in-out;
        border-radius: 30px;
        box-sizing: border-box;
        color: #999;
        height: 40px;
        padding-left: 40px;
        padding-right: 20px;
        -webkit-appearance: none;
        width: 100%;
        border: 1px solid #fff;
        width: 548px;
        display: block;
        margin: 0 auto;
        position: relative;
        top: 50px;
    }

    .relative {
        position: relative;
    }

    .fa-search {
        position: absolute;
        bottom: -40px;
        left: 515px;
        z-index: 999999999;
        color: gray;
        font-size: 20px;
    }

    .section-content {
        --reach-menu-button: 1;
        -webkit-font-smoothing: antialiased;
        font: 14px/1.5 Finntype, HelveticaTweaked, Arial, Helvetica, sans-serif;
        color: #474445;
        box-sizing: border-box;
        display: block;
        flex: 0 0 80%;
    }

    .page-header h1 {
        --reach-menu-button: 1;
        -webkit-font-smoothing: antialiased;
        font: 14px/1.5 Finntype, HelveticaTweaked, Arial, Helvetica, sans-serif;
        color: #474445;
        box-sizing: border-box;
        margin: 0.67em 0;
        font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Helvetica, Arial, sans-serif;
        margin-top: 0;
        font-size: 35px;
        font-weight: 300;
        line-height: 1.25;
        flex-grow: 1;
        margin-bottom: 10px;
    }

    .article-list-item {
        --reach-menu-button: 1;
        -webkit-font-smoothing: antialiased;
        font: 14px/1.5 Finntype, HelveticaTweaked, Arial, Helvetica, sans-serif;
        color: #474445;
        list-style: none;
        box-sizing: border-box;
        font-size: 16px;
        border: 0;
        padding: 10px 0;
    }

    a:hover {
        text-decoration: underline;
    }

    .section-container {
        margin: 50px 100px;
    }

</style>

<main role="main">
    <div id="zen-section" class="zen_tmpl">
        <section class="section hero secondary">
            <div class="hero-inner">
                <form role="search" class="search search-full" data-search="" data-instant="true" autocomplete="off"
                    action="#" accept-charset="UTF-8" method="get">
                    <div class="form-group relative">
                        <i class="fas fa-search"></i>
                        <input type="search" name="query" id="query" placeholder="Hva kan vi hjelpe deg med? Søk her"
                            autocomplete="off" aria-label="Hva kan vi hjelpe deg med? Søk her">
                    </div>
                </form>
            </div>
        </section>


        <div class="container">
            <div class="breade-crumb">
                <nav aria-label="breadcrumb">
                    <div class="row pl-3 pr-3">
                        <div class="col-md-12 p-0">
                            <ol class="breadcrumb w-100"
                                style="border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">NorgesHandel.no hjelpesenter </a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">Min Konto</a></li>
                                <li class="breadcrumb-item active"><a href="#">Lagrede søk</a></li>
                            </ol>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="section-container">
                <section class="section-content">
                    <header class="page-header">
                    <h1>Lagrede søk</h1>
                    </header>
                    <ul class="article-list">
                        <li id="art-360011189379" class="article-list-item ">
                            <a href=#" class="article-list-link">Slik endrer du et søk du allerede har lagret</a>
                        </li>
                        <li id="art-115004581345" class="article-list-item ">

                            <a href="#" class="article-list-link">Hvordan lagrer jeg et søk for å få automatiske
                                varsler?</a>
                        </li>
                        <li id="art-115004582329" class="article-list-item ">

                            <a href="#" class="article-list-link">Hvordan legge til eller fjerne søkekriterier?</a>
                        </li>
                        <li id="art-115004582269" class="article-list-item ">

                            <a href="#" class="article-list-link">Hvordan sletter jeg lagrede søk?</a>
                        </li>
                        <li id="art-115004582529" class="article-list-item ">

                            <a href="#" class="article-list-link">Hvordan deaktiverer jeg varslinger for lagrede søk fra
                                appene?</a>
                        </li>
                        <li id="art-115004582469" class="article-list-item ">

                            <a href="#" class="article-list-link">Hvorfor får jeg e-post om lagrede søk når jeg har
                                stoppet det?</a>
                        </li>
                    </ul>

                </section>
            </div>
        </div>
    </div>
</main>

@endsection
